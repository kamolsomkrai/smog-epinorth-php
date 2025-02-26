<?php
/** @var \app\components\View $this */

use app\models\CReportGr;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'รายงานหมอกควัน';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .site-report h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #007bff;
        text-align: center;
    }

    .site-report ul {
        list-style: none;
        padding: 0;
    }

    .site-report ul li {
        margin-bottom: 10px;
    }

    .site-report ul li a {
        display: block;
        padding: 10px 15px;
        background-color: #f7f9fc;
        color: #007bff;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-size: 18px;
    }

    .site-report ul li a:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>

<div class="site-report">
    <h1>รายงานหมอกควัน</h1>
    <ul>
        <li><?= Html::a('ตารางที่ 1 จำนวนรายป่วย รายโรงพยาบาล', ['report/report1']) ?></li>
        <li><?= Html::a('ตารางที่ 2 จำนวนรายป่วยผู้ป่วยนอก รายพื้นที่', ['report/report2']) ?></li>
        <li><?= Html::a('ตารางที่ 3 การรายงานจำนวนผู้ป่วยนอกรายสัปดาห์ จำแนกตามโรงพยาบาลที่เฝ้าระวัง', ['report/report3']) ?></li>
        <li><?= Html::a('ตารางที่ 4 จำนวนผู้ป่วยหมอกควัน แยกกลุ่มอายุและเพศ', ['report/report4']) ?></li>
        <li><?= Html::a('ตารางที่ 5 จำนวนผู้ป่วยหมอกควัน แยกกลุ่มเสี่ยง/โรคประจำตัว', ['report/report5']) ?></li>
    </ul>
</div>
