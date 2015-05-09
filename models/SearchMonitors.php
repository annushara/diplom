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
    public $comment;
    /**
     * @inheritdoc
     *
     */
    public function rules()
    {
        return [

            [['id'], 'integer'],
            [[ 'invent_num',  'date', ], 'safe'],
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
        if($params == Monitors::STATUS_INACTIVE) {

            $query = Monitors::find()
                ->with(['historyDiscarded'=>
                    function ($query) {
                         $query->andWhere(['status' => Monitors::STATUS_INACTIVE]);
                     },])
                ->where(['status'=>Monitors::STATUS_INACTIVE]);
        }else{
             $query = Monitors::find();
        }
        echo '<br><br><br><br>';
        print_r($query->createCommand()->rawSql);

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like','historyDiscarded',$this->comment]);





        return $dataProvider;
    }
}
