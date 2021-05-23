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


    public function byCollections($collectionID)
    {
        return $this->where(['image_status'    => TRUE])
            ->andWhere(['collection_id'   => $collectionID])->all();
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
}
