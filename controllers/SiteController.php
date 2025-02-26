<?php

namespace app\controllers;

use app\models\CoKpi;
use app\models\CoKpiGr;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = CoKpiGr::find()
                ->select('co_kpi_gr.des,co_kpi.kpi_id,co_kpi.kpi_name')
                ->leftJoin('co_kpi','co_kpi_gr.group_report = co_kpi.group_report')
                ->orderBy(['kpi_name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$model,
            'pagination'=>false,
        ]);

        return $this->render('index',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionDashboard2()
    {
        return $this->render('dashboard2');
    }
    


    public function actionKpi($kpi_id, $year = null)
{
    $model = CoKpi::find()->where(['kpi_id' => $kpi_id])->one();
    $sql = $model->sql_level1;

    // ถ้าไม่กรอกอะไร (หรือค่า year ว่างเปล่า) ให้แสดงทั้งหมด โดยไม่เพิ่มเงื่อนไขใน SQL
    if (!empty($year)) {
        $condition = "b_year = :year";
        // ตรวจสอบว่ามี GROUP BY อยู่ใน SQL หรือไม่
        $groupPos = stripos($sql, 'group by');
        if ($groupPos !== false) {
            // แบ่ง SQL เป็นส่วนที่อยู่ก่อน GROUP BY กับส่วน GROUP BY
            $sqlBeforeGroup = substr($sql, 0, $groupPos);
            $groupClause = substr($sql, $groupPos);
            // ตรวจสอบว่ามี WHERE อยู่ในส่วนที่อยู่ก่อน GROUP BY หรือไม่
            if (stripos($sqlBeforeGroup, 'where') !== false) {
                $sqlBeforeGroup .= " AND " . $condition;
            } else {
                $sqlBeforeGroup .= " WHERE " . $condition;
            }
            // รวม SQL กลับเข้าด้วยกัน
            $sql = $sqlBeforeGroup . " " . $groupClause;
        } else {
            // กรณีไม่มี GROUP BY ใน SQL
            if (stripos($sql, 'where') !== false) {
                $sql .= " AND " . $condition;
            } else {
                $sql .= " WHERE " . $condition;
            }
        }
        $params = [':year' => $year];
    } else {
        $params = [];
    }

    $result = Yii::$app->db->createCommand($sql, $params)->queryAll();

    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $result,
        'pagination' => false,
    ]);

    return $this->render('kpi', [
        'dataprovider' => $dataProvider,
        'model' => $model,
    ]);
}


}

