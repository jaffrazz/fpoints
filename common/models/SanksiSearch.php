<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sanksi;

/**
 * common\models\SanksiSearch represents the model behind the search form about `common\models\Sanksi`.
 */
 class SanksiSearch extends Sanksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sanksi', 'minimum_point'], 'integer'],
            [['uraian'], 'safe'],
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
        $query = Sanksi::find()->orderBy(['minimum_point' => SORT_ASC]);

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
            'id_sanksi' => $this->id_sanksi,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian]);
        $query->andFilterWhere(['like', 'minimum_point', $this->minimum_point]);

        return $dataProvider;
    }
}
