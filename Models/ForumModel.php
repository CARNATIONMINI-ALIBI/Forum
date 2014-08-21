<?php

namespace ANSR\Models;

/**
 * Forum model
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class ForumModel extends Model {
    
    public function getForumsByCategoryId($category_id) {
        $result = $this->getDb()->query("SELECT id, name, category_id, order_id FROM forums WHERE category_id = " . intval($category_id));
        
        return $this->getDb()->fetch($result);
    }

    public functin getForumById($id) {
        $result = $this->getDb()->query("SELECT id, name, category_id, order_id FROM forums WHERE id = " . intval($id));
        
        return $this->getDb()->fetch($result)[0];
    }
    
    public function getForums() {
        $result = $this->getDb()->query("SELECT id, name, category_id, order_id FROM forums");
        
        return $this->getDb()->fetch($result);
    }
    
    public function add($name, $category_id, $order_id) {
        $name = $this->getDb()->escape($name);
        $category_id = intval($category_id);
        $order_id = intval($order_id);
        $this->getDb()->query("INSERT INTO forums (name, category_id, order_id) VALUES ('$name', $category_id, $order_id)");
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function edit($name, $category_id = null, $order_id = null) {
        $name = $this->getDb()->escape($name);
        $query = "UPDATE forums SET name = '$name' ";
        
        if ($category_id) {
            $query .= " , category_id = " . intval($category_id);
        }
        
        if ($order_id) {
            $query .= " , order_id = " . intval($order_id);
        }
        
        $query .= " WHERE id = " . intval($id);
        
        $this->getDb()->query($query);
        
        return $this->getDb()->affectedRows() > 0;
    }
    
    public function delete($id) {
        $this->getDb()->query("DELETE FROM forums WHERE id = " . intval($id));
        return $this->getDb()->affectedRows() > 0;
    }
}