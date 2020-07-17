<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\StatusAbsensi;
use common\models\StatusAbsensiSearch;

class StatusAbsensiController extends MyActiveController
{
    public $modelClass = StatusAbsensi::class;
    public $modelSearchClass = StatusAbsensiSearch::class;
}
