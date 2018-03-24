$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(document).ready(function () {
    (new Filter()).init();
});

var Filter = function () {

    /** @type Filter */
    var self = this;

    /*
     * Main init function.
     */
    this.init = function () {
        self.getForm().off('submit');
        self.getForm().submit(function (e) {
            e.preventDefault();
            self.submit();
        });
    };

    /**
     * Easy method to add/modify query string parameter.
     * @param {String} uri URL value to modify.
     * @param {String} key Parameter name.
     * @param {String} value Parameter value.
     * @returns {String}
     */
    this.updateQueryStringParameter = function(uri, key, value) {
        
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        
        return uri + separator + key + "=" + value;
    };

    /**
     * Method on form submit event.
     * @returns {undefined}
     */
    this.submit = function () {
        
        var params = self.serialize();
        var url = window.location.href;
        $.each(params, function(param, value) {
            if (!value)
                return;
            url = self.updateQueryStringParameter(url, param, value);
        });

        window.location.href = url;
    };

    /**
     * Method to serialaize form data.
     * @returns {String}
     */
    this.serialize = function () {
        return self.getForm().serializeObject();
    };

    /**
     * Getter for form jQuery element.
     * @returns {$|_$}
     */
    this.getForm = function () {
        return $('#ProductsFilter');
    };
};