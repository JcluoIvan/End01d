(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var $searchForm = null;
    var $oid = $('#oid').val();
    var _MODIFY_URL = '/page/page08/order_detail.php';
    var MODIFY_URL = '/page/page08/order_reject_detail.php';


    var app = {
        init: function() {
            $searchForm = $('#command-search');
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function() {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 400,
        onModify: function() {
            oid = $('#oid').val();
            console.log(this);
            return $(this).attr('href') || Endold.linkTo('/page/page08/order_reject.php', {oid: oid});
            // return Endold.linkTo(MODIFY_URL, {sn: sn});
        },
        onSave: function() {
            return Endold.cmdTo(305);
        },
        onSaveRequest: function(r) {
            console.log(r);
            ProductApp.gridReload();
        },
        // insert: {
        // },
        insert: false,
        save: false,
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(809),
        dataType: 'json',
        colModel: [
        // {
        //         display: 'ID',
        //         name: 'id',
        //         hi


        //     }, 
            // {
            //    display: '訂單編號',
            //    name: 'oid', 
            //    width: 150, 
            //    align: 'center',
            // }, {
            {
               display: '退貨單編號',
               name: 'rNO', 
               width: 100, 
               align: 'center'    
            }, {
               display: '展示中心編號',
               name: 'rno', 
               width: 100, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 100, 
               align: 'center'
            }, {
               display: '取貨地點',
               name: 'address', 
               width: 150, 
               align: 'center'
            }, {
               display: '退貨單狀態',
               name: 'status', 
               width: 100, 
               align: 'center'
            }, {
               display: '最後修改人員',
               name: 'keyman', 
               width: 120, 
               align: 'center'
            }, {
                display: ' ',
                name: 'reject', 
                width: 100, 
                align: 'center',
                process: function(div, sn) {
                    var url = Endold.linkTo('order_reject_detail.php', {sn: sn});
                    var $a = $('<a/>')
                        .html('明細')
                        .bind('click', option.view)
                        .attr({href: Endold.linkTo('page/page08/order_reject_detail.php', {sn: sn}) 
                        });

                    $(div).html($a);
                    // return div;
                }
            }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '退貨單',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData

    });
    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);