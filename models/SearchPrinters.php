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
        $query = Printers::find();
        echo '<br><br><br><br><br>';
        print_r($query);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        echo '<br><br><br><br><br>';
        print_r($dataProvider);
        echo '<br><br><br><br><br>';
        print_r(NamePrinters::findOne($this->id_name_printer));
        $query->andFilterWhere([
            'id' => $this->id,
            'id_staff' => $this->id_staff,
            'id_name_printer' =>$this->id_name_printer,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'invent_num', $this->invent_num]);
        echo '<br><br><br><br><br>';
        print_r($dataProvider);
        return $dataProvider;
    }
}