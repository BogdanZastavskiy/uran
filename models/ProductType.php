<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property int $id
 * @property string $name
 */
class ProductType extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Getter for all the product types ASC sorted.
     * @return \app\models\ProductType[]
     */
    public function getProductTypes() {
        return self::find()
            ->orderBy('name ASC')
            ->all();
    }
    
    /**
     * Getter for product type detail page URL.
     */
    public function getUrl() {
        return \yii\helpers\Url::to(['product-type/view', 'id' => $this->id]);
    }
}
