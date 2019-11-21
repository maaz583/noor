<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User Role form
 */
class Academic_term extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name'], 'required'],
            [['start_date','end_date'], 'required'],

        ];
    }
}
