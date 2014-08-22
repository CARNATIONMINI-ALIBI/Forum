<?php

namespace ANSR\Controllers;

/**
 * Topics Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Topics extends Controller {
    public function all() {
        $topics = $this->getApp()->TopicModel->getTopics();
        
        $this->getView()->topics = $topics;
        
    }
    
    public function view() {
        if ($this->getRequest()->getParam('id')) {
            $result = $this->getApp()->TopicModel->getTopicById($this->getRequest()->getParam('id'));
            $this->getView()->topic = $result;
        } elseif ($this->getRequest()->getParam('forumid')){
            $result = $this->getApp()->TopicModel->getTopicsByForumId($this->getRequest()->getParam('forumid'));
//            $this->getView()->topic = $result;

        }
    }
    
    public function add() {
        $summary = $this->getRequest()->getPost()->getParam('summary');
        $body = $this->getRequest()->getPost()->getParam('body');
        $forum_id = $this->getRequest()->getParam('forumid');
        $user_id = $_SESSION['user_id'];
        
        if ($this->getApp()->TopicModel->add($summary, $body, $forum_id, $user_id)) {
            die(json_encode(array('success' => 1)));
        }
        
        die(json_encode(array('success' => 0)));
    }
    
}

