<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pelanggaran;

/**
 * common\models\PelanggaranSearch represents the model behind the search form about `common\models\Pelanggaran`.
 */
 class PelanggaranSearch extends Pelanggaran
{
    public $id_kelas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pelanggaran', 'id_siswa', 'id_aturan', 'id_kelas'], 'integer'],
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
        $query = Pelanggaran::find()
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
            'id_pelanggaran' => $this->id_pelanggaran,
            'id_siswa' => $this->id_siswa,
            'kelas.id_kelas' => $this->id_kelas,
            'id_aturan' => $this->id_aturan,
            'tanggal' => $tanggal,
        ]);

        return $dataProvider;
    }
}
