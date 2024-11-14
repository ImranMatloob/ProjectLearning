<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m241023_000000_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
            'rfc822' => $this->string(50)->notNull(),
            'name' => $this->string(255),
            'icon' => $this->string(255),
            'message' => $this->text(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-chat-user_id}}',
            '{{%chat}}',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-chat-user_id}}',
            '{{%chat}}'
        );

        $this->dropTable('{{%chat}}');
    }
}
