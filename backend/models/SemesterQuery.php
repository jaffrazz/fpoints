<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\Semester]].
 *
 * @see \app\models\Semester
 */
class SemesterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Semester[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Semester|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
