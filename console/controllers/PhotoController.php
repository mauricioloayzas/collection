<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\console\widgets\Table;

use common\unsplash\Search;

class PhotoController extends Controller {

    public function actionSearch($query, $zip = FALSE) {
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

                if($zip){
                    $dirname = Yii::$app->basePath ."/img/". $query;
                    if(!@is_dir($dirname)){
                        if(!@mkdir($dirname, 0777, true)) {
                            $error = error_get_last();
                            echo $error['message']."\n"; exit();
                        }
                    }

                    $dataDownload = $searchService->getUrlDownload($value['links']['download_location']);
                    $arrayOne = explode('fm=', $dataDownload['url']);
                    $arrayOne = explode('&', $arrayOne[1]);

                    $ch = curl_init($dataDownload['url']);
                    $fp = fopen($dirname.'/'.$value['id'].'.'.$arrayOne[0], 'w');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                    fclose($fp);

                    try {
                        $zip = new \ZipArchive();
                        if($zip->open($dirname.'/'.$query.'.zip', \ZipArchive::CREATE)){
                            $zip->addFile($dirname.'/'.$value['id'].'.'.$arrayOne[0]);
                        }
                        $zip->close();
                    }catch (\Exception $e){
                        echo $e->getMessage(); exit();
                    }
                }
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
}