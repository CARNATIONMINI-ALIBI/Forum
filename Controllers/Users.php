<?php

namespace ANSR\Controllers;

/**
 * Users Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Users extends Controller {
    
    public function login() {
        
        if ($this->getRequest()->getPost()->getParam('username')) {
            $user = $this->getRequest()->getPost()->getParam('username');
            $pass = $this->getRequest()->getPost()->getParam('password');
            
            if ($this->getApp()->UserModel->login($user, $pass)) {
                die(json_encode(array('success' => 1)));
            }
        }
        
         return die(json_encode(array('success' => 0, 'msg' => 'Wrong or missing credentials')));
    }
    
    public function register() {
        
        if ($this->getRequest()->getPost()->getParam('username')) {
            $user = $this->getRequest()->getPost()->getParam('username');
            $pass = $this->getRequest()->getPost()->getParam('password');
            $email = $this->getRequest()->getPost()->getParam('email');
            
            if ($this->getApp()->UserModel->register($user, $pass, $email)) {
                $this->getApp()->UserModel->login($user, $pass);
                die(json_encode(array('success' => 1)));
            }
        }
        
         return die(json_encode(array('success' => 0, 'msg' => 'User exists or missing credentials')));
    }
    
    public function online() {
        $this->getView()->users = $this->getApp()->UserModel->getOnlineUsers();
    }
    
    public function rankings() {
        
        $type = \ANSR\Models\UserModel::RANKING_TYPE_POSTS;
        
        if ($this->getRequest()->getParam('type')) {
            $type = $this->getRequest()->getParam('type');
        }
        
        $this->getView()->users = $this->getApp()->UserModel->getUsers($type);
    }

    public function isAdmin() {
        return $this->getApp()->UserModel->getRole($_SESSION['user_id']) == \ANSR\Models\UserModel::ROLE_ADMINISTRATOR;
    }

    public function isModerator() {
        return $this->getApp()->UserModel->getRole($_SESSION['user_id']) == \ANSR\Models\UserModel::ROLE_MODERATOR;
    }
    
    public function logout() {
        session_destroy();
        exit;
    }

}

