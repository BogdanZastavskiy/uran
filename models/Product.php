<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $product_type_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class Product extends \yii\db\ActiveRecord {

    /**
     *
     * @var UploadedFile
     */
    public $uploadedFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_type_id', 'category_id'], 'integer'],
            [['product_type_id', 'category_id'], 'required'],
            [['name'], 'required'],
            [['description'], 'string', 'max' => 2000],
            [['name'], 'string', 'max' => 255],
            [
                ['uploadedFile'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                'maxSize' => 1024 * 1024 * 12
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_type_id' => Yii::t('app', 'Product Type'),
            'category_id' => Yii::t('app', 'Category'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }
    
    /**
     * Getter for categories relation.
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
    
    /**
     * Getter for product type relation.
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(ProductType::class, ['id' => 'product_type_id']);
    }
    
    /**
     * Easy file saver.
     * @return boolean
     */
    public function upload() {
        $this->uploadedFile = \yii\web\UploadedFile::getInstance($this, 'uploadedFile');
        if (empty($this->uploadedFile))
            return true;
        if (!file_exists(Yii::getAlias('@webroot') . '/uploads'))
            mkdir (Yii::getAlias('@webroot') . '/uploads');
        $path = 'uploads/' . $this->id . '.' . $this->uploadedFile->extension;
        if ($this->getImagePath() && file_exists($this->getImagePath()))
            unlink ($this->getImagePath());
        $this->uploadedFile->saveAs($path, false);
        $this->image = $path;
        $this->save();
        return true;
    }
    
    /**
     * Getter for product's image URL.
     * @return NULL|string
     */
    public function getImageUrl() {
        if (empty($this->image))
            return NULL;
        return Yii::getAlias('@web') . '/' . $this->image;
    }
    
    public function getImagePath() {
        if (empty($this->image))
            return NULL;
        return Yii::getAlias('@webroot') . '/' . $this->image;
    }
    
    /**
     * Image download URL getter.
     * @return string
     */
    public function getImageDownloadUrl() {
        return \yii\helpers\Url::to(['product/download', 'id' => $this->id]);
    }
    
    /**
     * Getter for product's detail page URL.
     */
    public function getUrl() {
        return \yii\helpers\Url::to(['product/view', 'id' => $this->id]);
    }
    
    /**
     * Getter for description truncated.
     * @param int $truncate Set zero to skip truncating.
     * @return string
     */
    public function getDescription(int $truncate = 0) {
        return $truncate < 1
            ? $this->description
            : \yii\helpers\StringHelper::truncate($this->description, $truncate, '...');
    }


    /**
     * Method to generate search query from given parameters.
     * @param array $get
     * @return \yii\db\ActiveQuery
     */
    public static function getFilterQuery(array $get = NULL) {
        
        $get = !empty($get) ? $get : [];
        $que = self::find();
        
        if (isset($get['product_type_id']) && !empty($get['product_type_id'])) {
            $que->andFilterWhere([
                'product_type_id' => $get['product_type_id']
            ]);
        }
        
        if (isset($get['category_id']) && !empty($get['category_id'])) {
            $que->andFilterWhere([
                'category_id' => $get['category_id']
            ]);
        }
        
        if (isset($get['name']) && !empty($get['name'])) {
            $que->andFilterWhere([
                'LIKE', 'name', $get['name'] . '%', false
            ]);
        }
        
        return $que;
    }
}
