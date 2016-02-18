(function() {
    var $print = $('#print');
    app = {
        init: function() {
            app.bindEvents()
        },
        bindEvents: function() {
            $print.bind('click', app.printPage);
        },
        printPage: function() {
            print();
        }
    }

    app.init();
})();