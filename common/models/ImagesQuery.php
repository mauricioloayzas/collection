<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Collections]].
 *
 * @see Collections
 */
class ImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Collections[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Collections|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    public function byID($iD)
    {
        return $this->where(['image_status'    => TRUE])
            ->andWhere(['image_id'   => $iD])->one();
    }


    public function byCollections($collectionID)
    {
        return $this->where(['image_status'    => TRUE])
            ->andWhere(['collection_id'   => $collectionID])
            ->orderBy(['image_order'=>SORT_ASC])->all();
    }


    public function searchQueryCollection($params)
    {
        if(!isset($params['collection_id'])){
            return $this->joinWith('collection')
                ->where(['image_status'    => TRUE]);
        }else{
            return $this->joinWith('collection')
                ->where(['image_status'    => TRUE])
                ->andWhere(['images.collection_id'    => $params['collection_id']]);
        }

    }


    public function byCollectionAnOrder($collectionID, $order)
    {
        return $this->where(['image_status'    => TRUE])
            ->andWhere([
                'collection_id'   => $collectionID,
                'image_order'     => $order
            ])->one();
    }


    public function getTheMaxOrder($collectionID)
    {
        $row = new \yii\db\Query();
        return $row->select('Max(image_order) as max_order')
            ->andWhere([
                'image_status'    => TRUE,
                'collection_id'   => $collectionID,
            ])->from('images')->one();
    }
}
