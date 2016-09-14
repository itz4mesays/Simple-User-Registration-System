<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;
use app\models\Registration;

class m160912_000033_registration_seed_data extends Migration
{
    public function up()
    {
        $faker = Faker\Factory::create();
        $random = rand(1,999);
        for ($i=0; $i < 30; $i++) { 
            $user = $this->insert('user', [
                'username' => $faker->name.$random,
                'password_hash' => Yii::$app->security->generatePasswordHash($faker->sentence(8)),
                'auth_key' => Yii::$app->security->generateRandomString(),
            ]);
            $user_id = Yii::$app->db->getLastInsertID();
            $auth = Yii::$app->authManager; // Assign user role
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $user_id);

            $this->insert('registration_details', [
                'user_id' => $user_id,
                'firstname' =>  $faker->name,
                'lastname' =>  $faker->name,
                'email' =>  $faker->email,
                'phone_number' =>  $faker->phoneNumber,
                'birthday' =>  $faker->dateTimeThisYear->format('Y-m-d'),
            ]);
        }

    }

    public function down()
    {
        return false;
    }
}
