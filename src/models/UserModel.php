<?php

namespace Models;

use Core\Model;

class UserModel extends Model
{
    public function createUser($data)
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        return $stmt->execute($data);
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

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
?>