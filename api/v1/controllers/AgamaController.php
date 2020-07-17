<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\Agama;
use common\models\AgamaSearch;

class AgamaController extends MyActiveController
{
    public $modelClass = Agama::class;
    public $modelSearchClass = AgamaSearch::class;
}
