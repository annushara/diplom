<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use app\models\Staff;

    /**
     * SearchStaff represents the model behind the search form about `app\models\Staff`.
     */
    class SearchStaff extends Staff
    {
        public $department;
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['id', 'id_department', 'status'], 'integer'],
                [['fio'], 'safe'],
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
            if($params == Staff::STATUS_INACTIVE) {
                $query = Staff::find()->with('idDepartment')->where(['status' => Staff::STATUS_INACTIVE])->orderBy(['id' => SORT_DESC]);


            }else{
                $query = Staff::find()->with('idDepartment');
            }

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'forcePageParam' => false,
                    'pageSizeParam' => false,
                    'pageSize' => 10,
                ]
            ]);



            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            $query->joinWith('idDepartment');

            $query->andFilterWhere([
                'id' => $this->id,
                'id_department' => $this->id_department,
                'status' => $this->status,
            ]);

            $query->andFilterWhere(['like', 'fio', $this->fio])
                ->andFilterWhere(['like', 'department.department', $this->department]);

            return $dataProvider;
        }
    }
