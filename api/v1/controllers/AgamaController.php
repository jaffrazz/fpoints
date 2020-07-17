<?php
namespace api\v1\controllers;

use Yii;
use Exception;
use api\modules\MyActiveController;
use common\models\AgamaSearch;
use common\models\Agama;

class AgamaController extends MyActiveController {
    public $modelClass = Agama::class;
    public $modelSearchClass = AgamaSearch::class;
}