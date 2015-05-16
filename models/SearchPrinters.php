<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Printers;

/**
 * SearchPrinters represents the model behind the search form about `app\models\Printers`.
 */
class SearchPrinters extends Printers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_staff', 'id_name_printer'], 'integer'],
            [['date', 'invent_num'], 'safe'],
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
        if($params == Printers::STATUS_INACTIVE) {

            $query = Printers::find()
                ->with(['historyDiscarded'=>
                    function ($query) {
                        $query->andWhere(['status' => Printers::STATUS_INACTIVE]);
                    },'historyDiscarded.oldStaff'])
                ->where(['status'=>Printers::STATUS_INACTIVE]);
        }else if($params == Printers::GET_HISTORY) {

            $query = HistoryPrinters::find()
                ->with(['idPrinter.idNamePrinter','oldStaff','newStaff'])
                ->where(['status'=>Printers::STATUS_ACTIVE])
                ->orderBy(['id' => SORT_DESC]);

        }else{
            $query = Printers::find();
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
            'id_staff' => $this->id_staff,
            'id_name_printer' =>$this->idNamePrinter,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'invent_num', $this->invent_num]);

        return $dataProvider;
    }
}