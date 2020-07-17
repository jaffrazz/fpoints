<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\HariEfektif;
use common\models\HariEfektifSearch;
use Yii;

class HariEfektifController extends MyActiveController
{
    public $modelClass = HariEfektif::class;
    public $modelSearchClass = HariEfektifSearch::class;
}
