<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Configuration;

/**
 * ConfigurationSearch represents the model behind the search form about `app\models\Configuration`.
 */
class ConfigurationSearch extends Configuration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_configuration'], 'integer'],
            [['invent_num_system',  'cpu', 'motherboard', 'graphics','hdd_1', 'hdd_2', 'memory_1', 'memory_2', 'memory_3', 'memory_4', 'mac', 'date','old_staff'], 'safe'],
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
        $query = Configuration::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_configuration' => $this->id_configuration,
        ]);

        $query->andFilterWhere(['like', 'invent_num_system', $this->invent_num_system])
            ->andFilterWhere(['like', 'cpu', $this->cpu])
            ->andFilterWhere(['like', 'motherboard', $this->motherboard])
            ->andFilterWhere(['like', 'graphics', $this->graphics])
            ->andFilterWhere(['like', 'hdd_1', $this->hdd_1])
            ->andFilterWhere(['like', 'hdd_2', $this->hdd_2])
            ->andFilterWhere(['like', 'memory_1', $this->memory_1])
            ->andFilterWhere(['like', 'memory_2', $this->memory_2])
            ->andFilterWhere(['like', 'memory_3', $this->memory_3])
            ->andFilterWhere(['like', 'memory_4', $this->memory_4])
            ->andFilterWhere(['like', 'mac', $this->mac]);

        return $dataProvider;
    }
}
