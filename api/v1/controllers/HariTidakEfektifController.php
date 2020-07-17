<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\HariTidakEfektif;
use common\models\HariTidakEfektifSearch;

class HariTidakEfektifController extends MyActiveController
{
    public $modelClass = HariTidakEfektif::class;
    public $modelSearchClass = HariTidakEfektifSearch::class;
}
