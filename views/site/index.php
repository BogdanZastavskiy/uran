<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Test task for Uran</h1>
        <p>
            <?= Html::a(Yii::t('app', 'Products'), Url::to(['product/index']), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Product Types'), Url::to(['product-type/index']), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Categories'), Url::to(['category/index']), ['class' => 'btn btn-success']) ?>
        </p>
        <p>
            <?php
            echo app\widgets\MyWidget::widget([
                'a' => 'b'
            ]);
            ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Test task for Uran</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>

        </div>
    </div>
