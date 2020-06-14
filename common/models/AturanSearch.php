<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Aturan;

/**
 * common\models\AturanSearch represents the model behind the search form about `common\models\Aturan`.
 */
 class AturanSearch extends Aturan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_aturan', 'id_kategori', 'id_tindakan', 'point_aturan'], 'integer'],
            [['pasal', 'uraian_aturan'], 'safe'],
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
        $query = Aturan::find();

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
            'id_aturan' => $this->id_aturan,
            'id_kategori' => $this->id_kategori,
            'id_tindakan' => $this->id_tindakan,
            'point_aturan' => $this->point_aturan,
        ]);

        $query->andFilterWhere(['like', 'pasal', $this->pasal])
            ->andFilterWhere(['like', 'uraian_aturan', $this->uraian_aturan]);

        return $dataProvider;
    }
}
