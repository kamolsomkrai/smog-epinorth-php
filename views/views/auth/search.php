<?php



/* @var $this \yii\web\View */

use app\models\Cchangwat;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


?>


        <div class="col-lg-3" style="margin: 0 0 10px 0">
            <form method="get" id="search">
                <input type="hidden" name="r" value="auth/index">
                <?= Select2::widget([
                    'name' => 'chwcode',
                    'data' => ArrayHelper::map(Cchangwat::find()->asArray()->all(),'provcode','provname'),
                    'value' => Yii::$app->request->get('chwcode'),
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

            </form>
        </div>


