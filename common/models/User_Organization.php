<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class User_organization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['user_id','role_id','organization_id'], 'required'],
        ];
    }
}
