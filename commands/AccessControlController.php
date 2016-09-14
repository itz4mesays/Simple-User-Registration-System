<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class AccessControlController extends Controller
{
   public function actionInit()
   {
       $auth = Yii::$app->authManager;

       $user = $auth->createRole('user'); //Create User Role
       $auth->add($user);
       
       $admin = $auth->createRole('admin'); //Create Admin Role
       $auth->add($admin);

       $auth->assign($admin, 1);
   }
}
