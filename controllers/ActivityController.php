<?php
namespace app\controllers;

use Yii;
use app\models\ActivityDatas;
use app\models\ActivityFiles;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ActivityController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'deletefile' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['create', 'update', 'delete', 'deletefile'],
                    'rules' => [
                        [
                            'actions' => ['create', 'update', 'delete', 'deletefile'],
                            'allow' => !Yii::$app->user->isGuest,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $selectedProvince = Yii::$app->request->get('province');
        
        $query = ActivityDatas::find()
            ->select('activity_datas.id, activity_date, content, c_activity.des, activity_datas.hospcode')
            ->innerJoin('c_activity', 'c_activity.id = activity_datas.activity_id')
            ->innerJoin('chospital', 'chospital.hoscode = activity_datas.hospcode');

        if ($selectedProvince) {
            $query->andWhere(['chospital.provcode' => $selectedProvince]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['activity_datas.id' => SORT_DESC]),
            'pagination' => ['pageSize' => 25],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModelByMd5Id($id);
        $dataProvider = new ActiveDataProvider([
            'query' => ActivityFiles::find()->where(['md5(activity_id)' => $id]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new ActivityDatas();
        $upload = new ActivityFiles();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->hospcode = Yii::$app->user->identity->hospcode;
            $model->create_by_user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                $this->handleFileUploads($model->id);
                return $this->redirect(['activity/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->handleFileUploads($model->id);
            return $this->redirect(['view', 'id' => md5($model->id)]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->deleteActivityFiles($id);
        ActivityDatas::deleteAll(['id' => $id]);

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ActivityDatas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelByMd5Id($id)
    {
        $model = ActivityDatas::find()
            ->where(new \yii\db\Expression('md5(id) = :id', [':id' => $id]))
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function handleFileUploads($activityId)
    {
        $this->uploadFiles($activityId, 'documents', '/uploads/documents/');
        $this->uploadFiles($activityId, 'images', '/uploads/images/');
    }

    protected function uploadFiles($activityId, $inputName, $uploadPath)
    {
        $files = UploadedFile::getInstancesByName($inputName);
        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/pdf',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        foreach ($files as $file) {
            $mimeType = \yii\helpers\FileHelper::getMimeType($file->tempName);
            if (!in_array($mimeType, $allowedMimeTypes)) {
                continue;
            }

            $filename = Yii::$app->security->generateRandomString(16);
            $saveAs = $uploadPath . $filename . '.' . $file->extension;

            if ($file->saveAs(Yii::getAlias('@webroot') . $saveAs)) {
                $upload = new ActivityFiles();
                $upload->activity_id = $activityId;
                $upload->user_id = Yii::$app->user->identity->id;
                $upload->files_name = $filename . '.' . $file->extension;
                $upload->file_path = $saveAs;
                $upload->file_size = $file->size;
                $upload->file_type = $mimeType;
                $upload->extension = $file->extension;
                $upload->save(false);
            }
        }
    }

    protected function deleteActivityFiles($id)
    {
        $files = ActivityFiles::find()->where(['activity_id' => $id])->all();
        foreach ($files as $file) {
            @unlink(Yii::getAlias('@webroot') . $file->file_path);
            $file->delete();
        }
    }

    public function actionDeletefile($id)
    {
        $file = ActivityFiles::find()->where(['md5(id)' => $id])->one();
        if ($file) {
            @unlink(Yii::getAlias('@webroot') . $file->file_path);
            $file->delete();
        }

        return $this->redirect(['activity/view', 'id' => md5($file->activity_id)]);
    }
}
