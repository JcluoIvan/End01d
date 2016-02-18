(function(Endold) {

    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
            $('a').bind('click', app.linkTo);
        },
        linkTo: function(event) {

            var url = $(this).attr('href');
            event.preventDefault();
            if (url.match(/^\/page\/logout/)) {
                window.top.location.href = url;
            } else {
                url && Endold.redirect(url);
            }

        }

    };


    window.appHeader = app;

})(top.Endold);


window.appHeader.init();