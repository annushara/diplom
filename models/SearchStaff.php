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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_staff', 'id_department', 'id_configuration'], 'integer'],
            [['name', 'patronymic', 'surname', 'fio'], 'safe'],
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
        $query = Staff::find();

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
            'id_staff' => $this->id_staff,
            'id_department' => $this->id_department,
            'id_configuration' => $this->id_configuration,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'fio', $this->fio]);

        return $dataProvider;
    }
}
