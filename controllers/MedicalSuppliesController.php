<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MedicalSupplies;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class MedicalSuppliesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['edit', 'create', 'delete'], 
                        'roles' => ['@'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'], 
                        'roles' => ['?', '@'], 
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = MedicalSupplies::find();

        Yii::debug($query->createCommand()->getRawSql(), 'query');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new MedicalSupplies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('toastMessage', ['message' => 'บันทึกข้อมูลสำเร็จ', 'type' => 'success']);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id)
    {
        $model = MedicalSupplies::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('toastMessage', ['message' => 'แก้ไขข้อมูลสำเร็จ', 'type' => 'success']);
            return $this->redirect(['index']);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = MedicalSupplies::findOne($id);

        if ($model && $model->delete()) {
            Yii::$app->session->setFlash('toastMessage', ['message' => 'ลบข้อมูลสำเร็จ', 'type' => 'success']);
        } else {
            Yii::$app->session->setFlash('toastMessage', ['message' => 'ไม่สามารถลบข้อมูลได้', 'type' => 'danger']);
        }

        return $this->redirect(['index']);
    }
}
