<?php
//
//namespace app\models;
//
//use yii\base\Model;
//use yii\data\ActiveDataProvider;
//use app\models\Users;
//
///**
// * UsersSearch represents the model behind the search form of `app\models\Users`.
// */
//class UsersSearch extends Users
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['id'], 'integer'],
//            [['username', 'email', 'password', 'role', 'created_at', 'updated_at', 'photo'], 'safe'],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }
//
//    /**
//     * Creates data provider instance with search query applied
//     *
//     * @param array $params
//     *
//     * @return ActiveDataProvider
//     */
//    public function search($params)
//    {
//        $query = Users::find();
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);
//
//        $query->andFilterWhere(['like', 'username', $this->username])
//            ->andFilterWhere(['like', 'email', $this->email])
//            ->andFilterWhere(['like', 'password', $this->password])
//            ->andFilterWhere(['like', 'role', $this->role])
//            ->andFilterWhere(['like', 'photo', $this->photo]);
//
//        return $dataProvider;
//    }
//}
