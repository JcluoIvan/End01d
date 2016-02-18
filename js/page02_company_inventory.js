(function(Endold, OptionBar) {

    var MODIFY_URL = '/page/page02/company_purchase_modify.php';
    var $search = {
        form: null,
        agentL: null,
        agentR: null,
        type: null
    };

    var app = {
        init: function() {
            $search.form = $('#form-search');
            $search.type = $('#product-type');

            app.bindEvents();
        },
        bindEvents: function() {
            $search.type.bind('change', app.reloadGrid);
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
    //     height: 340,
    //     onModify: function() {
    //         var pid = $(this).data('row.pid') || 0;
    //         return Endold.linkTo(MODIFY_URL, {pid: pid});
    //     },
    //     onSave: function() {
    //         return Endold.cmdTo(241);
    //     },
    //     onShow: function($element) {
    //         $('#purchase_date').length && 
    //             new Calendar({
    //                 inputField: 'purchase_date',
    //                 dateFormat: '%Y-%m-%d',
    //                 trigger: 'purchase_date',
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


    var grid = $('#product-list').flexigrid({
        url: Endold.cmdTo(240),
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
                display: '目前存量',
                name: 'count', 
                width: 100, 
                align: 'center'
            // }, {
            //     display: '進貨',
            //     name: 'modify', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, id) {
            //         var $link = $('<a href="#" />');
            //         var $div = $(div).html('');
            //         $link.html('進貨')
            //             .data('row.pid', id)
            //             .bind('click', option.modify)
            //             .appendTo($div);
            //     }
            // }, {
            //     display: '進貨記錄',
            //     name: 'view', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, id) {
            //         var $link = $('<a href="" />');
            //         var $div = $(div).html('');
            //         $link.html('記錄')
            //             .data('row.pid', id)
            //             .bind('click', app.modifyInventory)
            //             .appendTo($div);
            //     }
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


    // var modify = {
    //     $grid: null,
    //     $main: null,
    //     init: function($element) {
    //         modify.$main = $element;
    //         modify.$grid = $('#purchase-list').flexigrid({
    //             url: Endold.cmdTo(241),
    //             dataType: 'json',
    //             colModel: [ 
    //                 {
    //                     display: '產品序號',
    //                     name: 'no', 
    //                     width: 100, 
    //                     align: 'center'
    //                 }, {
    //                     display: '產品名稱',
    //                     name: 'name', 
    //                     width: 200, 
    //                     align: 'center'
    //                 }, {
    //                     display: '產品類別',
    //                     name: 'type', 
    //                     width: 140, 
    //                     align: 'center'
    //                 }, {
    //                     display: '目前存量',
    //                     name: 'count', 
    //                     width: 100, 
    //                     align: 'center'
    //                 }, {
    //                     display: '進貨',
    //                     name: 'modify', 
    //                     width: 100, 
    //                     align: 'center',
    //                     process: function(div, id) {
    //                         var $link = $('<a href="#" />');
    //                         var $div = $(div).html('');
    //                         $link.html('進貨')
    //                             .data('row.pid', id)
    //                             .bind('click', option.modify)
    //                             .appendTo($div);
    //                     }
    //                 }, {
    //                     display: '進貨記錄',
    //                     name: 'view', 
    //                     width: 100, 
    //                     align: 'center',
    //                     process: function(div, id) {
    //                         var $link = $('<a href="" />');
    //                         var $div = $(div).html('');
    //                         $link.html('記錄')
    //                             .data('row.pid', id)
    //                             .bind('click', app.modifyInventory)
    //                             .appendTo($div);
    //                     }
    //                 }, {
    //                     display: '排序',
    //                     name: 'sort', 
    //                     width: 60, 
    //                     align: 'center'
    //                 }
    //             ],
    //             perProcess: function() {
    //                 console.log(arguments);


    //             },
    //             idProperty: 'id',
    //             sortname: "time",
    //             sortorder: "desc",
    //             usepager: true,
    //             title: '通知',
    //             useRp: true,
    //             rp: 10,
    //             showTableToggleBtn: true,
    //             width: '100%',
    //             height: 280,
    //             onSubmit: app.addGridFormData

    //         });
    //     }
    // };

    window.ProductApp = app;
    window.ProductGrid = grid;
    app.init();
})(window.top.Endold, window.top.OptionBar);

