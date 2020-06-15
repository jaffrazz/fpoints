<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Prestasi;

/**
 * common\models\PrestasiSearch represents the model behind the search form about `common\models\Prestasi`.
 */
 class PrestasiSearch extends Prestasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prestasi', 'id_siswa', 'id_penghargaan'], 'integer'],
            [['tanggal'], 'safe'],
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
        $query = Prestasi::find();

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
            'id_prestasi' => $this->id_prestasi,
            'id_siswa' => $this->id_siswa,
            'id_penghargaan' => $this->id_penghargaan,
            'tanggal' => $this->tanggal,
        ]);

        return $dataProvider;
    }
}
