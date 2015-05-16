<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SystemUnit;

/**
 * SearchSystemUnit represents the model behind the search form about `app\models\SystemUnit`.
 */
class SearchSystemUnits extends SystemUnit{
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
        if($params == SystemUnit::STATUS_INACTIVE) {

            $query = SystemUnit::find()
                ->with(['historyDiscarded'=>
                    function ($query) {
                        $query->andWhere(['status' => SystemUnit::STATUS_INACTIVE]);
                    },'historyDiscarded.oldStaff'])
                ->where(['status'=>SystemUnit::STATUS_INACTIVE]);
        } else if($params == SystemUnit::GET_HISTORY) {

            $query = HistorySystemUnit::find()
                ->with(['idSystemUnit.nameSystemUnit','oldStaff','newStaff'])
                ->where(['status'=>SystemUnit::STATUS_ACTIVE])
                ->orderBy(['id' => SORT_DESC]);

        }else{
            $query = SystemUnit::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 5,
            ]
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
            ->andFilterWhere(['like','history_SystemUnit.comment',$this->comment]);





        return $dataProvider;
    }
}
