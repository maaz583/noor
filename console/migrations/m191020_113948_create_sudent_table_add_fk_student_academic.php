<?php

use yii\db\Migration;

/**
 * Class m191020_113948_create_sudent_table_add_fk_student_academic
 */
class m191020_113948_create_sudent_table_add_fk_student_academic extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('{{%student}}', [

            'id' => $this->primaryKey(),
            'academic_term_id' => $this->integer()->notNull(),
            'father_name' => $this->string(50)->notNull(),
            'address' => $this->string(50),
            'contact_no' => $this->double(),
            'father_contact_no' => $this->double(),
            'area_of_interest_id' => $this->integer()->notNull(),
            'date_of_birth' => $this->string(32),

            'last_institute_name' => $this->string(50)->notNull(),
            'institute_email' => $this->string(50)->unique(),
            'institute_contact_no' => $this->double(),
            'ref_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_student_user', 'student', 'ref_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk_student_academic', 'student', 'academic_term_id', 'academic_term', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
        $this->dropForeignKey('fk_student_user', 'student');
        $this->dropForeignKey('fk_student_academic', 'student');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_113948_create_sudent_table_add_fk_student_academic cannot be reverted.\n";

        return false;
    }
    */
}
