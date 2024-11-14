<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat1".
 *
 * @property int $message_id
 * @property int $inbox_id
 * @property int $sender_id
 * @property string $message_text
 * @property int|null $is_read
 * @property string|null $created_at
 *
 * @property Inbox $inbox
 * @property BackendUsers $sender
 */
class Chat1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inbox_id', 'sender_id', 'message_text'], 'required'],
            [['inbox_id', 'sender_id', 'is_read'], 'integer'],
            [['message_text'], 'string'],
            [['created_at'], 'safe'],
            [['inbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inbox::class, 'targetAttribute' => ['inbox_id' => 'inbox_id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUsers::class, 'targetAttribute' => ['sender_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'Message ID',
            'inbox_id' => 'Inbox ID',
            'sender_id' => 'Sender ID',
            'message_text' => 'Message Text',
            'is_read' => 'Is Read',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Inbox]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInbox()
    {
        return $this->hasOne(Inbox::class, ['inbox_id' => 'inbox_id']);
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
