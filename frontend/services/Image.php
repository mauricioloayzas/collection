<?php
namespace frontend\services;

use yii\httpclient\Client;
use Yii;

class Image
{
    const URL_SERVICE = "images";

    public function getListByCollections($token, $collectionID)
    {
        $link = Yii::$app->params['api_url_base'].self::URL_SERVICE."/bycollection/".$collectionID;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($link)
            ->setHeaders([
                'Authorization' => 'Bearer '.$token,
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