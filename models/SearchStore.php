<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use app\models\Refill;
    use yii\db\Query;
    use yii\helpers\ArrayHelper;

    /**
     * SearchRefill represents the model behind the search form about `app\models\Refill`.
     */
    class SearchStore extends Staff
    {
        public $id_name_monitor;
        public $fio;
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [

                [['id_name_monitor'], 'safe'],
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
         * $params = 0, return ActiveDataProvider monitors
         * $params = 1, return ActiveDataProvider units
         * $params = 2, return ActiveDataProvider printers
         * $params = 3, return ActiveDataProvider others
         *
         */
        public function search($params)
        {
        //    $query = Refill::find()->with(['idPrinter','idPrinter.idNamePrinter','idPrinter.idStaff'])->orderBy(['id' => SORT_DESC]);

//            $query = Monitors::find()->with(['nameMonitor'])->orderBy(['id' => SORT_ASC]);
//            $query2 = Monitors::find()->with(['namePrinter'])->orderBy(['id' => SORT_ASC]);
                if($params == 0) {
                    $query = Monitors::find()->with(['nameMonitor','historyDiscarded'=>function ($query) {
                        $query->orderBy(['id' => SORT_DESC]);
                    }])->where(['id_staff' => NULL, 'status' => 1])->orderBy(['id' => SORT_DESC]);
                }
                if($params ==1){
                    $query = SystemUnit::find()->with(['nameSystemUnit','historyDiscarded'=>function ($query) {
                        $query->orderBy(['id' => SORT_DESC]);
                    }])->where(['id_staff' => NULL, 'status' => 1])->orderBy(['id' => SORT_DESC]);
                }

                if($params ==2){
                    $query = Printers::find()->with(['idNamePrinter','historyDiscarded'=>function ($query) {
                        $query->orderBy(['id' => SORT_DESC]);
                    }])->where(['id_staff' => NULL, 'status' => 1])->orderBy(['id' => SORT_DESC]);
                }

                if($params ==3){
                    $query = Other::find()->with(['historyDiscarded'=>function ($query) {
                        $query->orderBy(['id' => SORT_DESC]);
                    }])->where(['id_staff' => NULL, 'status' => 1])->orderBy(['id' => SORT_DESC]);
                }


            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'forcePageParam' => false,
                    'pageSizeParam' => false,
                    'pageSize' => 7,
                ]
            ]);





//
//            $dataProvider->sort->attributes['fio'] = [
//                'asc' => ['staff.fio' => SORT_ASC],
//                'desc' => ['staff.fio' => SORT_DESC],
//            ];
//
//            $dataProvider->sort->attributes['name'] = [
//                'asc' => ['name_printers.name' => SORT_ASC],
//                'desc' => ['name_printers.name' => SORT_DESC],
//            ];

            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }


           // $query->joinWith('monitors');
//            $query->joinWith('idPrinter.idStaff');
//            $query->joinWith('idPrinter.idNamePrinter');

            $query->andFilterWhere([
                'id' => $this->id,

            ]);

//            $query->andFilterWhere(['like', 'comment', $this->comment])
//                ->andFilterWhere(['like', 'date', $this->date])
//                ->andFilterWhere(['like', 'staff.fio', $this->fio])
//                ->andFilterWhere(['like', 'name_printers.name', $this->name]);

            return $dataProvider;
        }
    }

