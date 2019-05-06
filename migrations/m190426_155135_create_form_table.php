<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form}}`.
 */
class m190426_155135_create_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'datetimesendform' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form}}');
    }
}
