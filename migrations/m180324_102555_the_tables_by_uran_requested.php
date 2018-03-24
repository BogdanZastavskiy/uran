<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180324_102555_the_tables_by_uran_requested
 */
class m180324_102555_the_tables_by_uran_requested extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m180324_102555_the_tables_by_uran_requested cannot be reverted.\n";
        return false;
    }

    public function up() {
        
        $this->createTable('product_type', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        
        $this->createTable('category', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        
        $this->createTable('product', [
            'id' => Schema::TYPE_PK,
            'product_type_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'image' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""'
        ]);
        
        $this->createIndex(
            'idx-product_type_id',
            'Product',
            'product_type_id'
        );
        
        $this->createIndex(
            'idx-category_id',
            'Product',
            'category_id'
        );
    }

    public function down() {
        echo "m180324_102555_the_tables_by_uran_requested cannot be reverted.\n";
        return false;
    }

}
