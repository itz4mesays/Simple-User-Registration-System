<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'User Registration Application';

?>
<div class="container">
    <div class="jumbotron">
        <div class="row">
             <h2>Welcome to Our Site</h2>
             <p>This website was developed to help visitors sign up for their account and also have access to it</p>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <?php if (Yii::$app->session->hasFlash('created')): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title"> 
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            Registration Complete
                        </h2>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success">
                            A confirmation link containing your login details has be sent to your email address. 
                            Please check your <code>Inbox/Spam</code> folder.
                        </div>
                    </div>
                </div>
            <?php else: ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title"> 
                        <span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
                        Sign Up For an Account
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="alert alert-success">
                        A confirmation link containing your login details will be sent to your email address. 
                        Please check your <code>Inbox/Spam</code> folder.
                    </div>
                    <small>Please note that all astericks (*) fields are required</small>

                    <div class="clear-fix"></div>
                    <?php $form = ActiveForm::begin(['id' => 'sign-up-form']) ?>
                        <div class="form-group col-sm-8">
                            <label class="requiredField">Username</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </div>
                              <input type="text" class="form-control" id="username" 
                                placeholder="Alphanumeric Characters Only" 
                                name="User[username]" 
                                pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,30}$" required
                                title="Alpha Numeric Characters Only">
                            </div>
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="requiredField">Email</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                </div>
                              <input type="email" class="form-control" id="email" 
                              placeholder="Email address" 
                              name="Registration[email]" required>
                            </div>
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="requiredField">Firstname</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </div>
                              <input type="text" class="form-control" id="firstname" 
                                placeholder="Enter your firstname" 
                                name="Registration[firstname]" required 
                                pattern="[A-Za-z]+"
                                maxlength="50" 
                                title="letters only">
                            </div>
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="requiredField">Lastname</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </div>
                              <input type="text" class="form-control" id="lastname" 
                                placeholder="Enter your lastname" 
                                name="Registration[lastname]" required 
                                pattern="[A-Za-z]+"
                                maxlength="50"  
                                title="letters only">
                            </div>
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="requiredField">Phone Number</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                </div>
                              <input type="text" class="form-control" id="phone" 
                                placeholder="Enter your Phone Number" 
                                name="Registration[phone_number]" required 
                                pattern= "[\+]\d{3}[\(]\d{2}[\)]\d{4}[\-]\d{4}"
                                title="Phone Number Format: +234(99)9999-9999">
                            </div>
                        </div>

                        <div class="form-group col-sm-8">
                            <label class="requiredField">BirthDay</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                </div>
                              <input type="text" class="form-control" id="birthday"
                                 placeholder="YYYY-MM-DD" 
                                 name="Registration[birthday]" required 
                                 pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                                 title="Format: YYYY-MM-DD">
                            </div>
                        </div>


                          <div class="form-group col-sm-7">
                              <?php echo Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
                          </div>
                    <?php ActiveForm::end() ?>

                </div>
            </div>
            <?php endif ?>            
        </div>
        </div>
</div>


<?php $this->registerJs("
    $('.requiredField').append('<span class=error> *</span>');
") ?>