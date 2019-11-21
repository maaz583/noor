<?php

use yii\db\Migration;

/**
 * Class m191007_151931_add_foreignkey_between_tbluser_tblorganization
 */
class m191007_151931_add_foreignkey_between_tbluser_tblorganization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_user_organization', 'organization', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropForeignKey('fk_user_organization', 'organization');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_151931_add_foreignkey_between_tbluser_tblorganization cannot be reverted.\n";

        return false;
    }
    */
}
