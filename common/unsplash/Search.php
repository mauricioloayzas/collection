<?php
namespace common\unsplash;

use yii\httpclient\Client;
use Yii;

class Search
{
    const URL_SERVICE = "search/photos";

    public function searchPhoto($query)
    {
        $link = Yii::$app->params['unsplash_url'].self::URL_SERVICE."?query=".$query;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($link)
            ->setHeaders([
                'Authorization' => 'Client-ID '.Yii::$app->params['unsplash_access_key'],
                'content-type'  => 'application/json'
            ])
            ->send();
        if ($response->isOk) {
            $data = json_decode($response->getContent(), TRUE);
        }else{
            $data = [];
        }

        return $data;
    }


    public function getUrlDownload($downloadLink)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($downloadLink)
            ->setHeaders([
                'Authorization' => 'Client-ID '.Yii::$app->params['unsplash_access_key'],
                'content-type'  => 'application/json'
            ])
            ->send();
        if ($response->isOk) {
            $data = json_decode($response->getContent(), TRUE);
        }else{
            $data = [];
        }

        return $data;
    }
}