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
 

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ActiveController {

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
            'except' => ['options'],
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
        return Yii::$app->request->post();
    }

    
}