<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */

$this->title = 'Account Information #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h2><?= Html::encode($this->title) ?></h2>

    <p class="pull-right">
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            More Actions
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><?php echo Html::a(' <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update', [
                'update', 
                'id' => $model->id
                ]) ?>
            </li>
            <li><?php echo Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete', [
                'delete', 
                'id' => $model->id], [
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="javascript:history.go(-1)"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Previous</a></li>
          </ul>
        </div>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'lastname',
            'email:email',
            'phone_number',
            'birthday',
            [
                'label' => 'Registration Date',
                'attribute' => 'registration_date',
                'value' => Html::encode($model->user->created_at),
            ],
        ],
    ]) ?>

</div>