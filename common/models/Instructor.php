<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class Instructor extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['gender','contact','course_id'], 'required'],
            [['contact'],'match', 'pattern' => '/^.{11,11}$/ ','message' => 'Invalid phone number.'],
        ];
    }
}
