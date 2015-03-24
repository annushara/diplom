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
            [['id_printer'], 'integer'],
            [['invent_num_printer_1', 'invent_num_printer_2', 'invent_num_printer_3', 'invent_num_printer_4', 'invent_num_printer_5', 'print_1', 'print_2', 'print_3', 'print_4', 'print_5', 'date_1', 'date_2', 'date_3', 'date_4', 'date_5', 'old_staff_1', 'old_staff_2', 'old_staff_3', 'old_staff_4', 'old_staff_5'], 'safe'],
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
            'id_printer' => $this->id_printer,
        ]);

        $query->andFilterWhere(['like', 'invent_num_printer_1', $this->invent_num_printer_1])
            ->andFilterWhere(['like', 'invent_num_printer_2', $this->invent_num_printer_2])
            ->andFilterWhere(['like', 'invent_num_printer_3', $this->invent_num_printer_3])
            ->andFilterWhere(['like', 'invent_num_printer_4', $this->invent_num_printer_4])
            ->andFilterWhere(['like', 'invent_num_printer_5', $this->invent_num_printer_5])
            ->andFilterWhere(['like', 'print_1', $this->print_1])
            ->andFilterWhere(['like', 'print_2', $this->print_2])
            ->andFilterWhere(['like', 'print_3', $this->print_3])
            ->andFilterWhere(['like', 'print_4', $this->print_4])
            ->andFilterWhere(['like', 'print_5', $this->print_5])
            ->andFilterWhere(['like', 'date_1', $this->date_1])
            ->andFilterWhere(['like', 'date_2', $this->date_2])
            ->andFilterWhere(['like', 'date_3', $this->date_3])
            ->andFilterWhere(['like', 'date_4', $this->date_4])
            ->andFilterWhere(['like', 'date_5', $this->date_5])
            ->andFilterWhere(['like', 'old_staff_1', $this->old_staff_1])
            ->andFilterWhere(['like', 'old_staff_2', $this->old_staff_2])
            ->andFilterWhere(['like', 'old_staff_3', $this->old_staff_3])
            ->andFilterWhere(['like', 'old_staff_4', $this->old_staff_4])
            ->andFilterWhere(['like', 'old_staff_5', $this->old_staff_5]);

        return $dataProvider;
    }
}
