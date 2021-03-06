<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider([
            'query' => Product::getFilterQuery(Yii::$app->getRequest()->get())
                ->with('category')->with('type'),
            'pagination' => new \yii\data\Pagination([
                'pageSize' => 10
            ]),
            'sort' => ['attributes' => ['name', 'id']]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Product();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                $model->upload();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                $model->upload();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model->getImagePath() && file_exists($model->getImagePath()))
            unlink($model->getImagePath());
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Download file for existing Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($id) {
        $model = $this->findModel($id);
        if ($model->getImagePath() && file_exists($model->getImagePath()))
            return Yii::$app->response->sendFile($model->getImagePath());
        throw new NotFoundHttpException(Yii::t('app', 'The requested file does not exist.'));
    }

    /**
     * Action to load products via AJAX for MyWidget.
     * @throws ForbiddenHttpException
     */
    public function actionMywidget() {
        if (!Yii::$app->getRequest()->getIsAjax())
            throw new ForbiddenHttpException(Yii::t('app', 'Access denied!'));
        $prods = Product::getProductsWithImage(6, false, true);
        foreach ($prods AS &$prod) {
            //Truncate description for all the products
            $prod->description = $prod->getDescription(50);
        }
        echo \yii\helpers\Json::encode([
            'products' => $prods
        ]);
    }
    
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
