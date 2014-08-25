<?php

namespace ANSR\Controllers;

/**
 * Answers Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Answers extends Controller {
    
    public function add() {
        $username = null;
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        
        if (!$this->getApp()->UserModel->isLogged()) {
            $username = $this->getRequest()->getPost()->getParam('username');
            if (!$username) {
                die(['success' => 0]);
            }
        }
        
        $body = $this->getRequest()->getPost()->getParam('body');
        $topic_id = $this->getRequest()->getParam('topicid');
        
        if ($this->getApp()->AnswerModel->add($body, $topic_id, $user_id, $username)) {
            die(json_encode(['success' => 1]));
        }
        
        die(json_encode(['success' => 0]));
    }
}