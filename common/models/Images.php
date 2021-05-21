<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $image_id
 * @property string $image_description
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
            [['image_description'], 'required'],
            [['image_status'], 'boolean'],
            [['collection_id'], 'default', 'value' => null],
            [['collection_id'], 'integer'],
            [['image_description'], 'string', 'max' => 45],
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
            'image_description' => 'Image Description',
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
     * @return CollectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionsQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDirtyAttributes()
    {
        return $this->dirtyAttributes;
    }

    /**
     * @param array $dirtyAttributes
     */
    public function setDirtyAttributes($dirtyAttributes)
    {
        $this->dirtyAttributes = $dirtyAttributes;
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
    public function getImageDescription()
    {
        return $this->image_description;
    }

    /**
     * @param string $image_description
     */
    public function setImageDescription($image_description)
    {
        $this->image_description = $image_description;
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
