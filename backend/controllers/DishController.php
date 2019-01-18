<?php

namespace kahanov\food\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use kahanov\food\core\entities\Dish;
use kahanov\food\core\forms\DishForm;
use kahanov\food\core\forms\DishSearch;
use kahanov\food\core\services\DishService;

class DishController extends Controller
{
    private $service;

    /**
     * DishController constructor.
     * @param $id
     * @param $module
     * @param DishService $service
     * @param array $config
     */
    public function __construct($id, $module, DishService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish
     * @return string|\yii\web\Response
     * @throws \Throwable
     */
    public function actionCreate()
    {
        $form = new DishForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $dish = $this->service->create($form);
                return $this->redirect(['view', 'id' => $dish->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Dish
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $dish = $this->findModel($id);
        $form = new DishForm($dish);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($form, $dish->id);
                return $this->redirect(['view', 'id' => $dish->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'dish' => $dish,
        ]);
    }

    /**
     * Deletes an existing Dish
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->service->remove($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
