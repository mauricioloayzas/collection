<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\console\widgets\Table;

use common\models\Collections;
use common\models\CollectionsQuery;
use common\models\Images;
use common\models\ImagesQuery;

use common\unsplash\Search;

class PhotoController extends Controller
{
    public function actionSearch($query)
    {
        if(isset($query) && !empty($query)){
            $searchService = new Search();
            $response = $searchService->searchPhoto($query);

            $rows =[];
            foreach ($response['results'] as $key => $value){
                $row = [
                    $value['id'],
                    $value['alt_description'],
                    $value['urls']['small'],
                ];
                array_push($rows, $row);
            }

            echo Table::widget([
                'headers' => ['ID', 'Description', 'URL'],
                'rows' => $rows,
            ]);
        }else{
            echo "The search need a word";
        }

        exit();
    }


    public function actionCollection($userID)
    {
        if(isset($userID) && !empty($userID)){
            $collectionQuery = new CollectionsQuery(new Collections());
            $imageQuery =  new ImagesQuery(new Images());

            $collections = $collectionQuery->byUser($userID);
            $arrData = [];
            foreach ($collections as $key => $value){
                $aux = $value->toArray();
                $aux['images'] = [];
                $images = $imageQuery->byCollections($value->getCollectionId());
                foreach ($images as $k => $v){
                    array_push($aux['images'], $v->toArray());
                }
                array_push($arrData, $aux);
            }

            echo json_encode($arrData);
        }else{
            echo "We need the user ID";
        }

        exit();
    }
}