<?php

use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ProfileForm */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['update']];
$this->params['breadcrumbs'][] = $this->title;
\frontend\assets\AppAsset::register($this);
?>


<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet" />


<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places">
</script>

<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <span class="label label-danger">Fields marked with * are mandatory</span>
            <p></p>
            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model, 'username')->textInput( ['data-toggle' => 'tooltip',
                'data-placement' =>
                    'right',
                'title' => 'Username should contain at least 6 characters'
            ]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'firstname')->textInput(['data-toggle' => 'tooltip',
                'data-placement' =>
                    'right',
                'title' => 'Firstname should contain at least 2 characters',

            ]) ?>

            <?= $form->field($model, 'lastname')->textInput(['data-toggle' => 'tooltip',
                'data-placement' =>
                    'right',
                'title' => 'Lastname should contain at least 2 characters',

            ]) ?>

            <?= $form->field($model, 'dateofbirth')->widget(
                DatePicker::className(),[
                'name' => 'dateofbirth',
                'value' => $model->dateofbirth,
                'pluginOptions' => [
                    'orientation' => 'top',
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ?>
            <?= $form->field($model, 'phonenumber') ?>

            <?= $form->field($model, 'mobilenumber') ?>

            <?= $form->field($model, 'clubname') ?>

            <?= $form->field($model, 'address')->textInput(['class' => 'placepicker form-control']) ?>

            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic',
                'clientOptions' => [
                    'filebrowserUploadUrl' => Url::to(['ckeditor/url']),

                ]
            ]) ?>




            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-danger', 'name' => 'update-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
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

<style>

    .placepicker-map {
        width: 100%;
        height: 300px;
    }

</style>
