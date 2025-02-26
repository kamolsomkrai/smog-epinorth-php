<?php



/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */


use kartik\daterange\DateRangePicker;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Cprovince;
use app\models\Chospital;


$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] ='จำนวนผู้ป่วยหมอกควัน แยกกลุ่มเสี่ยง/โรคประจำตัว';


$JS = <<< JS
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.kv-grid-table').find('td').each(function(e){
            let val = parseInt($(this).text()) || false;
            
            if(val > 0 ){
                val = numberWithCommas(val);
                $(this).text(val);    
            }
            
    });
JS;

$this->registerJs($JS);
?>

<div class="report-report4">

    <form id="search" method="get" style="margin-bottom: 10px">
        <input type="hidden" name="r" value="<?=Yii::$app->request->get('r')?>">
        <div class="row">
            <div class="col-3">
                <label>วันที่</label>
                <?= DateRangePicker::widget([
                    'name'=>'date_range',
                    'language' => 'th',
                    'startAttribute' => 'from_date',
                    'endAttribute' => 'to_date',
                    'startInputOptions' => ['value' => Yii::$app->request->get('from_date')],
                    'endInputOptions' => ['value' => Yii::$app->request->get('to_date')],
                    'pluginOptions'=>[
                        'locale'=>[
                            'separator'=>' to ',
                        ],
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker'=>'function(ev, picker){
                                    $("#search").submit();
                                }'
                    ],
                ])?>
            </div>
            <div class="col-3">
                <div class="form-label">จังหวัด</div>
                <?=Select2::widget([
                    'name'=>'provcode',
                    'value' => Yii::$app->request->get('provcode'),
                    'data' => ArrayHelper::map(Cprovince::find()
                        ->where(['region'=>1])
                        ->asArray()->all(),'provcode','provname'),
                    'pluginOptions' => [
                        'allowClear'=>true,
                    ],
                    'options' => [
                        'placeholder'=>'----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select'=>'function(){
                                    $("#search").submit();
                                }',
                        'select2:clear'=>'function(){
                                    $("#hoscode").val(null).trigger("change");
                                    $("#search").submit();
                                }',
                    ],
                ])?>
            </div>
            <div class="col-3">
                <div class="form-label">โรงพยาบาล</div>
                <?= Select2::widget([
                    'id' => 'hoscode',
                    'name'=>'hoscode',
                    'data' => ArrayHelper::map(Chospital::find()
                        ->where(['provcode'=>Yii::$app->request->get('provcode')])
                        ->asArray()->all(),'hoscode','hosname'),
                    'value' => Yii::$app->request->get('hoscode'),
                    'options' => [
                        'placeholder'=>'----ทั้งหมด----'
                    ],
                    'pluginOptions' => [
                        'allowClear'=>true,
                    ],
                    'pluginEvents' => [
                        'select2:select'=>'function(){
                                    $("#search").submit();
                                }',
                        'select2:clear'=>'function(){
                                    $("#search").submit();
                                }',
                    ],
                ])?>
            </div>
        </div>
    </form>


    <?= GridView::widget([
        'responsiveWrap' => false,
        'containerOptions'=>['style'=>'overflow: auto;font-size: 12px;'],
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'headerRowOptions'=>['style'=>'display:none'],
        'tableOptions' => [
            'class'=>'table-sm'
        ],
        'beforeHeader' => [
                [
                    'columns'=>[
                        ['content'=>'โรค','options'=>['rowspan'=>3,'class'=>'text-center'],],
                        ['content'=>'กลุ่มเสี่ยง/โรคประจำตัว','options'=>['colspan'=>9,'class'=>'text-center']],
                        ['content'=>'รวมทั้งหมด','options'=>['colspan'=>2,'class'=>'text-center','rowspan'=>2]],
                    ],
                ],[
                    'columns'=>[
                        ['content'=>'Asthma<br>(J45-46)','options'=>['colspan'=>2,'class'=>'text-center'],],
                        ['content'=>'COPD<br>(J44)','options'=>['colspan'=>2,'class'=>'text-center'],],
                        ['content'=>'HT<br>(I10-I15)','options'=>['colspan'=>2,'class'=>'text-center'],],
                        ['content'=>'DM<br>(E10-E14)','options'=>['colspan'=>2,'class'=>'text-center'],],
                        ['content'=>'Pregnancy<br>(Z34.0-Z34.9)','options'=>['class'=>'text-center'],],
                    ],
                ],[
                    'columns'=>[
                        ['content'=>'ชาย','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                        ['content'=>'ชาย','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                        ['content'=>'ชาย','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                        ['content'=>'ชาย','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                        ['content'=>'ชาย','options'=>['class'=>'text-center']],
                        ['content'=>'หญิง','options'=>['class'=>'text-center']],
                    ],
                ],
        ],
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=>"ตารางที่ 5 จำนวนผู้ป่วยหมอกควัน แยกกลุ่มเสี่ยง/โรคประจำตัว",
            'footer'=>false,
//            'before'=>false,
            'after'=>false,
        ],
        'hover'=>true,
        'toolbar'=>[
            '{export}',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Save as Excel'],
        ],

        'summary'=>false,
    ]);
    ?>
</div>
<style>
    td[data-col-seq="1"] {
        text-align: right;
    }
    td[data-col-seq="2"] {
        text-align: right;
    }
    td[data-col-seq="3"] {
        text-align: right;
    }
    td[data-col-seq="4"] {
        text-align: right;
    }
    td[data-col-seq="5"] {
        text-align: right;
    }
    td[data-col-seq="6"] {
        text-align: right;
    }td[data-col-seq="7"] {
         text-align: right;
     }
    td[data-col-seq="8"] {
        text-align: right;
    }
    td[data-col-seq="9"] {
        text-align: right;
    }
    td[data-col-seq="10"] {
        text-align: right;
    }
    td[data-col-seq="11"] {
        text-align: right;
    }
    td[data-col-seq="12"] {
        text-align: right;
    }
</style>

