<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 */
class Category extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
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
     * Getter for all the product categories ASC sorted.
     * @return app\models\Category[]
     */
    public function getCategories() {
        return self::find()
            ->orderBy('name ASC')
            ->all();
    }
    
    /**
     * Getter for category detail page URL.
     */
    public function getUrl() {
        return \yii\helpers\Url::to(['category/view', 'id' => $this->id]);
    }
}
