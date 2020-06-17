<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Absensi;

/**
 * common\models\AbsensiSearch represents the model behind the search form about `common\models\Absensi`.
 */
 class AbsensiSearch extends Absensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_absensi', 'id_kelas', 'id_tanggal_efektif'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Absensi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_absensi' => $this->id_absensi,
            'id_kelas' => $this->id_kelas,
            'id_tanggal_efektif' => $this->id_tanggal_efektif,
        ]);

        return $dataProvider;
    }
}
