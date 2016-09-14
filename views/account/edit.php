<?php

use yii\helpers\Html;
use yii\i18n\Formatter;
/* @var $this yii\web\View */
$this->title = 'Edit Account Details';

?>

<div class="container">
	<h3>Edit Account Details</h3>
	<div class="clear-fix"></div>
  <?php if (Yii::$app->session->hasFlash('failed')): ?>
      <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo Yii::$app->session->getFlash('failed') ?>
      </div>
    <?php endif ?>
	<div class="row">
		<?php echo $this->render('/site/_form', compact('model')) ?>
	</div>
</div>


<?php $this->registerJs("
    $('.requiredField').append('<span class=error> *</span>');
") ?>