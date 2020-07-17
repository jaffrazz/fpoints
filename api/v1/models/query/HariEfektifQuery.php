<?php

namespace api\v1\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\HariEfektif]].
 *
 * @see \app\models\HariEfektif
 */
class HariEfektifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\HariEfektif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\HariEfektif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
