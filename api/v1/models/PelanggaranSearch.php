<?php

namespace api\v1\models;

use yii\base\Model;

/**
 * common\models\KelasSearch represents the model behind the search form about `common\models\Kelas`.
 */
class PelanggaranSearch extends Model
{
    /**
     * We plan to get two columns in our grid that can be filtered.
     * Add more if required. You don't have to add all of them.
     */
    public $tanggal_pelanggaran;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Here we can define validation rules for each filtered column.
     * See http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     * for more information about validation.
     */
    public function rules()
    {
        return [
            [['tanggal_pelanggaran'], 'safe'],
            // our columns are just simple string, nothing fancy
        ];
    }

    /**
     * In this example we keep this special property to know if columns should be
     * filtered or not. See search() method below.
     */
    private $_filtered = false;

    /**
     * This method returns ArrayDataProvider.
     * Filtered and sorted if required.
     */

    public function load($data, $formName = null)
    {
        $vars = $this->rules()[0][0];
        foreach ($vars as $var) {
            if (isset($data[$var])) {
                $this->$var = $data[$var];
            }

        }
        return true;
    }

    public function search($params)
    {
        /**
         * $params is the array of GET parameters passed in the actionExample().
         * These are being loaded and validated.
         * If validation is successful _filtered property is set to true to prepare
         * data source. If not - data source is displayed without any filtering.
         */

        if ($this->load($params) && $this->validate()) {
            $this->_filtered = true;
        }

        $perPage = (isset($params['per-page'])) ? (int) $params['per-page'] : 10;
        $perPage = ($perPage) ? $perPage : 10;

        return new \yii\data\ArrayDataProvider([
            // ArrayDataProvider here takes the actual data source
            'allModels' => $this->getData(),
            'pagination' => ['pageSize' => $perPage],
            'sort' => [
                // we want our columns to be sortable:
                'attributes' => ['tanggal_pelanggaran'],
            ],
        ]);
    }

    /**
     * Here we are preparing the data source and applying the filters
     * if _filtered property is set to true.
     */
    protected function getData()
    {
        $data = $this->data;
        if ($this->_filtered) {
            $data = array_filter($data, function ($value) {
                $conditions = [true];
                if (!empty($this->tanggal_pelanggaran)) {
                    $conditions[] = strpos(strtolower($value['tanggal_pelanggaran']), strtolower($this->tanggal_pelanggaran)) !== false;
                }
                return array_product($conditions);
            });
        }

        return $data;
    }
}
