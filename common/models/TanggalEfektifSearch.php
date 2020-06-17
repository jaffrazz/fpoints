<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TanggalEfektif;

/**
 * common\models\TanggalEfektifSearch represents the model behind the search form about `common\models\TanggalEfektif`.
 */
 class TanggalEfektifSearch extends TanggalEfektif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tanggal_efektif'], 'integer'],
            [['tanggal_efektif'], 'unique']
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
        $query = TanggalEfektif::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['tanggal_efektif' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->tanggal_efektif)) {
            $this->tanggal_efektif = date('Y-m-d', strtotime($this->tanggal_efektif));
        }


        $query->andFilterWhere([
            'id_tanggal_efektif' => $this->id_tanggal_efektif,
            'tanggal_efektif' => $this->tanggal_efektif,
        ]);

        return $dataProvider;
    }
}
