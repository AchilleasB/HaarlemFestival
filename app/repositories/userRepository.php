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
            $stmt = $this->connection->prepare("SELECT firstname, lastname, email FROM users WHERE id = :id");
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
        } catch (PDOException $e) {
            echo $e;
        }
    }

}