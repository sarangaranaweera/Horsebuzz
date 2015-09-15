<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AreaintrestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areaintrests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areaintrest-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Areaintrest', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($modal) {

            if($modal->is_active == '0'){
                return['class'=>'danger'];
            }
            else
                return['class'=>'success'];


        },
        'columns' => [

            'area_intrest',
            'is_active:boolean',
            //'is_deleted:boolean',
            'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
