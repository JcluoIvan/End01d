(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var $searchForm = null;
    var $oid = $('#oid').val();
    var _MODIFY_URL = '/page/page12/order_detail.php';
    var MODIFY_URL = '/page/page12/order_reject_c.php';

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
            var url = Endold.linkTo('/page/page12/reject_list_print.php', {
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
        height: 600,
        onModify: function() {
            oid = $('#oid').val();
            return $(this).attr('href') || Endold.linkTo('/page/page12/order_reject.php', {oid: oid});
            // return Endold.linkTo(MODIFY_URL, {sn: sn});
        },
        onSave: function() {
            return Endold.cmdTo(1205);
        },
        onSaveRequest: function(response) {
            // if (!response.status) return alert(response.message);
            app.gridReload();
        },
        // insert: {
        // },
        insert: insert_option,
        save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(1212),
        dataType: 'json',
        colModel: [
            // {
            //    display: '訂單編號',
            //    name: 'ono', 
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
               name: 'arno', 
               width: 100, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 100, 
               align: 'center'
            }, {
               display: '退貨項目',
               name: 'pname', 
               width: 100, 
               align: 'center'
            }, {
               display: '退貨數量',
               name: 'amount', 
               width: 100, 
               align: 'center'
            }, {
               display: '退貨金額',
               name: 'rTmoney', 
               width: 100, 
               align: 'center'
            }, {
               display: '退貨單狀態',
               name: 'statusName', 
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
                    var statusCheck = div.innerHTML;
                    if(statusCheck==1 || statusCheck==2){
                        div.innerHTML = '-';
                    }else{
                        var url = Endold.linkTo('order_reject_c.php', {sn: sn});
                        // if (! insert_option) return (div.innerHTML = '-');
                        var $a = $('<a/>')
                            .html('修改')
                            .bind('click', option.modify)
                            .attr({href: Endold.linkTo('page/page12/order_reject_c.php', {sn: sn}) 
                            });

                        $(div).html($a);
                        // return div;
                    }
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