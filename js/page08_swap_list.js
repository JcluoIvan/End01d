(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var $searchForm = null;
    var $oid = $('#oid').val();
    var _MODIFY_URL = '/page/page08/order_detail.php';
    var MODIFY_URL = '/page/page08/order_swap_c.php';

    var app = {
        init: function() {
            $searchForm = $('#command-search');
            $printButton = $('#print');
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
            $printButton.bind('click', app.onclickPrint);
        },
        onclickPrint: function() {
            var oid = $('#oid').val();
            var no = $('#no').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page08/swap_list_print.php', {
                oid: oid,
                no: no,
                date1: date1,
                date2: date2
            });
            window.open(url);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function() {
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var insert_option = $('#check-date').val() ? false : {};

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            oid = $('#oid').val();
            return $(this).attr('href') || Endold.linkTo('/page/page08/order_swap.php', {oid: oid});
            // return Endold.linkTo(MODIFY_URL, {sn: sn});
        },
        onSave: function() {
            return Endold.cmdTo(306);
        },
        onShow: function() {
            
        },
        onSaveRequest: function(response) {
            // if (!response.status) return alert(response.message);
            app.gridReload();
        },
        // insert: {
        // },
        // insert: insert_option,
        // save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(815),
        dataType: 'json',
        colModel: [
        // {
        //         display: 'ID',
        //         name: 'id',
        //         hi


        //     }, 
            // {
            //    display: '訂單編號',
            //    name: 'ono', 
            //    width: 150, 
            //    align: 'center',
            // }, {
            {
               display: '換貨單編號',
               name: 'sNO', 
               width: 100, 
               align: 'center'    
            }, {
               display: '展示中心編號',
               name: 'arno', 
               width: 100, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 100, 
               align: 'center'
            }, {
               display: '換貨項目',
               name: 'pname', 
               width: 100, 
               align: 'center'
            }, {
               display: '換貨數量',
               name: 'amount', 
               width: 100, 
               align: 'center'
            }, {
               display: '換貨單狀態',
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
                name: 'status', 
                width: 100, 
                align: 'center',
                process: function(div, sn) {
                    var url = Endold.linkTo('page/page08/order_swap_c.php', {sn: sn});
                    var $a = $('<a>檢視</a>')
                        .attr('href', url)
                        .bind('click', option.modify);
                    $(div).html($a);
                }
            }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '換貨單',
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