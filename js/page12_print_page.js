(function() {

    // var $demo_modal = $('#demo-modal');
    var $print = $('#print');
    app = {
        init: function() {
            app.bindEvents()
        },
        bindEvents: function() {
            $print.bind('click', app.onClickPrint);
            // $demo_modal.find('form').bind('submit', app.onSubmitData);
        },
        onClickPrint: function() {
            print();
            // $demo_modal.modal('show');
        }
        // onSubmitData: function(event) {
        //     var data = $(this).serialize();
        //     Endold.post(1299, data)
        //         .done(app.requestUpdate);
        //     event && event.preventDefault();

        // },
        // requestUpdate: function(){ 
        //     $demo_modal.modal('hide');
        // }
    }

    app.init();
})();