(function(Endold, OptionBar) {

    var MODIFY_URL = '/page/page02/purchase_modify.php';
    var LIST_URL = '/page/page02/purchase.php';
    var $search = {
        form: null,
        agentL: null,
        agentR: null,
        type: null
    };

    var app = {
        init: function() {
            $search.form = $('#form-search');
            $search.agentL = $('#l-agent');
            $search.agentR = $('#r-agent');
            $search.type = $('#product-type');

            app.bindEvents();
        },
        bindEvents: function() {
            $search.agentL.bind('change', app.changeLAgent);
            $search.agentR.bind('change', app.reloadGrid);
            $search.type.bind('change', app.reloadGrid);
        },
        changeLAgent: function() {
            var lid = $search.agentL.val();
            Endold.post(211, {lid: lid})
                .done(app.reloadRAgent);
        },
        reloadRAgent: function(request) {
            if (request.status) {
                $search.agentR.html('');
                $.each(request.rows, function(value, label) {
                    $('<option/>')
                        .val(value)
                        .html(label)
                        .appendTo($search.agentR);
                });
                app.reloadGrid();
            } else {
                alert(request.message);
            }
        },
        reloadGrid: function() {
            /* 設定頁數為第一頁 */
            grid.flexOptions({newp: 1});
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $search.form.serializeArray();
            grid.flexOptions({params: data});
            return true;
        }
    };


    // var option = new OptionBar({
    //     optionElement: $('#option-bar'),
    //     mainElement: $('#option-main'),
    //     formElement: '#option-form',
    //     height: 480,
    //     onModify: function(url) {
    //         // var pid = $(this).data('row.pid') || 0;
    //         if (typeof url === 'string') {
    //             return url;
    //         } else {
    //             var aid = $search.agentR.val()
    //             return Endold.linkTo(MODIFY_URL, {aid: aid});
    //         }
    //     },
    //     onSave: function() {
    //         return Endold.cmdTo(216);
    //     },
    //     onShow: function($element) {
    //         $('#purchase-date').length && 
    //             new Calendar({
    //                 inputField: 'purchase-date',
    //                 dateFormat: '%Y-%m-%d',
    //                 trigger: 'purchase-date-active',
    //                 bottomBar: true,
    //                 weekNumbers: true,
    //                 onSelect: function() {this.hide(); }
    //             });
    //         modify.init();
    //     },
    //     insert: false,
    //     save: {},
    //     cancel: {}
    // });


    var grid = $('#inventory-list').flexigrid({
        url: Endold.cmdTo(200),
        dataType: 'json',
        colModel: [ 
            {
                display: '產品序號',
                name: 'no', 
                width: 100, 
                align: 'center'
            }, {
                display: '產品名稱',
                name: 'name', 
                width: 200, 
                align: 'center'
            }, {
                display: '產品類別',
                name: 'type', 
                width: 140, 
                align: 'center'
            }, {
                display: '庫存數量',
                name: 'count', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    (Number(div.innerHTML) < 0) &&
                        $(div).css('color', 'red');
                }
            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 280,
        onSubmit: app.addGridFormData

    });


    window.ProductApp = app;
    window.ProductGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);

