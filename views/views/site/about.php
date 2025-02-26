<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'เกี่ยวกับระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

 /* General body styling */
body {
    background-color: #f5f7fa;
    font-family: 'Arial', sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Container for about section */
.site-about {
    padding: 20px;
    max-width: 1200px;
    margin: auto;
}

/* Heading styling */
.site-about h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #007bff;
    text-align: center;
}

/* Paragraph styling */
.site-about p.stb {
    text-indent: 40px;
    margin-top: 20px;
    font-size: 18px;
    padding: 15px;
    border-radius: 8px;
    background: #fafafa;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    line-height: 1.6;
}

/* Card styling */
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.card-header {
    padding: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
}

.card-content {
    padding: 20px;
}

.card-nav-tabs {
    border: none;
}

.card-nav-tabs .card-header {
    background-color: #007bff; /* Default blue */
    position: relative;
    text-align: center;
}

/* Colors for different card headers */
.card-header[data-background-color="green"] {
    background-color: #28a745;
}

.card-header[data-background-color="blue"] {
    background-color: #007bff;
}

.card-header[data-background-color="red"] {
    background-color: #dc3545;
}

/* Card image styling */
.card-content img {
    border-radius: 5%;
    width: 100px;
    height: 175px;
    object-fit: cover;
    margin-bottom: 15px;
}

/* Card name styling */
.card-content .name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Card position styling */
.card-content .position {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

/* Grid layout adjustments */
.site-about .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.site-about .col-lg-6, .site-about .col-md-6, .site-about .col-xs-6, .site-about .col-sm-6 {
    padding: 10px;
    max-width: 50%;
    flex: 1;
}

.site-about .col-lg-12, .site-about .col-md-12, .site-about .col-xs-12, .site-about .col-sm-12 {
    padding: 10px;
    max-width: 100%;
    flex: 1 0 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .site-about .col-lg-6, .site-about .col-md-6, .site-about .col-xs-6, .site-about .col-sm-6 {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .site-about h1 {
        font-size: 24px;
    }

    .site-about p.stb {
        font-size: 16px;
        padding: 10px;
    }
}



</style>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="stb">
        เป็นที่ทราบกันดีว่าปัญหาหมอกควันจากไฟป่าและภาวะความกดอากาศสูงในช่วงฤดูหนาวในพื้นที่เขตสุขภาพที่ 1 ได้ขยายตัวส่งผลกระทบมากๆ ขึ้นทุกปี  สำนักงานป้องกันควบคุมโรคที่ 1 เชียงใหม่และหน่วยงานเครือข่ายสังกัดสำนักงานสาธารณสุขจังหวัด 8 แห่ง จึงร่วมกันดำเนินการเฝ้าระวังการเจ็บป่วยที่อาจเกี่ยวข้องกับภาวะดังกล่าว  โดยเริ่มแรกในปี 2552 ได้มีการหารือร่วมกับกับเครือข่ายที่เกี่ยวข้องในการเฝ้าระวัง คือ หน่วยงานส่วนกลาง ได้แก่ กองระบาดวิทยา สำนักโรคจากการประกอบอาชีพและสิ่งแวดล้อม ศูนย์วิชาการเขต ได้แก่ ศูนย์อนามัยที่ 10 เชียงใหม่ สำนักงานป้องกันควบคุมโรคที่ 1  และตัวแทนจากสำนักงานสาธารณสุขจังหวัด  โรงพยาบาลศูนย์โรงพยาบาลทั่วไป และโรงพยาบาลชุมชนในพื้นที่ 8 จังหวัดภาคเหนือตอนบน โดยมีข้อตกลงในการดำเนินงานเฝ้าระวัง ระยะแรก คือระยะที่มีหมอกควัน ตั้งแต่เดือน มกราคม – เมษายน ของทุกๆปี และมีการปรับระบบการดำเนินงานเฝ้าระวังหมอกควันมาอย่างต่อเนื่องเพื่อให้ได้ข้อมูลประกอบการเฝ้าระวังที่มีคุณมากที่สุด เพื่อให้พื้นที่ได้นำผลการเฝ้าระวังมาใช้ประโยชน์ได้อย่างมีประสิทธิภาพต่อไป
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="green">
                    <h4>ที่ปรึกษา</h4>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                            <?= $this->render('_card',[
                                'name'=>'แพทย์หญิงเสาวนีย์ วิบุลสันติ',
                                'position'=>'ผู้อำนวยการสำนักงานป้องกันควบคุมโรคที่ 1 เชียงใหม่',
                                'img'=>'images/Picture1.jpg',
                                'facebook'=>'',
                                'line_img'=>'',
                            ]) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                            <?= $this->render('_card',[
                                'name'=>'แพทย์หญิงมนัสวินีร์ ภูมิวัฒน์',
                                'position'=>'ผู้ช่วยผู้อำนวยการสำนักงานป้องกันควบคุมโรคที่ 1 เชียงใหม่',
                                'img'=>'images/Picture3.jpg',
                                'facebook'=>'',
                                'line_img'=>'',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="green">
                    <h4>ผู้รับผิดชอบ</h4>
                </div>
                <div class="card-content" style="text-align: center">
                    <h5>กลุ่มระบาดวิทยาและตอบโต้ภาวะฉุกเฉินทางสาธารณสุข</h5>
                    <h5>กลุ่มโรคจากการประกอบอาชีพและสิ่งแวดล้อม</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="green">
                    <h4>System Analysis and Design</h4>
                    <small>(วิเคราะห์และออกแบบระบบ)</small>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                            <?= $this->render('_card',[
                                'name'=>'นายมณเทียร ปุณวัตร์',
                                'position'=>'นักวิชาการสาธารณสุขชำนาญการ',
                                'workplace'=>'โรงพยาบาลนครพิงค์',
                                'img'=>'images/bovy.png',
                                'facebook'=>'',
                                'line_img'=>'',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="blue">
                    <h4>Database Administrator</h4>
                    <small>(บริหารและจัดการระบบฐานข้อมูล)</small>
                </div>
                <div class="card-content">
                    <?= $this->render('_card',[
                        'name'=>'นายยุทธนา ตาสุภา',
                        'position'=>'นักวิชาการคอมพิวเตอร์ปฏิบัติการ',
                        'workplace'=>'สำนักงานสาธารณสุขจังหวัดเชียงใหม่',
                        'img'=>'images/yut.png',
                        'facebook'=>'',
                        'line_img'=>'images/icons/LINE-yui.png',
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="red">
                    <h4>Web Developer</h4>
                    <small>(พัฒนาระบบ)</small>
                </div>
                <div class="card-content">
                    <?= $this->render('_card',[
                        'name'=>'นายมานพ  บุญจำเนียร',
                        'position'=>'นักวิชาการคอมพิวเตอร์ปฏิบัติการ',
                        'workplace'=>'โรงพยาบาลแม่วาง',
                        'img'=>'images/nop.jpg',
                        'facebook'=>'',
                        'line_img'=>'images/icons/LINE-nop.png',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
