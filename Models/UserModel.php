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
    
    const INTERVAL_ONLINE_MINUTES = 15;
    
    const RANKING_TYPE_POSTS = 'posts';
    const RANKING_TYPE_UPVOTES = 'votes';

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
            (username, password, email, avatar, role_id, register_date, last_click, last_page) 
                VALUES
            ('$username', '$password', '$email', '$avatar', '$role_id', NOW(), NOW(), 'users/register');
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
    
    public function updateLastClick($user_id, $page) {
        $user_id = intval($user_id);
        
        $this->getDb()->query("UPDATE users SET last_click = NOW(), last_page = '$page' WHERE id = $user_id");
        
        return $this->getDb()->affectedRows() > 0;
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
    
    public function getOnlineUsers() {
        $result = $this->getDb()->query("SELECT id, username, last_click, last_page FROM users WHERE last_click > DATE_SUB(NOW(), INTERVAL " . self::INTERVAL_ONLINE_MINUTES . " MINUTE);");
        
        $rows = $this->getDb()->fetch($result);
        
        foreach ($rows as &$row) {
            switch ($row['last_page']):
                case 'Welcome/index':
                    $row['page'] = 'Viewing index';
                    break;
                case 'Froums/view':
                    $row['page'] = 'Viewing a forum';
                    break;
                case 'Topics/view':
                case 'Topics/all':
                    $row['page'] = 'Reading a topic';
                    break;
                case 'Topics/add':
                    $row['page'] = 'Writing a topic';
                    break;
                case 'Answers/add':
                    $row['page'] = 'Answering to a topic';
                    break;
                case 'Users/online':
                    $row['page'] = 'Reviewing who is online';
                    break;
                default:
                    $row['page'] = $row['last_page'];
                    break;
            endswitch;
            
            $params = explode('/', $row['last_page']);
            $row['controller'] = $params[0];
            $row['action'] = $params[1];
        }
        
        return $rows;
    }
    
    public function getUsers($ranking = null) {
        $query = "
            SELECT 
                users.id, username, email, role_id, votes, (COUNT(answers.id) + COUNT(topics.id)) AS posts, register_date
            FROM
                users
            INNER JOIN
                answers
            ON
                users.id = answers.user_id
            INNER JOIN
                topics
            ON
                users.id = topics.user_id
            GROUP BY
                users.id    
        ";
        
        switch ($ranking):
            case self::RANKING_TYPE_POSTS:
                $query .= " ORDER BY posts DESC";
                break;
            case self::RANKING_TYPE_UPVOTES:
                $query .= " ORDER BY votes DESC";
            default:
                break;
        endswitch;
        
        $result = $this->getDb()->query($query);
        
        return $this->getDb()->fetch($result);
    }
    
}

