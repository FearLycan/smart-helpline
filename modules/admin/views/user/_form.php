<?php

use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        //'validateOnType' => true,
        //'validateOnSubmit' => true,
        //'validateOnChange' => true,
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'role')->dropDownList(User::getRolesNames()) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(User::getStatusNames()) ?>
        </div>

        <div class="col-md-6">
            <div class="col-md-8">
                <?= $form->field($model, 'password')->textInput(['maxlength' => true, 'id' => 'user-password']) ?>
            </div>

            <div class="col-md-4 text-right">
                <label>Losowe hasło</label>
                <a href="javascript:void(0);" id="random" class="btn btn-primary">Wylosuj</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'categories_list')
                ->checkboxList(ArrayHelper::map(app\modules\admin\models\Category::find()->all(), "id", "name"), ['itemOptions' => [
                    'class' => 'checkbox-space',
                ]]); ?>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'contract_list')
                ->checkboxList(ArrayHelper::map(app\modules\admin\models\Contract::find()->all(), "id", "airline_name"), ['itemOptions' => [
                    'class' => 'checkbox-space',
                ]]); ?>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'message')->checkbox(); ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php $this->beginBlock('script') ?>
<script>

    function random(n) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&";

        for (var i = 0; i < n; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    $("#random").click(function () {
        $("#user-password").val(random(7));
    });
</script>
<?php $this->endBlock() ?>
