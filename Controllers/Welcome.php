<?php

namespace ANSR\Controllers;

/**
 * Topics Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Welcome extends Controller {
    public function index() {
        $categories = $this->getApp()->CategoryModel->getCategories();
        
        foreach ($categories as &$category) {
            $category['forums'] = $this->getApp()->ForumModel->getForumsByCategoryId($category['id']);
        }

        $this->getView()->categories = $categories;
    }
}