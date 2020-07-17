<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\TahunAjaran]].
 *
 * @see \app\models\TahunAjaran
 */
class TahunAjaranQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\TahunAjaran[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\TahunAjaran|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
