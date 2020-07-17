<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\KategoriPenghargaan]].
 *
 * @see \app\models\KategoriPenghargaan
 */
class KategoriPenghargaanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\KategoriPenghargaan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\KategoriPenghargaan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
