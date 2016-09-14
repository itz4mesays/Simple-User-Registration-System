<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration_details".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone_number
 * @property string $birthday
 *
 * @property User $user
 */
class Registration extends \yii\db\ActiveRecord
{
    public $registration_date;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['user_id'], 'integer'],
            // [['birthday'], 'safe'],
            // [['firstname', 'lastname', 'email', 'phone_number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'birthday' => 'Birthday',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
