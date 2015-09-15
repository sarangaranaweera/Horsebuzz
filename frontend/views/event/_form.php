<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Areaintrest;
use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
frontend\assets\AppAsset::register($this);
?>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet" />

<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places">
</script>
<div class="event-form">

    <span class="label label-danger">Fields marked with * are mandatory</span>
    <p></p>
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-event-form'
        ]
    ]); ?>


    <?= $form->field($model, 'interest_id')->dropDownList(
        ArrayHelper::map(Areaintrest::find()->all(),'id','area_intrest'),
        ['prompt'=> 'Select Event Category']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>


    <?= $form->field($model,'location')->textInput(['class' => 'placepicker form-control'])  ?>

    <?= $form->field($model, 'eopen_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eopen_date',
        'options' => ['placeholder' => 'Select Entries open time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'orientation' => 'top',
            'format' => 'd-M-y hh:i ',
            'startDate' => date('yyyy-MM-dd hh:ii:ss'),
            'autoclose'=>true,
            'todayHighlight' => true
        ]
    ])
    ?>

    <?= $form->field($model, 'eclose_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eclose_date',
        'options' => ['placeholder' => 'Select Entries close time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'orientation' => 'top',
            'format' => 'd-M-y hh:i ',
            'autoclose'=>true,
            'startDate' => date('yyyy-MM-dd hh:ii:ss'),
            'todayHighlight' => true
        ]
    ])
    ?>

    <?=
        DatePicker::widget([
            'model' => $model,
            'name' => 'from_date',
            'attribute' => 'start_date',
            'attribute2' => 'end_date',

            'options' => ['placeholder' => 'Select Event start date ...'],
            'options2' => ['placeholder' => 'Select Event end date ...'],
            'value' => '01-Feb-1996',
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'to_date',
            'value2' => '27-Feb-1996',

            'pluginOptions' => [

                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
        ]
    ]);

    ?>


    <p></p>
    <h4>
    <span class="label label-info">By Clicking the Create button the Event will be automatically posted on HorseBuzz mobile app</span>
    </h4>
    <p></p>


    <di"form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    $(document).ready(function() {

        // Basic usage
        $(".placepicker").placepicker();

        // Advanced usage
        $("#advanced-placepicker").each(function() {
            var target = this;
            var $collapse = $(this).parents('.form-group').next('.collapse');
            var $map = $collapse.find('.another-map-class');

            var placepicker = $(this).placepicker({
                map: $map.get(0),
                placeChanged: function(place) {
                    console.log("place changed: ", place.formatted_address, this.getLocation());
                }
            }).data('placepicker');
        });

    }); // END document.ready

</script>
