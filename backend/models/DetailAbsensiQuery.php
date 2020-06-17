<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\DetailAbsensi]].
 *
 * @see \app\models\DetailAbsensi
 */
class DetailAbsensiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\DetailAbsensi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\DetailAbsensi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
