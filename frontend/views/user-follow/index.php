<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserFollowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Follows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-follow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Follow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn',
              
        // 'checkboxOptions' => function($model, $key, $index, $column) {
        //           return ['value' => $key];
        //     }
       ],

            'id',
            'firstname',
            'lastname',
            //'lastname',
            // 'is_follow:boolean',
            // 'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Send Message</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
        <?= Html::csrfMetaTags() ?>
      <label class="form-group">Message:</label>
      <!-- <input type="hidden" value="bnZ4aVhIMFEpARk5KwcFMlslGygKAkIHOT0SDBYcVB49NCItAQlXJw==" name="_csrf" > -->
      <textarea class="form-group" name="message"></textarea>
      <br>
      <label>Attach File:</label>
      <input type="file" name="attach_file">
      <input type="hidden" name="event_id" value="<?php //echo $model->id;?>">
      <br>
      <input type="submit" value="send" class="btn btn-success">
      <!-- <button class="btn btn-success" id="btn_snd">Send</button> -->
  </form>
  </div>
    </div>
  </div>
</div>

</div>
