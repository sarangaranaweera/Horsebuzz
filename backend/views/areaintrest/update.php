<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Areaintrest */

$this->title = 'Update Areaintrest: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Areaintrests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="areaintrest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
