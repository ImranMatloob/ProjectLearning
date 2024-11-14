<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $content
 * @property string|null $created_at
 * @property string|null $published_at
 * @property string|null $status
 * @property string $title
 * @property string|null $updated_at
 * @property int|null $user_id
 * @property int|null $location_id
 *
 * @property Location $location
 * @property BackendUsers $user
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'title'], 'required'],
            [['content', 'status'], 'string'],
            [['created_at', 'published_at', 'updated_at'], 'safe'],
            [['user_id', 'location_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUsers::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'published_at' => 'Published At',
            'status' => 'Status',
            'title' => 'Title',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'location_id' => 'Location ID',
        ];
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BackendUsers::class, ['id' => 'user_id']);
    }
}
