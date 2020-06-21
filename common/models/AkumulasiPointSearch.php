<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AkumulasiPoint;

/**
 * common\models\AkumulasiPointSearch represents the model behind the search form about `common\models\AkumulasiPoint`.
 */
 class AkumulasiPointSearch extends AkumulasiPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_akumulasi_point', 'id_tahun_ajaran', 'id_semester'], 'integer'],
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
        $query = AkumulasiPoint::find();

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
            'id_akumulasi_point' => $this->id_akumulasi_point,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_semester' => $this->id_semester,
        ]);

        return $dataProvider;
    }
}
