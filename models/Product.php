<?php

namespace app\models;

use Yii;

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
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_type_id' => Yii::t('app', 'Product Type ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

}
