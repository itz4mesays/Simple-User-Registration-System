<?php

use yii\db\Schema;
use yii\db\Migration;

class m160910_234811_create_user_registration_details extends Migration
{
    public function up()
    {
        $this->createTable('registration_details', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'firstname' => Schema::TYPE_STRING,
            'lastname' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'phone_number' => Schema::TYPE_STRING,
            'birthday' => Schema::TYPE_DATE
        ],'ENGINE=InnoDB');

        //Create Foreign Key
        $this->addForeignKey(
            'fk_registration_details_user',
            'registration_details',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_registration_details_user', 'registration_details');
        $this->dropTable('registration_details');
    }
    
}
