<?php

use yii\db\Migration;

/**
 * Class m191001_201603_add_foreignkey_between_usertable_userrole
 */
class m191001_201603_add_foreignkey_between_usertable_userrole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('FK_userrole_user', 'user', 'role_id', 'user_role', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_userrole_user', 'user', 'role_id', 'user_role', 'id', 'CASCADE');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191001_201603_add_foreignkey_between_usertable_userrole cannot be reverted.\n";

        return false;
    }
    */
}
