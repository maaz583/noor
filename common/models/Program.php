<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class Program extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name'], 'required'],
            [['name'], 'unique', 'message' => 'This name address has already been taken.'],
            [['description'],'default','value'=> null],

        ];
    }
}
