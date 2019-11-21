<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role}}`.
 */
class m190929_121240_create_user_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()
        ]);


        $this->insert('user_role',array(
            'name' => 'admin',
        ));


        $this->insert('user_role',array(
            'name' => 'student',
        ));


        $this->insert('user_role',array(
            'name' => 'teacher',
        ));

        $this->addForeignKey('FK_userrole_user', 'user', 'role_id', 'user_role', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_userrole_user', 'user', 'role_id', 'user_role', 'id', 'CASCADE');
        $this->dropTable('{{%user_role}}');
    }
}
