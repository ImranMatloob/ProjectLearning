<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inbox;

/**
 * InboxSearch represents the model behind the search form of `app\models\Inbox`.
 */
class InboxSearch extends Inbox
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inbox_id', 'sender_id', 'receiver_id'], 'integer'],
            [['last_message_time', 'created_at'], 'safe'],
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
        $query = Inbox::find();

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
            'inbox_id' => $this->inbox_id,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'last_message_time' => $this->last_message_time,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
