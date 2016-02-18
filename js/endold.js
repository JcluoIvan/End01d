
(function() {
    var _GATEWAY_URL = '/pub/gateway.php';
    var _user = {};
    var $main = $('#main');
    var $header = $('#header');
    /* header menu height */
    var _header_height = 60;

    var Endold = {
        Lang: {},
        Postal: {
            data: {},
            options: function(select, rows, def) {
                $.each(rows, function(key, row) {
                    var selected = def === row.id ? true : false;
                    var option = $('<option>')
                        .attr({'value': row.id, 'sn': key, 'selected': selected})
                        .data('sn', key)
                        .html(row.name)
                        .appendTo(select);
                });
            },
        },
        post: function(cmd, data, options) {
            options = options || {};
            var url = _GATEWAY_URL 
                + '?cmd='+ cmd
                + '&sid=' + (_user && _user.sid || 0)
                + '&site=' + (options.site || 0);
            return $.ajax(url, {
                    type: 'post',
                    data: data,
                    timeout: 10 * 1000,
                    async: ('async' in options) ? options.async : true,
                    cache: false,
                    dataType: options.dataType || 'json'
                });
        },
        get: function(cmd, data, options) {
            options = options || {};
            var url = _GATEWAY_URL 
                + '?cmd='+ cmd
                + '&sid=' + _user.sid
                + '&site=' + (options.site || 0);
            return $.ajax(url, {
                    type: 'get',
                    data: data,
                    timeout: 10 * 1000,
                    async: ('async' in options) ? options.async : true,
                    cache: false,
                    dataType: options.dataType || 'json'
                });
        },
        /* 取得 cmd 的網址 */
        cmdTo: function(cmd) {
            return _GATEWAY_URL 
                + '?cmd=' + cmd
                + '&sid=' + _user.sid
                + '&site=0';
        },
        /* 取得連結網址 */
        linkTo: function(url, data) {
            data = data || {};
            var url = url.split('?');
            var args = ['sid=' + _user.sid];
            $.each(data, function(key, value) {
                args.push(key + '=' + value);
            });
            return url[0] + '?' + args.join('&');
        },
        setUser: function(data) {
            _user = data;
            $header.attr('src', 'page/header.php?sid=' + _user.sid);
            Endold.resize();
        },
        getUser: function(key) {
            return (key in _user) && _user[key] || null;
        },
        resize: function() {
            if (_user.sid) {
                var window_height = $(window).height();
                $header.css('height', _header_height);
                $main.css('height', window_height - _header_height);
            }
        },
        redirect: function(url) {
            var url = url = url.split('?');
            var sid = Endold.getUser('sid') || '';
            url = url[0] + '?sid=' + sid + '&' + (url[1] || '');
            $main.attr('src', url);
        }
    };

    window.onresize = Endold.resize;

    window.Endold = Endold;
})();

