<?php
namespace Controllers;

use Core\Controller;
use Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Helpers\MailHelper;
use Helpers\ResponseHelper;

class UserController extends Controller
{
    public function register()
    {
        $input = $this->getInput();

        // Validate input
        $errors = $this->validateUserInput($input);
        if (!empty($errors)) {
            return $this->jsonResponse(['errors' => $errors], 400);
        }

        try {
            $userModel = new UserModel();
            $hashedPassword = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['password'] = $hashedPassword;

            $result = $userModel->createUser($input);

            if (isset($result['error'])) {
                return $this->jsonResponse(['message' => $result['error']], 400);
            }

            return $this->jsonResponse($result);
        } catch (\Exception $e) {
            return $this->jsonResponse(['message' => 'An error occurred while creating the user.'], 500);
        }
    }

    public function login()
    {
        $input = $this->getInput();
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($input['email']);

        if ($user && password_verify($input['password'], $user['password'])) {
            $userModel->updateLoginTime($user['id']);

            $filteredUser = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'logged_at' => date('Y-m-d H:i:s')
            ];

            return $this->jsonResponse(['message' => 'Login successful', 'user' => $filteredUser]);
        } else {
            return $this->jsonResponse(['message' => 'Invalid email or password'], 401);
        }
    }

    public function getUserById($id)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($user) {
            $filteredUser = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'logged_at' => $user['logged_at']
            ];
            return $this->jsonResponse($filteredUser);
        } else {
            error_log("User with ID $id not found.");
            return $this->jsonResponse(['message' => 'User not found'], 404);
        }
    }

    public function listUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        // Filter users to remove any unwanted keys
        $filteredUsers = array_map(function ($user) {
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'logged_at' => $user['logged_at']
            ];
        }, $users);

        return $this->jsonResponse($filteredUsers);
    }

    public function updateUser($id)
    {
        $input = $this->getInput();

        // Validate input
        $errors = $this->validateUserInput($input, $id);
        if (!empty($errors)) {
            return $this->jsonResponse(['errors' => $errors], 400);
        }

        // Hash the password if it is present in the input
        if (isset($input['password'])) {
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        $userModel = new UserModel();
        $result = $userModel->updateUser($id, $input);

        if ($result) {
            return $this->jsonResponse(['message' => 'User updated successfully']);
        } else {
            return $this->jsonResponse(['message' => 'Failed to update user'], 400);
        }
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $result = $userModel->deleteUser($id);

        if ($result) {
            return $this->jsonResponse(['message' => 'User deleted successfully']);
        } else {
            return $this->jsonResponse(['message' => 'User not found'], 404);
        }
    }

    public function showResetPasswordForm()
    {
        // Get the token from the query string
        $token = $_GET['token'] ?? '';

        // Verify the token
        $userModel = new UserModel();
        $resetRequest = $userModel->getPasswordResetToken($token);

        if (!$resetRequest) {
            echo "Invalid or expired token.";
            return;
        }

        // Render the password reset form
        \Core\View::make('reset_password', ['token' => $token]);
    }

    public function requestPasswordReset()
    {
        $input = $this->getInput();
        $email = $input['email'];
        $token = bin2hex(random_bytes(16));

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if (!$user) {
            return $this->jsonResponse(['message' => 'User not found'], 404);
        }

        $userModel->createPasswordResetToken($email, $token);

        // Send email with the token
        $emailSent = MailHelper::sendResetEmail($email, $token);

        if ($emailSent) {
            return $this->jsonResponse(['message' => 'Password reset email sent']);
        } else {
            return $this->jsonResponse(['message' => 'Failed to send email'], 500);
        }
    }

    public function resetPassword()
    {
        $input = $this->getInput();
        $token = $input['token'];
        $newPassword = $input['password'];

        if (empty($token) || empty($newPassword)) {
            return $this->jsonResponse(['message' => 'Token and password are required'], 400);
        }

        $userModel = new UserModel();
        $resetRequest = $userModel->getPasswordResetToken($token);

        if (!$resetRequest) {
            return $this->jsonResponse(['message' => 'Invalid or expired token'], 400);
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $userModel->updatePasswordByEmail($resetRequest['email'], $hashedPassword);
        $userModel->deletePasswordResetToken($token);

        return $this->jsonResponse(['message' => 'Password reset successful']);
    }

    protected function getInput()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        return filter_var_array($input, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    protected function jsonResponse($data, $statusCode = 200)
    {
        \Helpers\ResponseHelper::jsonResponse($data, $statusCode);
    }

    private function validateUserInput($input, $id = null)
    {
        $errors = [];

        if (isset($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        if (isset($input['password']) && strlen($input['password']) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }

        return $errors;
    }
}
