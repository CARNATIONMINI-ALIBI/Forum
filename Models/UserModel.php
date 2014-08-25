<?php

namespace ANSR\Models;

/**
 * User model
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class UserModel extends Model {
    
    const ROLE_USER = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_ADMINISTRATOR = 3;

    public function register($username, $password, $email, $avatar = null, $role_id = self::ROLE_USER) {
        $username = $this->getDb()->escape($username);
        $password = md5($password);
        $email = $this->getDb()->escape($email);
        
        if ($this->userExists($username)) {
            return false;
        }
        
        $result = $this->getDb()->query("
            INSERT INTO 
                users 
            (username, password, email, avatar, role_id, register_date) 
                VALUES
            ('$username', '$password', '$email', '$avatar', '$role_id', NOW());
        ");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function login($username, $password) {
        $username = $this->getDb()->escape($username);
        $password = md5($password);

        if ($this->userExists($username, $password)) {
            $_SESSION['user_id'] = $this->getIdByUsername($username);
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }
    
    public function userExists($username, $password = null) {
        $username = $this->getDb()->escape($username);
        
        $query = "SELECT COUNT(*) AS cnt FROM users WHERE username = '$username' ";
        
        if ($password) {
            $query .= " AND password = '$password'";
        }
        
        $result = $this->getDb()->query($query);
        
        $row = $this->getDb()->row($result);
        
        return $row['cnt'] > 0;
    }
    
    public function getIdByUsername($username) {
        $username = $this->getDb()->escape($username);
        
        $result = $this->getDb()->query("SELECT id FROM users WHERE username = '$username';");
        
        $row = $this->getDb()->row($result);
        
        return isset($row['id']) ? $row['id'] : 0;
    }
    
    public function getUsernameById($id) {
        $id = intval($id);
        
        $result = $this->getDb()->query("SELECT username FROM users WHERE id = $id");
        
        $row = $this->getDb()->row($result);
        
        return isset($row['username']) ? $row['username'] : '';
    }

    public function getRole($user_id) {
        $user_id = intval($user_id);

        $result = $this->getDb()->query("SELECT role_id FROM users WHERE id = '$user_id';");

        $row = $this->getDb()->row($result);

        return $row['role_id'];
    }
   
    public function isAdmin($user_id) {
        return $this->getRole($user_id) == self::ROLE_ADMINISTRATOR;
    }
    
    public function isModerator($user_id) {
        return $this->getRole($user_id) == self::ROLE_MODERATOR;
    }
    
    public function isLogged() {
        return isset($_SESSION['user_id']);
    }
    
    public function getLastRegisteredUser() {
        $result = $this->getDb()->query("SELECT id, username, email, avatar, role_id, register_date FROM users ORDER BY register_date DESC LIMIT 1");
        
        $row = $this->getDb()->row($result);
        
        return !empty($row) ? $row : ['id' => 0, 'username' => 'Np user'];
    }
    
}

