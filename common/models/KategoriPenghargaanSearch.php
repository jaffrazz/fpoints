<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KategoriPenghargaan;

/**
 * common\models\KategoriPenghargaanSearch represents the model behind the search form about `common\models\KategoriPenghargaan`.
 */
 class KategoriPenghargaanSearch extends KategoriPenghargaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kategori_penghargaan'], 'integer'],
            [['kategori_penghargaan'], 'safe'],
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
        $query = KategoriPenghargaan::find();

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
            'id_kategori_penghargaan' => $this->id_kategori_penghargaan,
        ]);

        $query->andFilterWhere(['like', 'kategori_penghargaan', $this->kategori_penghargaan]);

        return $dataProvider;
    }
}
