<?php

namespace api\v1\models;

use common\models\Agama as AgamaBase;

class Agama extends AgamaBase {
    public static function find(){
        return new \app\v1\models\query\AgamaQuery(get_called_class());
    }
}
