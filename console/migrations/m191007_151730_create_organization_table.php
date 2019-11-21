<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%organization}}`.
 */
class m191007_151730_create_organization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organization}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'created_at' => $this->string(50)->notNull(),
            'updated_at' => $this->string(50)->notNull(),
            'status' => $this->integer()->defaultValue(10),
            'creator_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_user_organization', 'organization', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_organization', 'organization');
        $this->dropTable('{{%organization}}');
    }
}
