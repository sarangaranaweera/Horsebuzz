<?php

use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\ArrayHelper;
use common\models\Event;
use kartik\grid\GridView;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CheckinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Checkins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Button::widget([
        'label' => 'Message',
        'options' => ['class' => 'btn-info'],
    ]);
    ?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'showOnEmpty'=>true,

        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [

                'attribute' => 'event_id',
                'label' => 'Event Title',
                'value' => 'event.title'
            ],
            [
                'attribute' => 'fullName',
                'label' => 'Name',
                'value' => 'users.fullname',
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Email',
                'value' => 'users.email',
            ],

            'user_type',
            //'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',



        ],
    ]);
 ?>




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
