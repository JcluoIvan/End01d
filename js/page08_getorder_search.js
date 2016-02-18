(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page08/order_detail.php';
    var Reject_LIST_URL = '/page/page08/reject_list.php';
    var Swap_LIST_URL = '/page/page08/swap_list.php'; 
    var $searchForm = null;
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
            var no = $('#no').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page08/getorder_search_print.php', {
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
        gridReload: function(event) {
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 530,
        onModify: function() {
            return $(this).attr('href') || Endold.linkTo('/page/page08/order_detail.php', {id: id});
        },
        onSave: function() {
            var $this = $(this);
            if ($this.hasClass('reject')) {
                return Endold.cmdTo(300);
            } else if ($this.hasClass('swap')) {
                return Endold.cmdTo(304);
            } else if ($this.hasClass('modify')) {
                return Endold.cmdTo(808);
            }
        },
        onShow: function() {
            modify.init();
            new Calendar({
                  inputField: "delivery",
                  dateFormat: "%Y-%m-%d",
                  trigger: "delivery.onclick",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
            // new Calendar({
            //       inputField: "signoff",
            //       dateFormat: "%Y-%m-%d",
            //       trigger: "signoff.onclick",
            //       bottomBar: true,
            //       weekNumbers: true,
            //       onSelect: function() {this.hide();}
            //     });
            // new Calendar({
            //       inputField: "receivable",
            //       dateFormat: "%Y-%m-%d",
            //       trigger: "receivable.onclick",
            //       bottomBar: true,
            //       weekNumbers: true,
            //       onSelect: function() {this.hide();}
            //     });
        },
        onSaveRequest: function(r) {
            ProductApp.gridReload();
        },
        // insert: {
        // },
        insert: false,
        save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(804),
        dataType: 'json',
        colModel: [
            {
               display: '訂單編號',
               name: 'oid', 
               width: 100, 
               align: 'center', 
            }, {
               display: '現金',
               name: 'cash', 
               width: 60, 
               align: 'center'
            }, {
               display: '+ 運費',
               name: 'fare', 
               width: 60, 
               align: 'center'
            }, {
               display: '- 購物金',
               name: 'coupon', 
               width: 60, 
               align: 'center'
            }, {
               display: '- 退貨金',
               name: 'reject_shopgold', 
               width: 60, 
               align: 'center'
            }, {
               display: '= 總金額',
               name: 'total2', 
               width: 60, 
               align: 'center'
            // }, {
            //    display: '總金額',
            //    name: 'total', 
            //    width: 60, 
            //    align: 'center'
            // }, {
            //    display: '現金',
            //    name: 'cash', 
            //    width: 60, 
            //    align: 'center'
            // }, {
            //    display: '購物金',
            //    name: 'coupon', 
            //    width: 60, 
            //    align: 'center'
            // }, {
            //    display: '交易日期',
            //    name: 'date1', 
            //    width: 80, 
            //    align: 'center'
            }, {
               display: '取貨日期',
               name: 'date2', 
               width: 80, 
               align: 'center'
            }, {
               display: '收款日期',
               name: 'date3', 
               width: 80, 
               align: 'center'
            }, {
               display: '核帳日期',
               name: 'check_date', 
               width: 80, 
               align: 'center'
            }, {
               display: '使用付款方式',
               name: 'methods', 
               width: 100, 
               align: 'center'
            }, {
               display: '取貨方式',
               name: 'getmode', 
               width: 60, 
               align: 'center'
            }, {
               display: '專業經理人編號',
               name: 'lv1id', 
               width: 100, 
               align: 'center'

            }, {
                display: ' 換貨單列表 ',
                name: 'SWAPlist', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var date1 = $('#date1').val();
                    var date2 = $('#date2').val();
                    var url = Endold.linkTo(Swap_LIST_URL, {sn: Number(sn), date1: date1, date2: date2});
                    var $a = $('<a>點擊</a>')
                        .attr({href: url});
                    $(div).html($a);
                    // return div;
                }

            }, {
                display: ' 退貨單列表 ',
                name: 'REJECTlist', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var date1 = $('#date1').val();
                    var date2 = $('#date2').val();
                    var url = Endold.linkTo(Reject_LIST_URL, {sn: Number(sn), date1: date1, date2: date2});
                    var $a = $('<a>點擊</a>')
                        .attr({href: url});
                    $(div).html($a);
                    // return div;
                }

            }, {
                display: ' ',
                name: 'modify', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var $div = $(div).html('');
                    var m_url = Endold.linkTo('page/page08/order_modify.php', {sn: sn});
                    var d_url = Endold.linkTo('page/page08/order_detail.php', {sn: sn});
                    var $mlink = $('<a/>');
                    var $dlink = $('<a/>');

                    $mlink
                        .html('修改')
                        .attr('href', m_url)
                        .bind('click', option.modify);
                    $dlink
                        .html('明細')
                        .attr('href', d_url)
                        .bind('click', option.view);
                    $div
                        // .append($mlink)
                        // .append(' / ')
                        .append($dlink);

                }
            }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '訂貨單',
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
                height: 250,
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
