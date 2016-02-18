(function(Endold, window) {
    var $mainIframe =$('[name=ifr-right]');
    var app = {
        $menus: null,
        init: function() {
            app.$menus = $('#left-menu a.list-group-item');
            app.bindEvents();

            /* 預設項目為第一個 */
            app.$menus.eq(0).trigger('click'); 
        },
        bindEvents: function() {
            app.$menus.bind('click', app.onClickLink);
        },
        onClickLink: function(event) {
            var $this = $(this);
            var url = $this.attr('href');

            app.$menus.removeClass('active');
            $this.addClass('active');

            // event.preventDefault();
            // $('iframe').attr('src', url);

        },
        resize: function() {
            // var document_height = $(document).height();
            $mainIframe.css('height', $(window).height());
        }

    };

    window.onresize = app.resize;
    app.resize();
    app.init();
})(top.Endold, window);
