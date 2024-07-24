<?php

namespace Models;

use Core\Model;
use PDO;
use PDOException;

class UserModel extends Model
{
    public function createUser($data)
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            return $stmt->execute($data);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return ['error' => 'User already exists'];
            }
            throw $e; // Re-throw exception if it's not a duplicate entry error
        }
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT id, name, email, password, logged_at FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateLoginTime($userId)
    {
        $stmt = $this->db->prepare('UPDATE users SET logged_at = NOW() WHERE id = :id');
        return $stmt->execute(['id' => $userId]);
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare('SELECT id, name, email, logged_at FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query('SELECT id, name, email, logged_at FROM users');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fields = implode(', ', $fields);

        $stmt = $this->db->prepare("UPDATE users SET $fields WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /*
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
    */

    public function createPasswordResetToken($email, $token)
    {
        $stmt = $this->db->prepare('INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, DATE_ADD(NOW(), INTERVAL 1 MINUTE))');
        return $stmt->execute([
            'email' => $email,
            'token' => $token
        ]);
    }

    public function getPasswordResetToken($token)
    {
        $stmt = $this->db->prepare('SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW()');
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function deletePasswordResetToken($token)
    {
        $stmt = $this->db->prepare('DELETE FROM password_resets WHERE token = :token');
        return $stmt->execute(['token' => $token]);
    }

    public function updatePasswordByEmail($email, $newPassword)
    {
        $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE email = :email');
        return $stmt->execute([
            'password' => $newPassword,
            'email' => $email
        ]);
    }

    public function deleteUser($id)
    {
        // Check if the user exists
        $stmt = $this->db->prepare('SELECT id FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false; // User not found
        }

        // Proceed to delete the user
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
