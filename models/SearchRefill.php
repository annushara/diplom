<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Refill;

/**
 * SearchRefill represents the model behind the search form about `app\models\Refill`.
 */
class SearchRefill extends Refill
{
    public $name;
    public $fio;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['comment', 'date','id_printer','name','fio'], 'safe'],
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
        $query = Refill::find()->with(['idPrinter','idPrinter.idNamePrinter','idPrinter.idStaff'])->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 7,
            ]
        ]);




        $dataProvider->sort->attributes['fio'] = [
            'asc' => ['staff.fio' => SORT_ASC],
            'desc' => ['staff.fio' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name_printers.name' => SORT_ASC],
            'desc' => ['name_printers.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->joinWith('idPrinter');
        $query->joinWith('idPrinter.idStaff');
        $query->joinWith('idPrinter.idNamePrinter');

        $query->andFilterWhere([
            'id' => $this->id,

        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'staff.fio', $this->fio])
            ->andFilterWhere(['like', 'name_printers.name', $this->name]);

        return $dataProvider;
    }
}
