<?php

namespace kahanov\food\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use kahanov\food\core\entities\Ingredient;
use kahanov\food\core\forms\IngredientForm;
use kahanov\food\core\forms\IngredientSearch;
use kahanov\food\core\services\IngredientService;

class IngredientController extends Controller
{
    private $service;

    /**
     * IngredientController constructor.
     * @param $id
     * @param $module
     * @param IngredientService $service
     * @param array $config
     */
    public function __construct($id, $module, IngredientService $service, $config = [])
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
        $searchModel = new IngredientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingredient
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
     * Creates a new Ingredient
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $form = new IngredientForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $ingredient = $this->service->create($form);
                return $this->redirect(['view', 'id' => $ingredient->id]);
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
     * Updates an existing Ingredient
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $ingredient = $this->findModel($id);
        $form = new IngredientForm($ingredient);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($form, $ingredient->id);
                return $this->redirect(['view', 'id' => $ingredient->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * Deletes an existing Ingredient
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
     * Finds the Ingredient based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingredient::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
