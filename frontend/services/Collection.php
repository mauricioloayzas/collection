<?php
namespace frontend\services;

use yii\httpclient\Client;
use Yii;

class Collection
{
    const URL_SERVICE = "collections";

    public function getList($token)
    {
        $link = Yii::$app->params['api_url_base'].self::URL_SERVICE;
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


    public function getOneByID($token, $id)
    {
        $link = Yii::$app->params['api_url_base'].self::URL_SERVICE.'/findbyid/'.$id;
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


    public function post($token, $data)
    {
        $link = Yii::$app->params['api_url_base'].self::URL_SERVICE;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($link)
            ->setData($data)
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


    public function update($token, $data, $id)
    {
        $link = Yii::$app->params['api_url_base'].self::URL_SERVICE."/updatedata/".$id;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('PUT')
            ->setUrl($link)
            ->setData($data)
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