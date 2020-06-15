<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "kategori_penghargaan".
 *
 * @property integer $id_kategori_penghargaan
 * @property string $kategori_penghargaan
 *
 * @property \common\models\Penghargaan[] $penghargaans
 */
class KategoriPenghargaan extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'penghargaans'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_penghargaan'], 'required'],
            [['kategori_penghargaan'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_penghargaan';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kategori_penghargaan' => 'Id Kategori Penghargaan',
            'kategori_penghargaan' => 'Kategori Penghargaan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenghargaans()
    {
        return $this->hasMany(\common\models\Penghargaan::className(), ['id_kategori_penghargaan' => 'id_kategori_penghargaan']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\KategoriPenghargaanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\KategoriPenghargaanQuery(get_called_class());
    }
}
