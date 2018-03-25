<?php
use yii\helpers\Url;
?>
<div class="row disabled hidden" id="mywidget" data-bind="css: {
    disabled: $root.preloader(),
    hidden: false
}" data-url="<?= Url::to(['product/mywidget']) ?>" data-url-product-mask="<?=
        Url::to(['product/view', 'id' => 'productidtoreplace'])
?>">
    <div class="col-md-12">
        <h3 class="text-success">Knockout.js + AJAX widget</h3>
        <p class="text text-muted">
        Must show random 6 products with picture, or info message when nothing found.
        </p>
    </div>
    <div class="col-md-12" data-bind="visible: $root.products().length === 0">  
        <div class="alert alert-info">
            No one product found...
        </div>
    </div>
    <div class="col-md-12" data-bind="visible: $root.products().length > 0">
        <div class="row" data-bind="foreach: {
            data: products, as: 'product'
        }">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                <div class="card">
                    <a data-bind="attr: {
                        href: product.url(),
                        title: product.name()
                    }">
                        <img class="card-img-top img-thumbnail img-responsive thumb-post" data-bind="attr: {
                            src: '/' + product.image()
                        }">
                    </a>
                    <div class="card-body">
                        <a data-bind="attr: {
                            href: product.url()
                        }">
                            <h5 class="card-title" data-bind="text: product.name()"></h5>
                        </a>
                        <p class="card-text text text-muted" data-bind="text: product.description()"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <button class="btn btn-sm btn-danger" data-bind="event: {
            click: refreshClick
        }">Refresh</button>
    </div>
</div>
<?php

?>