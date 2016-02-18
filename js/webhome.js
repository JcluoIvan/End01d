(function(Endold) {
    var $login = $('#login-form');
    var $captcha = {
        reload: $('#reload-captcha-image'),
        image: $('#captcha-image'),
        input: $('[name=captcha]')
    };
    var app = {
        $account: null,
        $password: null,
        init: function() {
            app.$account = $('#input-account');
            app.$password = $('#input-password');
            app.bindEvents();
            app.$account.trigger('focus');
        },
        bindEvents: function() {
            $login.bind('submit', app.login );    
            $captcha.reload.bind('click', app.reloadCaptcha);
        },

        reloadCaptcha: function (event) {
            var url = $captcha.image.attr('src');
            var time = Number(new Date);
            $captcha.image.attr('src', url.replace(/\?.+/, '?' + time));
            event && event.preventDefault();
        },

        /* do login */
        login: function(event) {

            event.preventDefault();
            $login.find('.validate')
               .tooltip('hide')
               .off('.tooltip')
               .removeData('bs.tooltip')
               .removeClass('validate');
                
            Endold.post(0, $login.serialize())
                .done(app.loginResponse);

        },
        loginResponse: function(o) {
            var tooltip_option = {placement: 'top', html: true};
            if (! o.status) {
                if ('validate' in o) {
                    $.each(o.validate, function(selector, message) {
                        $login.find(selector)
                            .addClass('validate')
                            .tooltip($.extend(tooltip_option, {title: message}))
                            .tooltip('show');
                    });
                    $login.find('.validate').eq(0).trigger('select');
                } else {
                    alert(o.message);
                }
                var count = $captcha.input.data('count') || 0;
                if ($captcha.input.hasClass('validate') || count >= 3) {
                    app.reloadCaptcha();
                    count = 0;
                } else {
                    count ++;
                }
                $captcha.input.data('count', count);
            } else {
                Endold.setUser(o.user);
                Endold.Lang = o.lang || {};
                Endold.Postal.data = o.postal || {};
                Endold.redirect('/page/home/main.php');
            }
        }

    };

    app.init();

})(top.Endold);
