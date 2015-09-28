<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Event */


$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 10000);
});
JS;
$this->registerJs($script);



$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>




<?php

foreach ($messages as $message) {
   
    ?>
<div class="alert alert-warning" role="alert">
   <h4 class="media-heading"><?php echo $message['firstname'];?></h4>
    <?php echo $message['message'] ;?>
</div>
    
<?php }

?>

<?php //Pjax::end(); ?>
    <form action="/Horsebuzz/frontend/web/event/send" enctype="multipart/form-data" method="post" id="send_msg">


<?= GridView::widget([
    'dataProvider' => $dataProvider2,
    'columns' => [
        //'id',
    
       ['class' => 'yii\grid\CheckboxColumn',

        'checkboxOptions' => function($model, $key, $index, $column) {
                  return ['value' => $model['id']];
            }
       ],
         


        'firstname',
        'title',
        //'created_at:datetime',
        // ...
    ],
]) ?>

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
      <input type="hidden" name="event_id" value="<?php echo $model->id;?>">
      <br>
      <input type="submit" value="send" class="btn btn-success">
      <!-- <button class="btn btn-success" id="btn_snd">Send</button> -->
  </form>
  </div>
    </div>
  </div>
</div>
</div>
