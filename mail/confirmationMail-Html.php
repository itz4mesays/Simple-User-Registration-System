<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<h2>Hello, <?= $username ?> </h2>

<p>Your registration on the <?= Yii::$app->params['siteName'] ?> was successful.</p>

<p>Your Login details:</p>
<p>Username: <?php echo $username ?></p>
<p>Password: <?php echo $password ?></p>
<p>Click <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['site/login']) ?>"> here </a> to login</p>
