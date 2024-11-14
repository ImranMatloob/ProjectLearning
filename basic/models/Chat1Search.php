<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chat1;

/**
 * Chat1Search represents the model behind the search form of `app\models\Chat1`.
 */
class Chat1Search extends Chat1
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_id', 'inbox_id', 'sender_id', 'is_read'], 'integer'],
            [['message_text', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Chat1::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'message_id' => $this->message_id,
            'inbox_id' => $this->inbox_id,
            'sender_id' => $this->sender_id,
            'is_read' => $this->is_read,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'message_text', $this->message_text]);

        return $dataProvider;
    }
}
