<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\HariEfektif;
use common\models\HariEfektifSearch;

class HariEfektifController extends MyActiveController
{
    public $modelClass = HariEfektif::class;
    public $modelSearchClass = HariEfektifSearch::class;
}
