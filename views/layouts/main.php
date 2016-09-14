<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
    <nav class="navbar-inverse navbar-fixed-top">
          <div class="container" id="cont">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <?php echo Html::a('User Registration System', ['site/'], ['class' => 'navbar-brand']) ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <!-- <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li> -->
              </ul>
              <ul class="nav navbar-nav navbar-right">
              <?php if(Yii::$app->user->isGuest) :?>
                <li><?php echo Html::a('<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login', ['site/login']) ?></li>
              <?php else: ?>
                 <li><?php echo Html::a('<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard', ['account/']) ?></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span> My Account 
                      (<?php echo Yii::$app->user->identity->username ?>)<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <?php if(Yii::$app->user->can('user')) :?>
                            <li><?php echo Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Account', ['account/edit']) ?></li>
                        <?php endif ?>
                          <?php if(Yii::$app->user->can('admin')) :?>
                            <li><?php echo Html::a('<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> View Users', ['account/']) ?></li>
                          <?php endif ?>
                        <li><?php echo Html::a('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Off', [
                              'site/logout'
                          ],['data-method' => 'post']) ?>
                        </li>
                      </ul>
                    </li>
              <?php endif ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        

        <div class="container">
            <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php echo $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-right">&copy; User Registration System 
                <?php echo date('Y') ?>. Developed by <?php echo Yii::$app->params['dev_name'] ?>
            </p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
