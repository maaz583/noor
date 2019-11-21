<?php
namespace api\versions\v1\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

 
use common\models\User;
use common\models\SignupForm;
use common\models\LoginForm;
use common\models\Organization;
use common\models\User_role;
use common\models\Academic_term;
use common\models\Student;
use common\models\User_organization;
use common\models\Program;
use common\models\Instructor;
 

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ActiveController {

    public $active_id = 1;

    //public $enableCsrfValidation = false;
    public $modelClass = "common\models\User";

    public function behaviors() {
        $behaviors = parent::behaviors();

        //For CORS
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        $behaviors['authenticator'] = $auth;

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
            'except' => ['options','login','usersignup','organization','adduserrole','addacademic','addstudent','addprogram','addinstructor'],
        ];

        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    public function actionLogin() {
        
        $loginuser_model = new LoginForm();
        $loginuser_model->attributes = Yii::$app->request->post();


        if($loginuser_model->login())
        {
            //$active_id = Yii::$app->user->id;
            return array('status' => true, 'data' => Yii::$app->user->identity);

        }
        else
        {
            return array('status' => false, 'data' => $loginuser_model->errors);
        }
        
    }

    public function actionUsersignup() {
       
        $signup_model = new SignupForm;
        $user_organization_model = new User_organization();

        $signup_model->attributes = Yii::$app->request->post();

        $organization = new Organization();

        $signup_model->role_id = 1;
        
        if($signup_model->validate() && $signup_model->signup())
        {
            $organizationmodel = User::find('*')->where(['email' => $signup_model->email])->one();

            $organization->name = $signup_model->organization_name;
            $organization->created_at = date('Y-m-d h:i:s a'); 
            $organization->updated_at = date('Y-m-d h:i:s a');
            $organization->creator_id = $organizationmodel->id;

            if($organization->validate())
            {
                $organization->save();

                $get_organization_record = Organization::find('*')->where(['creator_id' => $organizationmodel->id])->one();

                $user_organization_model->user_id = $get_organization_record->creator_id;
                $user_organization_model->role_id = 1;
                $user_organization_model->organization_id = $get_organization_record->id;

                if($user_organization_model->validate())
                {
                    $user_organization_model->save();    

                    return array('status' => true, 'data' => 'Organization Has Been Created Sucessfully');
                }
            }
        }


        else
        {
            return array('status' => false, 'data' => $signup_model->errors);
        }

}


    public function actionAdduserrole()
    {
        $user_role_model = new User_role();

        $user_role_model->attributes = Yii::$app->request->post();
        
        if($user_role_model->validate())
        {
            $user_role_model->save();
            return array('status' => true, 'data' => 'User Role Has Been Created');
        }

        else
        {
            return array('status' => false, 'data' => $user_role_model->errors);
        }
    }

    public function actionAddacademic()
    {
        $academic_model = new Academic_term();

        $academic_model->attributes = Yii::$app->request->post();
        
        if($academic_model->validate())
        {
            $academic_model->save();
            return array('status' => true, 'data' => 'Session Has Been Created');
        }

        else
        {
            return array('status' => false, 'data' => $academic_model->errors);
        }

    } 

    public function actionAddstudent()
    {

        $student_signup_model = new SignupForm();
        $student_model_data = new Student();
        $user_organization_model = new User_organization();
        
        $student_signup_model->attributes = Yii::$app->request->post();
        $student_model_data->attributes = Yii::$app->request->post();
        
        $student_signup_model->role_id = 2; 

        $validate_student = $student_signup_model->validate(['first_name','last_name','email','password','role_id']);

        if($validate_student && $student_model_data->validate())
        {
            $student_signup_model->signup();
            $model = User::find('id','role_id')->where(['email' => $student_signup_model->email])->one();

            $student_model_data->ref_id = $model->id;
            //$student_model_data->save();

            $organization_model = Organization::find('id')->where(['creator_id' => $this->active_id])->one();

            if(!$organization_model)
            {
                return "Sorry, Organization Not Found";
            }

            else
            {
                $user_organization_model->user_id = $model->id;
                $user_organization_model->role_id = $model->role_id;
                $user_organization_model->organization_id = $organization_model->id;

                if($user_organization_model->validate())
                {
                    $student_model_data->save();
                    $user_organization_model->save();
                    return array('status' => true, 'data' => 'Student Record Has Been Created');
                }  
            }
        }
        else
        {
            return array('status' => false, 'data' => [$student_signup_model->errors,$student_model_data->errors]);   
        }

    }

    public function actionAddprogram()
    {
        $program_model = new Program();

        $program_model->attributes = Yii::$app->request->post();

        if($program_model->validate())
        {
            $program_model->save();
            return array('status' => true, 'data' => 'Program Has Been Created Successfully');
        }
        else
        {
            return array('status' => false, 'data' => $program_model->errors);   
        }
    }

    public function actionAddinstructor()
    {
        $instructor_signup_model = new SignupForm();
        $instructor_model_data = new Instructor();
        $user_organization_model = new User_organization();
        
        $instructor_signup_model->attributes = Yii::$app->request->post();
        $instructor_model_data->attributes = Yii::$app->request->post();

        $instructor_signup_model->role_id = 3; 

        $validate_instructor = $instructor_signup_model->validate(['first_name','last_name','email','password','role_id']);

        if($validate_instructor && $instructor_model_data->validate())
        {
            $instructor_signup_model->signup();
            $model = User::find('id','role_id')->where(['email' => $instructor_signup_model->email])->one();

            $instructor_model_data->ref_id = $model->id;
            //$student_model_data->save();

            $organization_model = Organization::find('id')->where(['creator_id' => $this->active_id])->one();

            if(!$organization_model)
            {
                return "Sorry, Organization Not Found";
            }

            else
            {
                $user_organization_model->user_id = $model->id;
                $user_organization_model->role_id = $model->role_id;
                $user_organization_model->organization_id = $organization_model->id;

                if($user_organization_model->validate())
                {
                    $instructor_model_data->save();
                    $user_organization_model->save();
                    return array('status' => true, 'data' => 'Instructor Record Has Been Created');
                }  
            }
        }
        else
        {
            return array('status' => false, 'data' => [$instructor_signup_model->errors,
                $instructor_model_data->errors]);   
        }
    }
   
}