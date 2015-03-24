<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Monitors;

/**
 * SearchMonitors represents the model behind the search form about `app\models\Monitors`.
 */
class SearchMonitors extends Monitors
{
    public $staff;
    /**
     * @inheritdoc
     *
     */
    public function rules()
    {
        return [

            [['id_monitor'], 'integer'],
            [['invent_num_monitor_1', 'invent_num_monitor_2', 'monitor_1', 'monitor_2', 'date_1', 'date_2', 'old_staff_1', 'old_staff_2'], 'safe'],
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
        $query = Monitors::find();

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
            'id_monitor' => $this->id_monitor,
        ]);

        $query->andFilterWhere(['like', 'invent_num_monitor_1', $this->invent_num_monitor_1])
            ->andFilterWhere(['like', 'invent_num_monitor_2', $this->invent_num_monitor_2])
            ->andFilterWhere(['like', 'monitor_1', $this->monitor_1])
            ->andFilterWhere(['like', 'monitor_2', $this->monitor_2])
            ->andFilterWhere(['like', 'date_1', $this->date_1])
            ->andFilterWhere(['like', 'date_2', $this->date_2])
            ->andFilterWhere(['like', 'old_staff_1', $this->old_staff_1])
            ->andFilterWhere(['like', 'old_staff_2', $this->old_staff_2]);

        return $dataProvider;
    }
}
