<?php

use yii\db\Migration;

/**
 * Class m191020_140413_create_table_user_organization
 */
class m191020_140413_create_table_user_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_organization}}', [

            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'role_id' => $this->integer()->notNull(),
            'organization_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_userorganization_user', 'user_organization', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk_userorganization_userrole', 'user_organization', 'role_id', 'user_role', 'id', 'CASCADE');

        $this->addForeignKey('fk_userorganization_organization', 'user_organization', 'organization_id', 'organization', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_organization}}');
        $this->dropForeignKey('fk_userorganization_user', 'user_organization');
        $this->dropForeignKey('fk_userorganization_userrole', 'user_organization');
        $this->dropForeignKey('fk_userorganization_organization', 'user_organization');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_140413_create_table_user_organization cannot be reverted.\n";

        return false;
    }
    */
}
