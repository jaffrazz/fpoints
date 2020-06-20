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
    public $tanggal_filter;
    public $id_kelas;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prestasi', 'id_siswa', 'id_penghargaan', 'id_kelas'], 'integer'],
            [['tanggal','tanggal_filter'], 'safe'],
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
        $query = Prestasi::find()
            ->joinWith(['siswa'])
            ->innerJoin('on_kelas_siswa','on_kelas_siswa.id_siswa = siswa.id_siswa')
            ->innerJoin('kelas','on_kelas_siswa.id_kelas = kelas.id_kelas');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($this->tanggal)){
            $tanggal = date('Y-m-d',strtotime($this->tanggal));
        }else{
            $tanggal = null;
        }

        $query->andFilterWhere([
            'id_prestasi' => $this->id_prestasi,
            'kelas.id_kelas' => $this->id_kelas,
            'id_siswa' => $this->id_siswa,
            'id_penghargaan' => $this->id_penghargaan,
            'tanggal' => $tanggal,
        ]);

        return $dataProvider;
    }
}
