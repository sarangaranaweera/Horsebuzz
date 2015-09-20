<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Event */


$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
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


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'interest.area_intrest',
            'title',
            'description:html',
            'location',
            'is_active:boolean',
            'created_date',
            [                      // the owner name of the model
                'label' => 'Created By',
                'value' => $model->organiser->username,
            ],


        ],
    ]) ?>
<?php $time='WELCOME';?>
<?php Pjax::begin(['timeout' => 3000 ]); ?>
<?= Html::a("Refresh", ['event/'.$model->id], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton']) ?>


<?php

foreach ($messages as $message) {
   
    ?>

    <div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="<?php ?>" alt="...">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?php echo $message['firstname'];?></h4>
    
    <?php echo $message['message'] ;?>
  </div>
</div>
<?php }

?>

<?php Pjax::end(); ?>

</div>
