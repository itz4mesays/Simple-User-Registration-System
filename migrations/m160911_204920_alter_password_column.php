<?php

use yii\db\Schema;
use yii\db\Migration;

class m160911_204920_alter_password_column extends Migration
{
    public function up()
    {
        $this->renameColumn('user', 'password', 'password_hash');
    }

    public function down()
    {
        return false;
    }
    
}
