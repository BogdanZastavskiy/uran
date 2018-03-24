<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data',
        'method' => 'POST'
    ]]); ?>

    <?php
    
        $types = ArrayHelper::map((new \app\models\ProductType())->getProductTypes(), 'id', 'name');
        print $form->field($model, 'product_type_id')->widget(Select2::class, [
            'data' => $types,
            'options' => [
                'placeholder' => 'Select a type...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => false
            ]
        ]);
    ?>

    <?php

        $categories = ArrayHelper::map((new \app\models\Category())->getCategories(), 'id', 'name');
        print $form->field($model, 'category_id')->widget(Select2::class, [
            'data' => $categories,
            'options' => [
                'placeholder' => 'Select a category...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => false
            ]
        ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
        print $form->field($model, 'uploadedFile')->fileInput();
    ?>

    <?php if($model->getImageUrl()): ?>
        <div class="form-group">
            <?php
            print Html::img($model->getImageUrl(), [
                'class' => 'img-responsive img-rounded'
            ]);
            ?>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
