<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HariTidakEfektif;

/**
 * common\models\HariTidakEfektifSearch represents the model behind the search form about `common\models\HariTidakEfektif`.
 */
 class HariTidakEfektifSearch extends HariTidakEfektif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hari_tidak_efektif'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir', 'keterangan_tidak_efektif'], 'safe'],
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
        $query = HariTidakEfektif::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!empty($this->tanggal_awal)) {
            $tanggal_awal = date('Y-m-d', strtotime($this->tanggal_awal));
        }else{
            $tanggal_awal = null;
        }
        
        if (!empty($this->tanggal_akhir)) {
            $tanggal_akhir = date('Y-m-d', strtotime($this->tanggal_akhir));
        }else{
            $tanggal_akhir = null;
        }


        $query->andFilterWhere([
            'id_hari_tidak_efektif' => $this->id_hari_tidak_efektif,
            // 'tanggal_awal' => $this->tanggal_awal,
            // 'tanggal_akhir' => $this->tanggal_akhir,
        ]);

        $query->andFilterWhere(['between','tanggal_awal', $tanggal_awal,$tanggal_akhir])
                ->orFilterWhere(['between','tanggal_akhir', $tanggal_awal,$tanggal_akhir]);

        $query->andFilterWhere(['like', 'keterangan_tidak_efektif', $this->keterangan_tidak_efektif]);

        return $dataProvider;
    }
}
