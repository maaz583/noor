<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Company form
 */
class Organization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name','created_at','updated_at','creator_id'], 'required'],
           
           ];
    }

    /*public function email()
    {
        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom('cusitian98@gmail.com')
            ->setTo('gmerz1998@gmail.com')
            ->setSubject('Account registration')
            ->setTextBody('Hello')
            ->send();
    }*/
}
