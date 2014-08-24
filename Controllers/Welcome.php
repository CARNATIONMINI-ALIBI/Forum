<?php

namespace ANSR\Controllers;

/**
 * Topics Controller
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Welcome extends Controller {
    public function index() {
        $forums = $this->getApp()->ForumModel->getForums();
        $this->getView()->forums = $forums;
    }
}