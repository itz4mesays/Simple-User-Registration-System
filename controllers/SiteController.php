<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Registration;
use app\models\User;
use yii\base\ErrorException;

class SiteController extends Controller
{
    public $layout = "/main";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Registration();
        $user = new User();
        if(Yii::$app->request->post()){

            $transaction = Yii::$app->db->beginTransaction();
            
            try {
                $user->username = $_POST['User']['username'];
                $password = substr($user->username, 0,3).substr($_POST['Registration']['phone_number'], 1,5);
                $user->password_hash = Yii::$app->security->generatePasswordHash($password);
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->save();
                
                $auth = Yii::$app->authManager; // Assign user role
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());

                $model->user_id = $user->getId();
                $model->firstname = $_POST['Registration']['firstname'];
                $model->lastname = $_POST['Registration']['lastname'];
                $model->email = $_POST['Registration']['email'];
                $model->phone_number = $_POST['Registration']['phone_number'];
                $model->birthday = $_POST['Registration']['birthday'];
                $model->save(false);                

                $transaction->commit();
                $user->successMessage($model->email, $password ); //Send email
                Yii::$app->session->setFlash('created','User has been created successfully');

                return $this->refresh();
            } catch (ErrorException $e) {
                $transaction->rollBack();
                Yii::warning("Opps!, Something went wrong while trying to register user");
            }
                     
        }
        return $this->render('index', compact(
            'model', 
            'user'
        ));
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(['account/']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
