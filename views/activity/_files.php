<?php
/** @var yii\web\View $this */
/** @var app\models\ActivityFiles $model */

use yii\helpers\Html;
use yii\helpers\Url;

// ตรวจสอบชนิดของไฟล์
$extension = strtolower(pathinfo($model->files_name, PATHINFO_EXTENSION));
$fileUrl = Yii::$app->request->baseUrl . "/uploads/";

// กำหนดเส้นทางของไฟล์ตามชนิดของไฟล์
if ($extension === 'pdf') {
    $fileUrl .= "documents/{$model->files_name}";
} else if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
    $fileUrl .= "images/{$model->files_name}";
} else {
    $fileUrl .= "other/{$model->files_name}"; // สำหรับไฟล์ประเภทอื่น ๆ
}

// แสดงลิงก์เปิดไฟล์
echo Html::a(Html::encode($model->files_name), $fileUrl, [
    'class' => 'show-file',
    'target' => '_blank',
]);

?>
