<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    $url = $data->getImageUrl();
                    if (empty($url))
                        return '';
                    return Html::img($url, [
                        'class' => 'img-thumbnail'
                    ]);
                },
            ],
            
            'product_type_id',
            'category_id',
                        
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($data) {
                    return Html::a($data->name, $data->getUrl());
                }
            ],
                        
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
