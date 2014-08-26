<?php

namespace ANSR\Models;

/**
 * Topic model
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class TopicModel extends Model {
    
    public function getTopicsByForumId($forum_id) {
        $forum_id = intval($forum_id);
        $result = $this->getDb()->query("SELECT id, summary, body, forum_id, created_on, user_id, views FROM topics WHERE forum_id = $forum_id");
        
        return $this->getDb()->fetch($result);
    }
    
    public function getTopicsByUserId($user_id) {
        $user_id = intval($user_id);
        $result = $this->getDb()->query("SELECT id, summary, body, forum_id, created_on, user_id, views FROM topics WHERE user_id = $user_id");
        
        return $this->getDb()->fetch($result);
    }
    
    public function getTopicById($id) {
        $id = intval($id);
        $result = $this->getDb()->query("SELECT id, summary, body, forum_id, created_on, user_id, views FROM topics WHERE id = $id");
        
        return $this->getDb()->row($result);
    }
    
    public function getTopics() {
        $result = $this->getDb()->query("SELECT id, summary, body, forum_id, created_on, user_id, views FROM topics");

        return $this->getDb()->fetch($result);
    }
    
    public function add($summary, $body, $forum_id, $user_id) {
        $summary = $this->getDb()->escape($summary);
        $body = $this->getDb()->escape($body);
        $forum_id = intval($forum_id);
        $user_id = intval($user_id);
        $query = "
            INSERT INTO topics (summary, body, forum_id, created_on, user_id) VALUES (
                '$summary', '$body', $forum_id, NOW(), $user_id
            )
        ";
        
        $this->getDb()->query($query);
        
        if ($this->getDb()->affectedRows() <= 0) {
            return false;
        }
        
        return ['id' => $this->getDb()->lastId()];
    }
    
    public function addTag($topic_id, $tag) {
        $topic_id = intval($topic_id);
        $tag = $this->getDb()->escape($tag);
        
        $this->getDb()->query("INSERT INTO topic_tags (topic_id, tag) VALUES ($topic_id, '$tag');");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function edit($id, $summary, $body) {
        $id = intval($id);
        $summary = $this->getDb()->escape($summary);
        $body = $this->getDb()->escape($body);
        
        $this->getDb()->query("UPDATE topics SET summary = '$summary', body = '$body' WHERE id = $id");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function move($id, $forum_id) {
        $id = intval($id);
        $forum_id = intval($forum_id);
        
        $this->getDb()->query("UPDATE topics SET forum_id = $forum_id WHERE id = $id");
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function delete($id) {
        $this->getDb()->query("DELETE FROM topics WHERE id = " . intval($id));
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function find($keyword) {
        $keyword = $this->getDb()->escape($keyword);
        
        $result = $this->getDb()->query("SELECT id, summary, body, forum_id, created_on, user_id FROM topics WHERE body LIKE '%$keyword%' OR summary LIKE '%$keyword%'");
        
        return $this->getDb()->fetch($result);
    }
    
    public function getPostsCount($topic_id) {
        $topic_id = intval($topic_id);

        $result = $this->getDb()->query("SELECT COUNT(*) AS cnt FROM topics t INNER JOIN answers a ON t.id = a.topic_id WHERE t.id = $topic_id");
    
        $row = $this->getDb()->row($result);
        
        return isset($row['cnt']) ? $row['cnt'] : 0;
    }

    public function getLastAuthorInfo($topic_id) {
        $topic_id = intval($topic_id);
        $result = $this->getDb()->query("
            SELECT u.username, a.created_on FROM topics t INNER JOIN answers a ON t.id = a.topic_id INNER JOIN users u ON u.id = a.user_id WHERE t.id = $topic_id ORDER BY created_on DESC LIMIT 1"
        );

        $row = $this->getDb()->row($result);
        
        return !empty($row) ? $row : array('username' => 'No author', 'created_on' => '');
    }
    
    public function getTopicsCount() {
        $result = $this->getDb()->query("SELECT COUNT(*) AS cnt FROM topics");
        
        $row = $this->getDb()->row($result);
        
        return !empty($row) ? $row['cnt'] : 0;
    }
}
