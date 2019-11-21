<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class User_role extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name'], 'required'],
            [['name'], 'unique', 'message' => 'This name has already been taken.']

        ];
    }
}
