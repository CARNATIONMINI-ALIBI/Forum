<?php

namespace ANSR\Models;

/**
 * Answer model
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class AnswerModel extends Model {
    
    public function getAnswersByTopicId($topic_id) {
        $topic_id = intval($topic_id);
        $result = $this->getDb()->query("SELECT id, body, topic_id, created_on, user_id FROM answers WHERE topic_id = $topic_id");
        
        return $this->getDb()->fetch($result);
    }
    
    public function getAnswersByUserId($user_id) {
        $user_id = intval($user_id);
        $result = $this->getDb()->query("SELECT id, body, topic_id, created_on, user_id FROM answers WHERE user_id = $user_id");
        
        return $this->getDb()->fetch($result);
    }

    public function getAnswerById($id) {
        $id = intval($id);
        $result = $this->getDb()->query("SELECT id, body, topic_id, created_on, user_id FROM answers WHERE id = $id");
        
        return $this->getDb()->row($result);
    }
    
    public function getAnswers() {
        $result = $this->getDb()->query("SELECT id, body, topic_id, created_on, user_id FROM answers");
        
        return $this->getDb()->fetch($result);
    }
    
    public function add($body, $forum_id, $user_id) {
        $body = $this->getDb()->escape($body);
        $forum_id = intval($forum_id);
        $user_id = intval($user_id);
        $query = "
            INSERT INTO answers (body, forum_id, created_on, user_id) VALUES (
                '$body', $forum_id, NOW(), $user_id
            )
        ";
        
        $this->getDb()->query($query);
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function edit($id, $body) {
        $id = intval($id);
        $body = $this->getDb()->escape($body);
        
        $this->getDb()->query("UPDATE answers SET body = '$body' WHERE id = $id");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function delete($id) {
        $this->getDb()->query("DELETE FROM answers WHERE id = " . intval($id));
        return $this->getDb()->affectedRows() > 0;
    }
}