<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-gradient-primary text-gray d-flex justify-content-between align-items-center">
        <h4 class="mb-0">📦 รายการเวชภัณฑ์</h4>
        <?= Html::a('<i class="fas fa-plus"></i> เพิ่มเวชภัณฑ์', ['create'], ['class' => 'btn btn-light text-white btn-sm bg-success']) ?>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}", // ซ่อน Showing x of x items
                'tableOptions' => ['class' => 'table table-bordered table-striped table-hover align-middle'],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => '#',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'name',
                        'header' => 'ชื่อเวชภัณฑ์',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center ps-3'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'attribute' => 'type',
                        'header' => 'ประเภท',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center ps-3'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'attribute' => 'quantity',
                        'header' => 'จำนวน',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-end pe-3'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'attribute' => 'hospname',
                        'header' => 'โรงพยาบาล',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center ps-3'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'attribute' => 'cchangwat.provname',
                        'header' => 'จังหวัด',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center ps-3'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'attribute' => 'created_at',
                        'header' => 'วันที่สร้าง',
                        'format' => ['date', 'php:d/m/Y'],
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'enableSorting' => false, // ปิด sort
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'การจัดการ',
                        'headerOptions' => ['class' => 'bg-success text-white text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{edit} {delete}',
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                return Html::a('<i class="fas fa-edit"></i>', '#', [
                                    'class' => 'btn btn-sm btn-warning btn-edit',
                                    'data-id' => $model->id,
                                    'data-url' => \yii\helpers\Url::to(['edit', 'id' => $model->id]),
                                    'title' => 'แก้ไข'
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fas fa-trash"></i>', '#', [
                                    'class' => 'btn btn-sm btn-danger btn-delete',
                                    'data-id' => $model->id,
                                    'data-url' => \yii\helpers\Url::to(['delete', 'id' => $model->id]),
                                    'title' => 'ลบ'
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา Form จะถูกโหลดด้วย AJAX -->
                <div id="modalContent">
                    <p class="text-center">กำลังโหลด...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">ยืนยันการลบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">คุณแน่ใจว่าต้องการลบข้อมูลนี้หรือไม่?</p>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-danger btn-confirm-delete">ลบ</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
    <div id="toastNotification" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<?php if ($toast = Yii::$app->session->getFlash('toastMessage')): ?>
<script>
    showToast('<?= $toast['message'] ?>', '<?= $toast['type'] ?>');
</script>
<?php endif; ?>

<?php
$script = <<<JS
// เปิด Modal ลบ
function showToast(message, type = 'success') {
    var toast = document.getElementById('toastNotification');
    toast.className = `toast align-items-center text-bg-${type}`;
    toast.querySelector('.toast-body').innerText = message;
    new bootstrap.Toast(toast).show();
}

// เปิด Modal สำหรับแก้ไข
$(document).on('click', '.btn-edit', function () {
    var url = $(this).data('url');
    $('#modalContent').html('กำลังโหลด...');
    $.get(url, function (data) {
        $('#modalContent').html(data);
        $('#editModal').modal('show');
    }).fail(function () {
        showToast('เกิดข้อผิดพลาดในการโหลดข้อมูล', 'danger');
    });
});

// ลบข้อมูล
$(document).on('click', '.btn-delete', function () {
    var url = $(this).data('url');
    if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้หรือไม่?')) {
        $.post(url, {_csrf: yii.getCsrfToken()}, function (response) {
            if (response.success) {
                showToast('ลบข้อมูลสำเร็จ', 'success');
                location.reload();
            } else {
                showToast(response.message || 'ไม่สามารถลบข้อมูลได้', 'danger');
            }
        }).fail(function () {
            showToast('เกิดข้อผิดพลาดในการลบข้อมูล', 'danger');
        });
    }
});







JS;
$this->registerJs($script);
?>
