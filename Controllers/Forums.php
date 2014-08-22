<?php

namespace ANSR\Controllers;

/**
 * Topics Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Forums extends Controller {
    
    public function view() {
        if ($this->getRequest()->getParam('categoryid')) {
            $result = $this->getApp()->ForumModel->getForumsByCategoryId($this->getRequest()->getParam('categoryid'));
            
            $this->getView()->forums = $result;
        }
    }
    
    public function topics() {
         if ($this->getRequest()->getParam('id')) {
            $result = $this->getApp()->TopicModel->getTopicsByForumId($this->getRequest()->getParam('id'));
            
            $this->getView()->forum = $result;
        }
    }
}