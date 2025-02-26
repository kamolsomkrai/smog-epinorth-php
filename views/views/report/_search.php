<?php

use app\models\CReportGr;
use app\models\Cprovince;
use kartik\select2\Select2;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/** @var \app\components\View $this */

$year = date('Y');

for ($i = $year - 5; $i <= $year; $i++) {
    $y[$i + 543] = $i + 543;
}
$provinces = [
    50 => 'เชียงใหม่',
    51 => 'ลำพูน',
    52 => 'ลำปาง',
    54 => 'แพร่',
    55 => 'น่าน',
    56 => 'พะเยา',
    57 => 'เชียงราย',
    58 => 'แม่ฮ่องสอน'
];
?>
<div class="report-search">
    <form method="get" id="search" style="margin-bottom: 20px">
        <input type="hidden" name="r" value="<?= Yii::$app->request->get('r') ?>">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-6">
                <label class="form-label">ปี</label>
                <?= Select2::widget([
                    'name' => 'year',
                    'data' => $y,
                    'value' => Yii::$app->request->get('year', date('Y') + 543),
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                                $("#search").submit();
                            }',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-6">
                <label class="form-label">เดือน</label>
                <?= Select2::widget([
                    'name' => 'month',
                    'value' => Yii::$app->request->get('month'),
                    'data' => $this->monthName,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                                $("#search").submit();
                            }',
                        'select2:clear' => 'function(){
                                $("#search").submit();
                            }',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-6 col-sm-6">
                <div class="form-label">กลุ่มโรค</div>
                <?= Select2::widget([
                    'name' => 'groupcode',
                    'data' => ArrayHelper::map(CReportGr::find()->select(new Expression('groupcode, concat(groupname, "(", icd, ")") as groupname'))->asArray()->all(), 'groupcode', 'groupname'),
                    'value' => Yii::$app->request->get('groupcode'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                                    $("#search").submit();
                                }',
                        'select2:clear' => 'function(){
                                    $("#search").submit();
                                }',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
                <div class="form-label">จังหวัด</div>
                <?= Select2::widget([
                    'name' => 'provcode',
                    'data' => $provinces,
                    'value' => Yii::$app->request->get('provcode'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                                    $("#search").submit();
                                }',
                        'select2:clear' => 'function(){
                                    $("#search").submit();
                                }',
                    ],
                ]) ?>
            </div>
        </div>
    </form>
</div>
