<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class Student extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['father_name','academic_term_id','last_institute_name','area_of_interest_id'], 'required'],
            [['father_name'], 'string'],
            [['contact_no','father_contact_no','date_of_birth','address','institute_email','institute_contact_no'],'default', 'value' => null],
            ['institute_email','email'],
            ['institute_email','unique', 'message' => 'This email address has already been taken.'],
            [['contact_no'],'match', 'pattern' => '/^.{11,11}$/ ','message' => 'Invalid phone number.'],
            [['father_contact_no'],'match', 'pattern' => '/^.{11,11}$/ ','message' => 'Invalid phone number.'],

            [['institute_contact_no'],'match', 'pattern' => '/^.{11,11}$/ ','message' => 'Invalid phone number.'],

        ];
    }
}
