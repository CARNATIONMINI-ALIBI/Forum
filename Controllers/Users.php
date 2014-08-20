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
                die(json_encode(array('success' => 1)));
            }
        }
        
         return die(json_encode(array('success' => 0, 'msg' => 'User exists or missing credentials')));
    }

}

