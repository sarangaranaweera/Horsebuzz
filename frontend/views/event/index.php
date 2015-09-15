<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Areaintrest;
use yii\helpers\Url;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="common-button">
    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>
    </div>


   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($modal, $key, $index, $grid) {

            if ($modal->is_active == '0') {
                return ['class' => 'danger action-tr','id' => $modal['id'],'data-link' => urldecode(Url::toRoute(['/checkin/index', 'id' => $modal['id']])) ];
            } else
                return ['class' => 'success action-tr','id' => $modal['id'],'data-link' => urldecode(Url::toRoute(['/checkin/index', 'id' => $modal['id']])) ];

        },



        'columns' => [

            [
                'attribute' => 'interest_id',
                'label' => 'Event Category',
                'value' => 'interest.area_intrest',
            ],
            'title',
            'description:html',
            'location',
            'start_date',
            // 'is_active:boolean',
            // 'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{index} {view} {update} {delete} ',
                'contentOptions' => ['class'=>'action-td'],
                'buttons' => [

                    'index' => function ($url,$model) {

                        return Html::a('<span class="glyphicon glyphicon-user"></span>', $url);

                    },
                ]

            ],
        ]
    ]);
   ?>
    <?php
    // You only need add this,
    $this->registerJs('
        var gridview_id = ""; // specific gridview
        var columns = [1]; // index column that will grouping, start 1

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

  <!--
        $this->registerJs("

            $('a').click(function (e) {
                var id = $(this).closest('tr').data('id');
                    location.href = '" . Url::to(['checkin/index']) . "?id=' + (this.id);
                        });
                ");

 -->

    <?php
    $this->registerJs("
    $(document).ready(function(){
        $('.action-tr').on('click', 'td:not(.action-td)', function(){

            //get the link from data attribute
            var the_link = $(this).parent().attr('data-link');

            //do we have a valid link
            if (the_link == '' || typeof the_link === 'undefined') {
            //do nothing for now
            }
            else {
            //open the page
            window.location = the_link;
            }
        });
    });
"); ?>



</div>
