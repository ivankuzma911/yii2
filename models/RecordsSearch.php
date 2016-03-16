<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Records;

/**
 * RecordsSearch represents the model behind the search form about `app\models\Records`.
 */
class RecordsSearch extends Records
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['first', 'last', 'email', 'home', 'work', 'cell', 'zip', 'state', 'country', 'best_phone', 'user_id', 'birthday', 'address1', 'address2', 'city'], 'safe'],
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
        $query = Records::find()->where(['user_id'=>Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'attributes'=>[
                    'first' => [
                         'asc' => ['first' => SORT_ASC,],
                        'desc' => ['first' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => ('first'),
                    ],
                    'last'=>[
                        'asc' => ['last' => SORT_ASC],
                         'desc' => ['last' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => ('last'),
                     ]
                 ]
             ],
            'pagination'=>['pageSize'=>5]

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'first', $this->first])
            ->andFilterWhere(['like', 'last', $this->last])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'home', $this->home])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'best_phone', $this->best_phone])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }

    public function findEmails(){

    }
}
