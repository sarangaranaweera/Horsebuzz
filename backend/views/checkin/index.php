<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CheckinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Checkin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'users.username',
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Users::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
            ],

            'event.title',
            [
                'attribute' => 'user_type',
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Checkin::find()->orderBy('user_type')->asArray()->all(), 'id', 'user_type'),
            ],
            'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
    // You only need add this,
    $this->registerJs('
        var gridview_id = ""; // specific gridview
        var columns = [2]; // index column that will grouping, start 1

        var column_data = [];
            column_start = [];
            rowspan = [];

        for (var i = 0; i < columns.length; i++) {
            column = columns[i];
            column_data[column] = "";
            column_start[column] = null;
            rowspan[column] = 1;
        }

        var row = 1;
        $(gridview_id+" table > tbody  > tr").each(function() {
            var col = 1;
            $(this).find("td").each(function(){
                for (var i = 0; i < columns.length; i++) {
                    if(col==columns[i]){
                        if(column_data[columns[i]] == $(this).html()){
                            $(this).remove();
                            rowspan[columns[i]]++;
                            $(column_start[columns[i]]).attr("rowspan",rowspan[columns[i]]);
                        }
                        else{
                            column_data[columns[i]] = $(this).html();
                            rowspan[columns[i]] = 1;
                            column_start[columns[i]] = $(this);
                        }
                    }
                }
                col++;
            })
            row++;
        });
    ');
    ?>



</div>
