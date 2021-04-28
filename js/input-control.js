(function($) {
    var pluginName = 'Input',
        initAllSelector = '.input-control',
        paramKeys = [];
    $[pluginName] = function(element, options) {
        if (!element) {
            return $()[pluginName]({initAll: true});
        }
        var defaults = {
        };
        var plugin = this;
        plugin.settings = {};
        var $element = $(element);

        plugin.init = function() {
            plugin.settings = $.extend({}, defaults, options);

            if ($element.hasClass('text')) {
                initTextInput();
            } else if ($element.hasClass('password')) {
                initPasswordInput();
            }
        };
        var initTextInput = function () {
            var $helper,
                input;
            $helper = $element.children('.helper, .btn-clear');

            if (!$helper.get(0)) {
                return;
            }
            $helper.attr('tabindex', '-1');
            $helper.attr('type', 'button');
            $helper.on('click', function () {
                input = $element.children('input');
                if (input.prop('readonly')) {
                    return;
                }
                input.val('');
                input.focus();
            });
        };
        var initPasswordInput = function () {
            var $helper,
                password,
                text;
            $helper = $element.children('.helper, .btn-reveal');
            if (!$helper.get(0)) {
                return;
            }
            text = $('<input type="text" />');
            password = $element.children('input');
            $helper.attr('tabindex', '-1');
            $helper.attr('type', 'button');
            $helper.on('mousedown', function () {
                password.hide();
                text.insertAfter(password);
                text.val(password.val());
            });
            $helper.on('mouseup, mouseout', function () {
                text.detach();
                password.show();
                password.focus();
            });
        };
        plugin.init();
    };
    $.fn[pluginName] = function(options) {
        var elements = options && options.initAll ? $(initAllSelector) : this;
        return elements.each(function() {
            var that = $(this),
                params = {},
                plugin;
            if (undefined == that.data(pluginName)) {
                $.each(paramKeys, function(index, key){
                    params[key[0].toLowerCase() + key.slice(1)] = that.data('param' + key);
                });
                plugin = new $[pluginName](this, params);
                that.data(pluginName, plugin);
            }
        });
    };
    $(function(){
        $()["Input"]({initAll: true});
    });
})(jQuery);