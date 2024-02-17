<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . ' /../models/user.php';

class UserRepository extends Repository
{

    public function getUserByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            if (!$user) {
                return null;
            }
            return $user;
        } catch (PDOException $e) {
            echo $e;
        }

    }

    public function getUserById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            if (!$user) {
                return null;
            }
            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function addUser(User $user)
    {
        try {
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $role = $user->getRole();
            $registration_date = $user->getRegistrationDate();

            $stmt = $this->connection->prepare("INSERT INTO users (firstname, lastname, email, password, role, registration_date) VALUES (:firstname, :lastname, :email, :password, :role, :registration_date)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':registration_date', $registration_date);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateUser($firstname, $lastname, $email, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updatePassword($id, $newPassword)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET password = :newPassword WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function addToken($id, $token)
    {
        try {
            $expiresAt = date('Y-m-d H:i:s', strtotime('+2 hour'));
            $stmt = $this->connection->prepare("INSERT INTO password_reset_tokens (user_id, token, expires_at) VALUES (:id, :token, :expiresAt)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expiresAt', $expiresAt);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteToken($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM password_reset_tokens WHERE user_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getUserIdByToken($token)
    {
        try {
            $stmt = $this->connection->prepare("SELECT user_id FROM password_reset_tokens WHERE token = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            if (!$result) {
                return null;
            }
            return $result['user_id'];
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // the isExpiredToken should return true if the token is expired and false if it is not
    public function isExpiredToken($token)
    {
        try {
            $stmt = $this->connection->prepare("SELECT expires_at FROM password_reset_tokens WHERE token = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            if (!$result) {
                return false;
            }
            $expiresAt = $result['expires_at'];
            if (strtotime($expiresAt) < time()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}