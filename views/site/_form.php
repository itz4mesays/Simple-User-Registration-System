<?php
use yii\widgets\ActiveForm;

use yii\helpers\Html;
use yii\i18n\Formatter;

?>

<?php $form = ActiveForm::begin(['id' => 'edit-form']) ?>
    <div class="form-group col-sm-8">
        <label class="requiredField">Email</label>
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            </div>
          <input type="email" class="form-control" id="email" 
          placeholder="Email address" 
          name="Registration[email]" required
          value="<?php echo Html::encode($model->details->email) ?>">
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
            title="letters only"
            value="<?php echo Html::encode($model->details->firstname) ?>">
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
            title="letters only"
            value="<?php echo Html::encode($model->details->lastname) ?>">
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
            title="Phone Number Format: +234(99)9999-9999"
            value="<?php echo Html::encode($model->details->phone_number) ?>">
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
             title="Format: YYYY-MM-DD"
             value="<?php echo Html::encode($model->details->birthday) ?>">
        </div>
    </div>


      <div class="form-group col-sm-7">
          <?php echo Html::submitButton('
          	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save Data', [
          		'class' => 'btn btn-default'
          ]) ?>
      </div>
<?php ActiveForm::end() ?>