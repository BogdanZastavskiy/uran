var MyWidgetModel = function(parameters) {
        
    var self = this;
    this.preloader = ko.observable(true);
    this.products = ko.observableArray([]);
    this.urlAjax = ko.observable(parameters.urlAjax);
    this.urlProductMask = ko.observable(parameters.urlProductMask);
    
    this.refreshClick = function() {
        if (!self.preloader())
            self.load();
    };
    
    this.load = function() {
        self.preloader(true);
        $.ajax({
            async: true,
            method: 'POST',
            url: self.urlAjax(),
            data: {
                _csrf: yii.getCsrfToken()
            },
            success: function(json) {
                //Disable preloader and render items
                setTimeout(function() {self.preloader(false);}, 100);
                var resp = $.parseJSON(json);
                self.successAjax(resp);
            },
            error: function(resp) {
                //@todo
            }
        });
    };
    
    this.successAjax = function(data) {
        var products = data['products'] ? data['products'] : [];
        //Unset current list
        self.products([]);
        for (var i = 0; i < products.length; i++) {
            var p = new MyProduct(products[i], self);
            self.products().push(p);
        }
        //Reload all the list
        self.products(self.products());
    };
        
    self.load();
};

var MyProduct = function(data, $root) {
    var self = this;
    this.id = ko.observable(data.id);
    this.image = ko.observable(data.image);
    this.name = ko.observable(data.name);
    this.description = ko.observable(data.description);
    this.url = ko.computed(function() {
        var re = /productidtoreplace/gi;
        var str = $root.urlProductMask();
        return str.replace(re, self.id());;
    });
};

var $my = $('#mywidget');
window.MyWidgetModel = new MyWidgetModel({
    urlAjax: $my.data('url'),
    urlProductMask: $my.data('url-product-mask')
});
ko.applyBindings(window.MyWidgetModel, $my.get(0));