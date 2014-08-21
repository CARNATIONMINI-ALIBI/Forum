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
            (username, password, email, avatar, role_id) 
                VALUES
            ('$username', '$password', '$email', '$avatar', '$role_id');
        ");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function login($username, $password) {
        $username = $this->getDb()->escape($username);
        $password = md5($password);
        
        if ($this->userExists($username, $password)) {
            $_SESSION['user_id'] = $this->getIdByUsername($username);
            return true;
        }
        return false;
    }
    
    public function userExists($username, $password = null) {
        $username = $this->getDb()->escape($username);
        
        $query = "SELECT COUNT(*) AS cnt FROM users WHERE username = '$username' ";
        
        if ($password) {
            $password = md5($password);
            $query .= " AND password = '$password'";
        }
        
        $result = $this->getDb()->query($query);
        
        $row = $this->getDb()->fetch($result)[0];
        
        return $row['cnt'] > 0;
    }
    
    public function getIdByUsername($username) {
        $username = $this->getDb()->escape($username);
        
        $result = $this->getDb()->query("SELECT id FROM users WHERE username = '$username';");
        
        $row = $this->getDb()->fetch($result)[0];
        
        return $row['id'];
    }

    public function getRole($user_id) {
        $user_id = intval($user_id);

        $result = $this->getDb()->query("SELECT role_id FROM users WHERE id = '$user_id';");

        $row = $this->getDb()->fetch($result)[0];
        
        return $row['role_id'];
    }
}

