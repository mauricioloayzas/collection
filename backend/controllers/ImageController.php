<?php

namespace backend\controllers;


use common\models\Collections;
use common\models\CollectionsQuery;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

use common\models\Images;
use common\models\ImageSerach;
use common\models\UploadFile;

use common\unsplash\Search;

/**
 * ImageController implements the CRUD actions for Images model.
 */
class ImageController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'search'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSerach();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $params = $this->request->queryParams;
        if(!isset($params['collection_id'])){
            $params['collection_id'] = 0;
        }

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'collection_id' => $params['collection_id']
        ]);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $params = $this->request->queryParams;
        if(!isset($params['collection_id'])){
            $params['collection_id'] = 0;
        }

        $model = $this->findModel($id);
        if(!is_null($model)){
            $params['collection_id'] = $model->getCollectionId();
        }

        return $this->render('view', [
            'model'         => $model,
            'collection_id' => $params['collection_id']
        ]);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $params = $this->request->getQueryParams();
        $modelFile = new UploadFile();
        $model = new Images();
        $model->setCollectionId($params['collection_id']);
        $model->setImageStatus(TRUE);
        $model->setImageOrder(1);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect([
                    'view',
                    'id'            => $model->image_id,
                    'collection_id' => $model->getCollectionId()
                ]);
            }else{

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'         => $model,
            'collection_id' => $params['collection_id']
        ]);
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelFile = new UploadFile();
        $model = $this->findModel($id);

        $collectionQuery = new CollectionsQuery(new Collections());
        $collection =$collectionQuery->byID($model->getCollectionId());
        $collection = $collection->toArray();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect([
                    'view',
                    'id'            => $model->image_id,
                    'collection_id' => $model->getCollectionId()
                ]);
            }else{

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model'         => $model,
            'collection_id' => $model->getCollectionId()
        ]);
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionSearch()
    {
        $data = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        if(isset($data['query'])){
            $searchService = new Search();
            $response = $searchService->searchPhoto($data['query']);
        }

        $view = $this->renderPartial('_search_unsplash', [
            'imagesUnsplashes'  => $response['results']
        ]);

        return ['view' => $view];
    }


    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
