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
        }
        
    }
}