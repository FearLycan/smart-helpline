<?php

use app\modules\admin\components\Helpers;
use app\modules\admin\models\forms\ContractForm;
use dominus77\tinymce\components\MihaildevElFinder;
use dosamigos\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(['id' => 'contract-form']); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'airline_name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'contract_validity_from')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Choose date'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'contract_validity_to')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Choose date'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'contract_description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!--<div class="row">

        <div class="col-md-6">
            <?/*= $form->field($model, 'routing_subcat_1')->textInput(['maxlength' => true])->label('Between No. 1') */?>
        </div>

        <div class="col-md-6">
            <?/*= $form->field($model, 'routing_subcat_1_description')->textInput(['maxlength' => true])->label('Between No. 1 Description') */?>
        </div>

        <div class="col-md-6">
            <?/*= $form->field($model, 'routing_subcat_2')->textInput(['maxlength' => true])->label('Between No. 2') */?>
        </div>

        <div class="col-md-6">
            <?/*= $form->field($model, 'routing_subcat_2_description')->textInput(['maxlength' => true])->label('Between No. 2 Description') */?>
        </div>

    </div>-->

    <?= $form->field($model, 'infant_fares')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'ticket_designator')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'tour_code')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'endorsment')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'mixed_classes')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'interline')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'codeshares')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'note')->widget(TinyMce::className(), [
        'options' => ['rows' => 5],
        'language' => 'en',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'additional_fields')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <p class="text-right">
                <a href="javascript:void(0);" id="add" class="btn btn-success">Add field</a>
            </p>
        </div>

        <div id="fields"></div>

        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->beginBlock('script') ?>
<script>
    var $fields = $('#fields');

    var i = 0;

    <?php if(!empty($model->additional_fields)): ?>

    var array = JSON.parse('<?= $model->additional_fields ?>');

    for (var j = 1; j < array.length; j += 2) {
        $fields.append('' +
            '<div class="col-md-4" data-id="' + i + '">' +
            '<div class="form-group">' +
            '<label for="new_label_' + i + '">Label name</label>' +
            '<input type="text" value="' + array[j - 1] + '" class="form-control" data-id="' + i + '" id="new_label_' + i + '" name="new_label_' + i + '" required>' +
            '</div>' +
            '</div>' +
            '');

        //value
        $fields.append('' +
            '<div class="col-md-6" data-id="' + i + '">' +
            '<div class="form-group">' +
            '<label for="new_value_' + i + '">Value</label>' +
            '<input type="text" value="' + array[j] + '" class="form-control" data-id="' + i + '" id="new_value_' +i + '" name="new_value_' + i + '" required>' +
            '</div>' +
            '</div>' +
            '');

        //przyciski
        //$fields.append('<div class="col-md-1 text-right" data-id="' + j - 1 + '"> <a style="margin-top: 25px;" data-id="' + j - 1 + '" href="javascript:void(0);" class="btn btn-primary save">Save</a></div>');
        $fields.append('<div class="col-md-2 text-right" data-id="' + i + '"> <a style="margin-top: 25px;" data-id="' + i + '" href="javascript:void(0);" class="btn btn-danger remove">Remove</a></div>');

        i++;
    }

    <?php endif; ?>

    $("#add").click(function () {

        //label
        $fields.append('' +
            '<div class="col-md-4" data-id="' + i + '">' +
            '<div class="form-group">' +
            '<label for="new_label_' + i + '">Label name</label>' +
            '<input type="text" class="form-control" data-id="' + i + '" id="new_label_' + i + '" name="new_label_' + i + '" required>' +
            '</div>' +
            '</div>' +
            '');

        //value
        $fields.append('' +
            '<div class="col-md-6" data-id="' + i + '">' +
            '<div class="form-group">' +
            '<label for="new_value_' + i + '">Value</label>' +
            '<input type="text" class="form-control" data-id="' + i + '" id="new_value_' + i + '" name="new_value_' + i + '" required>' +
            '</div>' +
            '</div>' +
            '');

        //przyciski
        //$fields.append('<div class="col-md-1 text-right" data-id="' + i + '"> <a style="margin-top: 25px;" data-id="' + i + '" href="javascript:void(0);" class="btn btn-primary save">Save</a></div>');
        $fields.append('<div class="col-md-2 text-right" data-id="' + i + '"> <a style="margin-top: 25px;" data-id="' + i + '" href="javascript:void(0);" class="btn btn-danger remove">Remove</a></div>');

        i++;

        $(".remove").click(function () {
            var id = $(this).data('id');
            $('div[data-id="' + id + '"]').remove();
        });

    });

    $(".remove").click(function () {
        var id = $(this).data('id');
        $('div[data-id="' + id + '"]').remove();
    });

    $('#contract-form').on('beforeSubmit', function (e) {

        var array = [];
        $('#fields :input').each(function () {
            array.push($(this).val());
        });

        var json = JSON.stringify(array);

        $("#contractform-additional_fields").val(json);

        return true;
    });

</script>
<?php $this->endBlock() ?>



