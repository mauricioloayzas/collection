<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $image_id
 * @property string $image_unsplash_id
 * @property string $image_url
 * @property string $image_order
 * @property bool $image_status
 * @property int|null $collection_id
 *
 * @property Collections $collection
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_unsplash_id', 'image_url', 'image_order'], 'required'],
            [['image_status'], 'boolean'],
            [['collection_id'], 'default', 'value' => null],
            [['collection_id', 'image_order'], 'integer'],
            [['image_unsplash_id'], 'string', 'max' => 45],
            [['image_unsplash_id'], 'string', 'max' => 45],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collections::className(), 'targetAttribute' => ['collection_id' => 'collection_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'image_unsplash_id' => 'Unsplash ID',
            'image_url' => 'Unsplash URL',
            'image_order' => 'Order',
            'image_status' => 'Image Status',
            'collection_id' => 'Collection ID',
        ];
    }

    /**
     * Gets query for [[Collection]].
     *
     * @return \yii\db\ActiveQuery|CollectionsQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collections::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }

    /**
     * @return int
     */
    public function getImageId()
    {
        return $this->image_id;
    }

    /**
     * @param int $image_id
     */
    public function setImageId($image_id)
    {
        $this->image_id = $image_id;
    }

    /**
     * @return string
     */
    public function getImageUnsplashId()
    {
        return $this->image_unsplash_id;
    }

    /**
     * @param string $image_unsplash_id
     */
    public function setImageUnsplashId($image_unsplash_id)
    {
        $this->image_unsplash_id = $image_unsplash_id;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * @param string $image_url
     */
    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    /**
     * @return string
     */
    public function getImageOrder()
    {
        return $this->image_order;
    }

    /**
     * @param string $image_order
     */
    public function setImageOrder($image_order)
    {
        $this->image_order = $image_order;
    }

    /**
     * @return bool
     */
    public function isImageStatus()
    {
        return $this->image_status;
    }

    /**
     * @param bool $image_status
     */
    public function setImageStatus($image_status)
    {
        $this->image_status = $image_status;
    }

    /**
     * @return int|null
     */
    public function getCollectionId()
    {
        return $this->collection_id;
    }

    /**
     * @param int|null $collection_id
     */
    public function setCollectionId($collection_id)
    {
        $this->collection_id = $collection_id;
    }
}
