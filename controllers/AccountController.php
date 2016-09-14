<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use app\models\User;
use app\models\Registration;
use app\models\RegistrationSearch;
use yii\web\NotFoundHttpException;
class AccountController extends \yii\web\Controller
{
	public $layout = "//dashboard";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'edit'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'delete'],
                        'roles' => ['admin'],
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

    public function actionIndex()
    {
    	if(Yii::$app->user->can('user')){
    		$model = User::findOne(Yii::$app->user->id); //Select a single record using the id
    	}
    	
    	$searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //Equivalent to passing $_GET to a function called search
        return $this->render('index', compact(
        	'model', 
        	'searchModel', 
        	'dataProvider'
        ));
    }

    /**
     * Edit an account
     * 
     * 
     * @author Oyedele Olufemi 
     **/
    public function actionEdit()
    {
    	if(Yii::$app->user->can('user')){
    		$model = User::findOne(Yii::$app->user->id);
    		if(Yii::$app->request->post()){
    			$model->details->firstname = $_POST['Registration']['firstname'];
    			$model->details->lastname = $_POST['Registration']['lastname'];
    			$model->details->email = $_POST['Registration']['email'];
    			$model->details->phone_number = $_POST['Registration']['phone_number'];
    			$model->details->birthday = $_POST['Registration']['birthday'];
    			if($model->details->save(false)){
    				Yii::$app->session->setFlash('saved','Account details saved successfully');

    				$this->redirect(['index']);
    			}else{
    				Yii::$app->session->setFlash('failed','Sorry, something happened while saving. Please try again');
    			}

    		}
    		return $this->render('edit', compact('model'));
    	}else{return $this->goBack();}
    	
    }

    /**
     * Displays a single Registration model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if(Yii::$app->user->can('admin')){
    		return $this->render('view', [
	            'model' => $this->findModel($id),
	        ]);
    	}else{return $this->goBack();}
        
    }

      /**
     * Updates an existing Registration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {	
    	if(Yii::$app->user->can('admin')){
	        $model = $this->findUserModel($id);
	        if (Yii::$app->request->post()) {
	        	$model->details->firstname = $_POST['Registration']['firstname'];
				$model->details->lastname = $_POST['Registration']['lastname'];
				$model->details->email = $_POST['Registration']['email'];
				$model->details->phone_number = $_POST['Registration']['phone_number'];
				$model->details->birthday = $_POST['Registration']['birthday'];
				if($model->details->save(false)){
					Yii::$app->session->setFlash('saved','Account details saved successfully');

					$this->redirect(['view', 'id' => $model->id]);
				}else{
					Yii::$app->session->setFlash('failed','Sorry, something happened while saving. Please try again');
				}
	            return $this->redirect(['view', 'id' => $id]);
	        } else {
	            return $this->render('edit', compact('model'));
	        }
	    }else{return $this->goBack();}
    }

    /**
     * Deletes an existing Registration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if(Yii::$app->user->can('admin')){
    		$this->findUserModel($id)->delete(); //Delete user details using user_id above since it is cascaded
    		Yii::$app->session->setFlash('deleted','Account details has been deleted');
        	return $this->redirect(['index']);
    	}else{return $this->goBack();}
        
    }

    /**
     * Finds the Registration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Registration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findUserModel($id)
    {
        if (($model = User::findOne($this->findModel($id)->user_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
