<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\YiiAsset;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\ActivityDatas $model */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = ['label' => 'กิจกรรมหมอกควัน', 'url' => ['index']];
YiiAsset::register($this);

$js = <<< JS
    $(document).on('click', '.show-file', function(){
        let url = $(this).attr('href');
        let extension = url.split('.').pop().toLowerCase();
        if (extension === 'pdf') {
            $('#modal-show .modal-body').html("<embed src='"+url+"' frameborder='0' width='100%' height='400px'>");
        } else {
            $('#modal-show .modal-body').html("<img src='"+url+"' class='img-fluid' alt='image'>");
        }
        $('#modal-show').modal('show');
        return false;
    });
JS;
$this->registerJs($js);


echo Modal::widget([
    'id' => 'modal-show',
    'size' => Modal::SIZE_EXTRA_LARGE,
]);
?>

<div class="activity-datas-view">
    <?= DetailView::widget([
        'model' => $model,
        'mode' => DetailView::MODE_VIEW,
        'attributes' => [
            [
                'group' => true,
                'label' => $model->chospital->hosname,
                'rowOptions' => ['class' => 'table-success'],
            ],
            [
                'label' => 'ประเภทกิจกรรม',
                'value' => $model->activity->des,
            ],
            [
                'label' => 'วันที่',
                'value' => $model->activity_date,
            ],
            [
                'group' => true,
                'label' => 'รายละเอียด',
                'rowOptions' => ['class' => 'table-info'],
            ],
            [
                'group' => true,
                'label' => $model->content,
                'groupOptions' => ['style' => 'font-weight: normal;'],
            ],
            'create_date',
        ],
    ]) ?>

    <?php
    if ($dataProvider->count > 0) {
        echo "<h3>ไฟล์ประกอบ</h3>";
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_files',
        ]);
    }
    ?>
</div>
