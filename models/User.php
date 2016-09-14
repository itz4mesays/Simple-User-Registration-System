<?php

namespace app\models;
use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
    // public $password_hash;
    // public $authKey;
    // public $accessToken;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['username','password_hash'], 'required'],
             ['username','unique'],
             ['username','email','on'=>'checkPassword']  
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username'=> 'Email Address',
            'password_hash' => 'Password',
            'old_password' => 'Current Password',
            'new_password' => 'New Password',
            'repeat_new_password' => 'Confirm New Password'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function checkPassword($attribute, $params)
    {

        if(!$this->hasErrors()){
            $id = Yii::$app->user->id;
            $user = User::findOne($id);
            
            if (!$this->getUserPassword() || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Incorrect Old Password. Enter your current password');
            } 
        }
        
    }

    protected function getUserPassword()
    {
        return Yii::$app->user->identity->password_hash;
    }

    /*
    **Create a scenarios
    */

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function SocialFindByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
       }
       
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

        /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
    * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
 

 /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


   /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function getRoles()
    {
        return $this->hasOne(AuthAssignment::className(),['user_id'=>'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasOne(Registration::className(), ['user_id' => 'id']);
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function successMessage($email, $pass)
    {
        Yii::$app->mailer->compose('confirmationMail-Html',[
                'username'=> $this->username,
                'password' => $pass
            ])
            ->setTo($email)
            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->params['siteName']])
            ->setSubject(\Yii::$app->params['mailSuccess'])
            ->send();
    }

}