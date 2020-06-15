<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Semester;

/**
 * common\models\SemesterSearch represents the model behind the search form about `common\models\Semester`.
 */
 class SemesterSearch extends Semester
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_semester'], 'integer'],
            [['semester', 'awal_bulan_semester', 'akhir_bulan_semester'], 'safe'],
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
        $query = Semester::find();

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
            'id_semester' => $this->id_semester,
        ]);

        $query->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'awal_bulan_semester', $this->awal_bulan_semester])
            ->andFilterWhere(['like', 'akhir_bulan_semester', $this->akhir_bulan_semester]);

        return $dataProvider;
    }
}
