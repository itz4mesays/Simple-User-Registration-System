<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\i18n\Formatter;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
$this->title = 'Account Dashboard';

?>

<div class="container">
	<?php if(Yii::$app->user->can('user')) :?>
		<h3>Your Account Details</h3>
		<code>Your profile information are displayed below</code>
		<div class="clear-fix"></div>
		<?php if (Yii::$app->session->hasFlash('saved')): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  	<?php echo Yii::$app->session->getFlash('saved') ?>
			</div>
		<?php endif ?>
		<div class="row table-responsive col-sm-9">
			<table class="table table-striped">
				<tr>
					<th width="300">Username:</th>
					<td><?php echo Html::encode($model->username) ?></td>
				</tr>
				<tr>
					<th width="300">Firstname:</th>
					<td><?php echo Html::encode($model->details->firstname) ?></td>
				</tr>
				<tr>
					<th width="300">Lastname:</th>
					<td><?php echo Html::encode($model->details->lastname) ?></td>
				</tr>
				<tr>
					<th width="300">Email:</th>
					<td><?php echo Html::encode($model->details->email) ?></td>
				</tr>
				<tr>
					<th width="300">Phone Number:</th>
					<td><?php echo Html::encode($model->details->phone_number) ?></td>
				</tr>
				<tr>
					<th width="300">BirthDay:</th>
					<td><?php echo Html::encode($model->details->birthday) ?></td>
				</tr>
				<tr>
					<th width="300">Registration Date:</th>
					<td><?php echo Yii::$app->formatter->asDate(Html::encode($model->created_at), 'full') ?></td>
				</tr>
			</table>
		</div>
	<?php else: ?>
		<h3>My Dashboard</h3>
		<code>Table showing list of all registered users</code>
		<div class="clear-fix"></div>
		<?php if (Yii::$app->session->hasFlash('deleted')): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  	<?php echo Yii::$app->session->getFlash('deleted') ?>
			</div>
		<?php endif ?>
		<p class="pull-right">
	        <?php echo Html::a('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Registration', [
	        	'site/index'], [
	        		'class' => 'btn btn-primary', 
	        		'target' => '_blank'
	        ]) ?>
	    </p>
	    <?php Pjax::begin(['enablePushState' => false]) ?>
		    <?php echo GridView::widget([
		        'dataProvider' => $dataProvider,
		        'filterModel' => $searchModel,
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            'firstname',
		            'lastname',
		            'email:email',
		            'phone_number',
		            'birthday',

		            [
		            	'class' => 'yii\grid\ActionColumn',
		            	'header' => 'Operations',
		                'headerOptions'=>['width'=>50],
		            ],
		        ],
		    ]); ?>
		    <?php Pjax::end() ?>
	<?php endif ?>
</div>
