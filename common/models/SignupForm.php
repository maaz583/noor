<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $role_id;
    public $organization_name;
    public $password;
    public $confirm_password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['first_name','last_name'], 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],

            [['password'], 'match', 'pattern' => '/^(?=.*[a-z])/ ','message' => 'Password should contain atleast one lowercase letter.'],

            [['password'], 'match', 'pattern' => '/^(?=.*[A-Z])/ ','message' => 'Password should contain atleast one uppercase letter.'],

            [['password'], 'match', 'pattern' => '/^(?=.*[0-9])/ ','message' => 'Password should contain atleast one digit.'],

            [['password'], 'match', 'pattern' => '/^(?=.*[@$!%*?&#-])/ ','message' => 'Password should contain atleast one special character.'],

            [['password'], 'match', 'pattern' => '/^.{6,}/ ','message' => 'Password should be minimum 6 in length.'],

            ['confirm_password', 'required'],

            ['confirm_password', 'compare','compareAttribute' => 'password','message' => "Password don't match with the actual password."],

            [['organization_name'], 'required'],

            [['role_id'], 'required'],

            [['organization_name'], 'string'],



        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
       /* if (!$this->validate()) {
            return null;
        }
        */
            $user = new User();
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            //$user->organization_name = $this->organization_name;
            $user->email = $this->email;
            $user->role_id = $this->role_id;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            return $user->save(); // && $this->sendEmail($user);    
         
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function email()
    {
        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom('cusitian98@gmail.com')
            ->setTo($this->email)
            ->setSubject('Account registration')
            ->setTextBody("Your Account Password Is: ".$this->password)
            ->send();
    }
}

