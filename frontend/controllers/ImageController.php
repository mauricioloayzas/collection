<?php

namespace frontend\controllers;

use common\models\Collections;
use common\models\CollectionsQuery;
use common\models\Images;
use common\models\ImageSerach;
use common\models\ImagesQuery;
use common\unsplash\Search;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'search', 'download'],
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

        $imagesService = new ImagesQuery(new Images());
        $images = $imagesService->searchQueryCollection($this->request->queryParams)->all();

        $params = $this->request->queryParams;
        if(!isset($params['collection_id'])){
            $params['collection_id'] = 0;
        }

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'collection_id' => $params['collection_id'],
            'images'        => $images
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
        $model = $this->findModel($id);

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
        $model = $this->findModel($id);
        $collection_id = $model->getCollectionId();
        $model->delete();

        return $this->redirect(['index', 'collection_id' => $collection_id]);
    }


    public function actionSearch()
    {
        $data = \Yii::$app->request->post();
        \Yii::$app->response->format = Response::FORMAT_JSON;
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


    public function actionDownload()
    {
        $imagesService = new ImagesQuery(new Images());
        $images = $imagesService->searchQueryCollection($this->request->queryParams)->all();

        $dirname = \Yii::$app->basePath ."/web/img/". $this->request->queryParams['collection_id'];
        if(!@is_dir($dirname)){
            if(!@mkdir($dirname, 0777, true)) {
                $error = error_get_last();
                echo $error['message']."\n"; exit();
            }
        }

        foreach ($images as $key => $value){
            try {
                $arrayOne = explode('fm=', $value->image_url);
                $arrayOne = explode('&', $arrayOne[1]);

                $ch = curl_init($value->image_url);
                $fp = fopen($dirname . '/' . $value->image_unsplash_id . '.' . $arrayOne[0], 'w');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);

                $zip = new \ZipArchive();
                if ($zip->open($dirname . '/' . $value->collection_id . '.zip', \ZipArchive::CREATE)) {
                    $zip->addFile($dirname . '/' . $value->image_unsplash_id . '.' . $arrayOne[0], $value->image_unsplash_id . '.' . $arrayOne[0]);
                }
                $zip->close();
            }catch (\Exception $e){
                echo $e->getMessage(); exit();
            }
        }

        $file = ($dirname."/".$this->request->queryParams['collection_id'].".zip");
        if(!@is_dir($file)){
            $filetype=filetype($file);
            $filename=basename($file);
            header ("Content-Type: ".$filetype);
            header ("Content-Length: ".filesize($file));
            header ("Content-Disposition: attachment; filename=".$filename);
            readfile($file);

            rmdir($dirname);
        }else{
            return $this->redirect(['index', 'collection_id' => $this->request->queryParams['collection_id']]);
        }
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
