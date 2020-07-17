<?php

namespace api\v1\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\TanggalEfektif]].
 *
 * @see \app\models\TanggalEfektif
 */
class TanggalEfektifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\TanggalEfektif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\TanggalEfektif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
