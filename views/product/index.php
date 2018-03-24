<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

\app\assets\FilterAsset::register($this);

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php //Pjax::begin(); ?>

    <p>
<?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-md-9">
            <?=
            GridView::widget([
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
                'options' => [
                    'id' => 'FilterGrid'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <h2>Filter</h2>
                </div>
                <div class="col-md-12">
                    <form class="well" id="ProductsFilter">
                        
                        <div class="form-group">
                            <input placeholder="Enter name..." type="text" name="name" class="form-control" value="<?php
                                $name = Yii::$app->getRequest()->getQueryParam('name');
                                echo $name ? (string) $name : '';
                            ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <?php
                            $types = ArrayHelper::map((new \app\models\ProductType())->getProductTypes(), 'id', 'name');
                            $type = Yii::$app->getRequest()->getQueryParam('product_type_id');
                            echo \kartik\select2\Select2::widget([
                                'name' => 'product_type_id',
                                'value' => $type ? (string) $type : '',
                                'data' => $types,
                                'options' => ['multiple' => false, 'placeholder' => 'Select types...']
                            ]);
                            ?>
                        </div>
                        
                        <div class="form-group">
                            <?php
                            $categories = ArrayHelper::map((new \app\models\Category())->getCategories(), 'id', 'name');
                            $category = Yii::$app->getRequest()->getQueryParam('category_id');
                            echo \kartik\select2\Select2::widget([
                                'name' => 'category_id',
                                'value' => $category ? (string) $category : '',
                                'data' => $categories,
                                'options' => ['multiple' => false, 'placeholder' => 'Select categories...']
                            ]);
                            ?>
                        </div>
                        
                        <input type="hidden" name="page" value="1"/>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?php print Url::to(['product/index']); ?>" class="btn btn-sm btn-warning pull-left">Clear</a>
                                    <button type="submit" class="btn btn-sm btn-success pull-right">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php //Pjax::end(); ?>
</div>
