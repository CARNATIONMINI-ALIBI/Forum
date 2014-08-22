<?php

namespace ANSR\Models;

/**
 * Answer model
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class AsideModel extends Model {
    public function getSection() {
        return array("C++", "C#", "Java", "JavaScript", "Perl", "PHP", "Python", "Ruby");
    }
}
    