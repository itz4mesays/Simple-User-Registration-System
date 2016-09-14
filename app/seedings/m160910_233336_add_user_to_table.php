<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;

class m160910_233336_add_user_to_table extends Migration
{
    public function up()
    {
        //Seeding to insert a data into the database
        $this->insert('user', [
            'username' => 'admin123',
            'password' => Yii::$app->security->generatePasswordHash('admin123'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        return false;
    }
    
}
