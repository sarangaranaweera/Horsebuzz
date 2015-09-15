<?php

use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Areaintrest;
use backend\assets;


/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
backend\assets\AppAsset::register($this);
?>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"></link>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet"></link>

<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places">
</script>
<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'organiser_id')->dropDownList(
            ArrayHelper::map(User::find()->all(),'organiser_id','username')
    ) ?>

    <?= $form->field($model, 'interest_id')->dropDownList(
        ArrayHelper::map(Areaintrest::find()->all(),'id','area_intrest'),
        ['prompt'=> 'Select Event Category']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'location')->textInput(['class' => 'placepicker form-control']) ?>


    <?= $form->field($model, 'eeopen_date')->widget(
        DateTimePicker::className(),[
            'name' => 'eeopen_date',
            'options' => ['placeholder' => 'Select Early Enteries open time ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:i ',
                'startDate' => date('yyyy-mm-dd hh:ii:ss'),
                'todayHighlight' => true
            ]
        ])
    ?>

    <?= $form->field($model, 'eopen_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eeopen_date',
        'options' => ['placeholder' => 'Select Enteries open time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:i ',
            'startDate' => date('yyyy-mm-dd hh:ii:ss'),
            'todayHighlight' => true
        ]
    ])
    ?>

    <?= $form->field($model, 'eclose_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eeopen_date',
        'options' => ['placeholder' => 'Select Enteries close time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:i ',
            'startDate' => date('yyyy-mm-dd hh:ii:ss'),
            'todayHighlight' => true
        ]
    ])
    ?>


    <?= $form->field($model, 'start_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eeopen_date',
        'options' => ['placeholder' => 'Select Event start time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:i ',
            'startDate' => date('yyyy-mm-dd hh:ii:ss'),
            'todayHighlight' => true
        ]
    ])
    ?>

    <?= $form->field($model, 'end_date')->widget(
        DateTimePicker::className(),[
        'name' => 'eeopen_date',
        'options' => ['placeholder' => 'Select Event close time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:i ',
            'startDate' => date('yyyy-mm-dd hh:ii'),
            'todayHighlight' => true
        ]
    ])
    ?>




    <?= $form->field($model, 'is_active')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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


