<?php

use yii\db\Schema;
use yii\db\Migration;

class m160910_232431_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('user',[
            'id' => Schema:: TYPE_PK,
            'username' => Schema:: TYPE_STRING. ' NOT NULL',
            'password' => Schema:: TYPE_STRING. ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING, 
            'password_reset_token'=> Schema:: TYPE_STRING. ' NOT NULL',
            'created_at' => Schema:: TYPE_DATETIME,
            'updated_at'  => Schema:: TYPE_DATETIME,
        ],'ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable('user');
    }

}
