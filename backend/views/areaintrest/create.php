<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Areaintrest */

$this->title = 'Create Areaintrest';
$this->params['breadcrumbs'][] = ['label' => 'Areaintrests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areaintrest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
