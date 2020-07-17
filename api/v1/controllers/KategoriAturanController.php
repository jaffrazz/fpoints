<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use common\models\KategoriAturan;
use common\models\KategoriAturanSearch;

class KategoriAturanController extends MyActiveController
{
    public $modelClass = KategoriAturan::class;
    public $modelSearchClass = KategoriAturanSearch::class;
}