(function(Endold, $) {

    window.OptionBar = function(options) {

        var options = $.extend({
            optionElement: null,
            formElement: null,
            mainElement: null,
            defaultStatus: 'default',
            onSaveRequest: null,
            onInsert: null,
            onModify: null,
            onView: null,
            onSave: null,
            onShow: null,
            onCancel: null,
            insert: false,
            save: false,
            cancel: false,
            height: 200
        }, options);
        
        var _this = this;
        var _state = 'default';
        var $form = null;
        var $main = $(options.mainElement).hide();
        var $option = $(options.optionElement);
        var $insertButton = null;
        var $saveButton = null;
        var $cancelButton = null;
        if ($main.length) {
            $main.css({
                opacity: 0,
                height: 0,
                width: '100%',
                'overflow-y': 'auto'
            });
        } else {
            console.error('請設定 mainElement 指定控制項的 element');
        }
        if ($option.length === 0) {
            console.error('請設定 optionElement 指定控制項的 element');
        }

        $option.addClass('option-bar');

        if (options.insert) {
            var button = options.insert.button || '<button>新增</button>';
            $insertButton = $(button);
            var def = $.extend({
                button: null,
                label: null,
                onClick: null,
                formElement: null,    // 預設為上面 options 的
                disabledWhen: {modify: true, view: true}
            }, options.insert);
            $insertButton.data('option-bar-data', def);
            $insertButton
                .appendTo($option)
                .attr('type', 'button')
                .css({margin: '0 2px'})
                .addClass('btn btn-primary option-button')
                .html(options.insert.label || $insertButton.html())
                .append('<img src="/images/ajax-loader.gif"/>')
                .bind('click', function() {
                    def.onClick && def.onClick.apply(this, arguments || []);
                    _this.modify.apply(_this, arguments);
                });
        }
        if (options.save) {
            var button = options.save.button || '<button>存檔</button>';
            $saveButton = $(button);
            var def = $.extend({
                button: null,
                label: null,
                onClick: null,
                formElement: null,    // 預設為上面 options 的
                disabledWhen: {'default': true, view: true}
            }, options.save);
            $saveButton.data('option-bar-data', def);
            $saveButton
                .appendTo($option)
                .attr('type', 'button')
                .css({margin: '0 2px'})
                .addClass('btn btn-primary option-button option-save')
                .html(options.save.label || $saveButton.html())
                .append('<img src="/images/ajax-loader.gif"/>')
                .bind('click', function() {
                    def.onClick && def.onClick.apply(this, arguments || []);
                    _this.save.apply(_this, arguments);
                });
        }
        if (options.cancel) {
            var button = options.cancel.button || '<button>取消</button>';
            $cancelButton = $(button);
            var def = $.extend({
                button: null,
                label: null,
                onClick: null,
                formElement: null,    // 預設為上面 options 的
                disabledWhen: {'default': true}
            }, options.cancel);
            $cancelButton.data('option-bar-data', def);
            $cancelButton
                .appendTo($option)
                .attr('type', 'button')
                .css({margin: '0 2px'})
                .addClass('btn btn-primary option-button option-cancel')
                .html(options.cancel.label || $cancelButton.html())
                .append('<img src="/images/ajax-loader.gif"/>')
                .bind('click', function() {
                    def.onClick && def.onClick.apply(this, arguments || []);
                    _this.cancel.apply(_this, arguments);
                });
        }
        this.height = function(h) {
            options.height = h;
        };
        this.disabledButton = function() {

            $insertButton && $insertButton.prop('disabled', true);
            $saveButton && $saveButton.prop('disabled', true);
            $cancelButton && $cancelButton.prop('disabled', true);
        };
        this.enabledButton = function() {

            if ($insertButton) {
                var data = $insertButton.data('option-bar-data');
                $insertButton
                    .prop('disabled', data['disabledWhen'][_state] || false);
            }
            if ($saveButton) {
                var data = $saveButton.data('option-bar-data');
                $saveButton
                    .prop('disabled', data['disabledWhen'][_state] || false);
            }
            if ($cancelButton) {
                var data = $cancelButton.data('option-bar-data');
                $cancelButton
                    .prop('disabled', data['disabledWhen'][_state] || false);
            }
        };

        /* 載入頁面(新增, 修改) */
        this.modify = function(event) {
            var url = 
                (typeof arguments[0] === 'string' && arguments[0]) || 
                ($(this).attr('href')) ||
                null;
            if (options.onModify) {
                url = options.onModify.apply(this, arguments || []);
            }

            if (url === false) {
                return;
            } 
            _this.state('modify');
            _this.load(url);
            (typeof event == 'object') && ('preventDefault' in event) && event.preventDefault();
        };

        this.view = function(event) {
            var url = 
                (typeof arguments === 'string'&& arguments[0]) || 
                ($(this).attr('href')) ||
                null;

            if (options.onView) {
                url = options.onView.apply(this, arguments || []);
            }
            if (url === false) {
                return;
            } 
            _this.state('view');
            _this.load(url);
            event && event.preventDefault();

        };

        this.load = function(url, state) {
            $option.addClass('ajax ajax-load');
            _this.disabledButton();
            $.ajax(url, {dataType: 'html'})
                .always(function() {
                    _this.enabledButton();
                    $option.removeClass('ajax ajax-load');
                })
                .done(function(response) {
                    $main
                        .html(response)
                        .show()
                        .animate({
                            opacity: 1,
                            height: options.height
                        }, 250);
                    $form = $main.find(options.formElement);
                    $form.bind('submit', function(event) {
                        event.preventDefault();
                        _this.save.apply(_this, arguments || []);
                    });
                    options.onShow && options.onShow.apply(_this, [$main]);
                })
                .fail(function(response) {
                    alert('error : ' + response.responseText);
                });
        };
        this.validates = function(validates) {
            var show_message = [];
            var tooltip_option = {
                placement: 'top',
                html: true
            };
            $.each(validates, function(selector, messages) {
                var str = [];
                var $element = $form.find(selector);
                $.each(messages, function(type, message) {
                    str.push(message);
                });
                str = str.join('<br/>  ')
                if ($element.length) {
                    $element
                        .addClass('validate')
                        .tooltip($.extend(tooltip_option, {title: str}))
                        .tooltip('show');
                } else {
                    show_message.push(selector + '\n  ' + str);
                }
            });
            if (show_message.length) {
                alert(show_message.join('\n ### ### ###\n'));
            }
        };

        /* 執行存檔動作 */
        this.save = function() {
            var url = null;
            var _state = _state;
            /* 移除 validate (原生 destroy 會有 .15s 的 delay, 這裡直接刪除相關資料) */
            $form.find('.validate')
               .tooltip('hide')
               .off('.tooltip')
               .removeData('bs.tooltip')
               .removeClass('validate');
                

            url = options.onSave.apply($form, arguments || []);
            if (url === false) {
                return;
            }
            var data = $form && $form.serialize() || '';
            url = isNaN(Number(url)) ? url : Endold.cmdTo(url);

            _this.disabledButton();
            $option.addClass('ajax ajax-save');
            $.ajax(url, {type: 'post', data: data, dataType: 'json'})
                .always(function() {
                    _this.enabledButton();
                    $option.removeClass('ajax ajax-save');
                })
                .done(function(response) {
                    if (! response.status && typeof response.validates === 'object') {
                        _this.validates(response.validates);
                    } else if (
                        options.onSaveRequest && 
                        options.onSaveRequest.apply(this, arguments) !== false
                    ) {
                        _this.state('default');
                        _this.cancel();
                    }
                })
                .fail(function() {
                    options.onFailRequest && options.onFailRequest.apply(this, arguments);
                });
        };
        /* 取消 */
        this.cancel = function() {

            var result = null;

            if (options.onCancel) {
                result = options.onModify.apply(this, arguments || []);
            }
            if (result === false) {
                return;
            }

            _this.state('default');
            $main.animate(
            {
                opacity: 0,
                height: 0
            }, 250, function() {
                $main.html('').hide();
            });

        };
        this.state = function(state) {
            _state = state || _state;
            _this.enabledButton();
        };
        _this.state();
    };

})(window.Endold, jQuery);

