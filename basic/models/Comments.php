<?php

namespace app\models;

use app\comments\Posts;
use app\comments\Users;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $post_id
 * @property int|null $user_id
 * @property string $author_name
 * @property string $content
 * @property string|null $status
 * @property string|null $created_at
 *
 * @property Posts $post
 * @property backendUsers $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'author_name', 'content'], 'required'],
            [['id', 'post_id', 'user_id'], 'integer'],
            [['content', 'status'], 'string'],
            [['created_at'], 'safe'],
            [['author_name'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::class, 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'backendUsers ID',
            'author_name' => 'Author Name',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::class, ['id' => 'post_id']);
    }

    /**
     * Gets query for [[backendUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
