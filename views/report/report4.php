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
$this->params['breadcrumbs'][] = 'จำนวนผู้ป่วยหมอกควัน แยกกลุ่มอายุและเพศ ';

$JS = <<< JS
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.kv-grid-table').find('td').each(function(e){
            let val = parseInt($(this).text()) || false;
            
            if((val > 0) && !($(this).hasClass('kv-grid-group'))){
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
            <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
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
            <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
                <div class="form-label">จังหวัด</div>
                <?= Select2::widget([
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
                                    $("#search").submit();
                                }',
                    ],
                ])?>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
                <div class="form-label">โรงพยาบาล</div>
                <?= Select2::widget([
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
        }
        td[data-col-seq="7"] {
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
                    ['content'=>'กลุ่มอายุและเพศ(ปี)','options'=>['colspan'=>10,'class'=>'text-center']],
                    ['content'=>'รวมทั้งหมด','options'=>['colspan'=>2,'class'=>'text-center','rowspan'=>2]],
                ],
            ],[
                'columns'=>[
                    ['content'=>'0-4','options'=>['colspan'=>2,'class'=>'text-center']],
                    ['content'=>'5-14','options'=>['colspan'=>2,'class'=>'text-center']],
                    ['content'=>'15-34','options'=>['colspan'=>2,'class'=>'text-center']],
                    ['content'=>'35-59','options'=>['colspan'=>2,'class'=>'text-center']],
                    ['content'=>'60 ปีขึ้นไป','options'=>['colspan'=>2,'class'=>'text-center']],
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
                    ['content'=>'ชาย','options'=>['class'=>'text-center']],
                    ['content'=>'หญิง','options'=>['class'=>'text-center']],
                    ['content'=>'ชาย','options'=>['class'=>'text-center']],
                    ['content'=>'หญิง','options'=>['class'=>'text-center']],
                ],
            ],
        ],
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=>"ตารางที่ 4 จำนวนผู้ป่วยหมอกควัน แยกกลุ่มอายุและเพศ ",
            'footer'=>false,
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
