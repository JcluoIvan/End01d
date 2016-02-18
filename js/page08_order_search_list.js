(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var $searchForm = null;
    var $demo_modal = $('#demo-modal');

    var app = {
        $clear_date: null,
        init: function() {
            $searchForm = $('#command-search');
            $clear_date = $('.clear-date');
            new Calendar({
                    inputField: "date3",
                    dateFormat: "%Y-%m-%d",
                    trigger: "date3.onclick",
                    bottomBar: true,
                    weekNumbers: true,
                    onSelect: function() {this.hide();}
                });
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
            $demo_modal.find('form').bind('submit', app.onSubmitData);
            $clear_date.bind('click', app.onclearDate);
        },
        onclearDate: function() {
            var target = $(this).attr('clear-target');
            var $input = $(target);
            ($input.length) && $input.val('');
        },
        onshowDialog: function() {
            var orderId = $(this).data('order.id');
            var sendNo = $(this).data('order.no');
            var date3 = $(this).data('order.date');

            $('input[name="orderID"]').val(orderId);
            $('input[name="date3"]').val(date3);
            $('input[name="sendNo"]').val(sendNo);
            $demo_modal.modal('show');
        },
        onSubmitData: function(event) {
            var sendDate = $('#date3').val();
            console.log(sendDate);
            var data = $(this).serialize();
            Endold.post(810, data)
                .done(app.requestUpdate);
            event && event.preventDefault();
        },
        requestUpdate: function(){ 
            $demo_modal.modal('hide');
            grid.flexReload();
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function(event) {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            console.log(this);
            return $(this).attr('href') || Endold.linkTo('/page/page03/order_detail.php', {id: id});
        },
        onSave: function() {
            var $this = $(this);
            if ($this.hasClass('reject')) {
                return Endold.cmdTo(300);
            } else if ($this.hasClass('swap')) {
                return Endold.cmdTo(304);
            } else if ($this.hasClass('modify')) {
                return Endold.cmdTo(308);
            }
        },
        onShow: function() {
            modify.init();
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
        url: Endold.cmdTo(802),
        dataType: 'json',
        colModel: [ 
            {
               display: '訂單編號',
               name: 'oid', 
               width: 120, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'member_no', 
               width: 120, 
               align: 'center', 
            }, {
               display: '會員姓名',
               name: 'member_name', 
               width: 120, 
               align: 'center', 
            }, {
               display: '金額',
               name: 'total', 
               width: 80, 
               align: 'center'
            }, {
               display: '回饋金',
               name: 'shoppingGold', 
               width: 80, 
               align: 'center'
            }, {
               display: '取貨時間',
               name: 'getmode', 
               width: 80, 
               align: 'center',
               process: function(div, sn) {
                    var data = div.innerHTML.split(',');
                    var type = data[0];
                    var no = data[1];
                    var date = data[2];
                    $(div).html(date);
                    console.log(date);
                    // if(date){
                    //     $(div).html(date);
                    // }else{
                    //     var $demo_modal = $('#demo-modal');
                    //     var $a = $('<a/>')
                    //         .html('輸入取貨日期')
                    //         .data('order.id', sn)
                    //         .data('order.no', no)
                    //         .data('order.date', date)
                    //         .bind('click', app.onshowDialog);
                    //     $(div).html($a);
                    // }
                }
            }, {
                display: ' ',
                name: 'detail', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var url = Endold.linkTo('page/page08/order_detail.php', {sn: sn});
                    var $a = $('<a/>')
                        .html('明細')
                        .bind('click', option.view)
                        .attr({href: Endold.linkTo('page/page08/order_detail.php', {sn: sn}) 
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
        title: '訂貨紀錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData

    });

    /* modify 用到的 grid, 由 option.onShow 時設定 */
    var modify = {
        init: function($form) {
            modify.grid = $('#member-grid').flexigrid({
                url: Endold.cmdTo(807),
                dataType: 'json',
                colModel: [
                    {
                        display: '產品編號',
                        name: 'no',
                        width: 140,
                        align: 'center'
                    }, {
                        display: '品名',
                        name: 'name',
                        width: 140,
                        align: 'center'
                    }, {
                        display: '產品單價',
                        name: 'money',
                        width: 140,
                        align: 'center'
                    }, {
                        display: '數量',
                        name: 'count',
                        width: 140,
                        align: 'center'
                    }, {
                        display: '金額',
                        name: 'total',
                        width: 140,
                        align: 'center'
                    }
                ],
                idProperty: 'id',
                sortname: 'id',
                sortorder: 'asc',
                usepager: true,
                // title: $('#info').html(),
                title: $('#info').val(),
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                height: 275,
                params: [
                    {
                        name: 'id',
                        value: $('#oid').val()
                    }
                ]
                // onSubmit: modify.addGridFormData
            });

            modify.$form = $('#option-form');

            modify.$list_panel = $('#member-list-options');

        }

    };


    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);