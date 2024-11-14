<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property int $inbox_id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string|null $last_message_time
 * @property string|null $created_at
 *
 * @property Chat1[] $chat1s
 * @property BackendUsers $receiver
 * @property BackendUsers $sender
 */
class Inbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id'], 'required'],
            [['sender_id', 'receiver_id'], 'integer'],
            [['last_message_time', 'created_at'], 'safe'],
            [['sender_id', 'receiver_id'], 'unique', 'targetAttribute' => ['sender_id', 'receiver_id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUsers::class, 'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUsers::class, 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inbox_id' => 'Inbox ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'last_message_time' => 'Last Message Time',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Chat1s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChat1s()
    {
        return $this->hasMany(Chat1::class, ['inbox_id' => 'inbox_id']);
    }

    public static function primaryKey()
    {
        return ['inbox_id'];
    }

    /**
     * Gets query for [[Receiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(BackendUsers::class, ['id' => 'receiver_id']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(BackendUsers::class, ['id' => 'sender_id']);
    }
}
