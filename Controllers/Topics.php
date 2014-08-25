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
            $topic = $this->getApp()->TopicModel->getTopicById($this->getRequest()->getParam('id'));
            $answers = $this->getapp()->AnswerModel->getAnswersByTopicId($this->getRequest()->getParam('id'));

            $this->getView()->topic = $topic;
            $this->getView()->answers = $answers;
        }
    }

    public function add() {
        
        if (!$this->getRequest()->getParam('forumid')) {
            die(json_encode(['success' => 0]));
        }
        
        if ($this->getRequest()->getPost()->getParam('summary')) {

            $summary = $this->getRequest()->getPost()->getParam('summary');
            $body = $this->getRequest()->getPost()->getParam('body');
            $forum_id = $this->getRequest()->getParam('forumid');
            $user_id = $_SESSION['user_id'];
            
            $tags = explode(',', $this->getRequest()->getPost()->getParam('tags'));

            if (true == ($response = $this->getApp()->TopicModel->add($summary, $body, $forum_id, $user_id))) {
                foreach ($tags as $tag) {
                    if (!$this->getApp()->TopicModel->addTag($response['id'], trim($tag))) {
                        die(json_encode(['success' => 0]));
                    }    
                }
                die(json_encode(['success' => 1, 'topic_id' => $response['id']]));
            }

            die(json_encode(['success' => 0]));
        }
    }

    public function find() {

        $result = ['success' => 0];

        if ($this->getRequest()->getPost()->getParam('keyword')) {
            $result = $this->getApp()->TopicModel->find($this->getRequest()->getPost()->getParam('keyword'));
        }

        die(json_encode($result));
    }

}

