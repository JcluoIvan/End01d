(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
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
            var url = Endold.linkTo('/page/page03/order_status_list_print.php', {
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
            } else if ($this.hasClass('status')) {
                return Endold.cmdTo(307);
            }
        },
        onShow: function() {
            modify.init();
        },
        onSaveRequest: function(r) {
            console.log(r);
            ProductApp.gridReload();
        },
        // insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(315),
        dataType: 'json',
        colModel: [
        // {
        //         display: 'ID',
        //         name: 'id',
        //         hi


        //     }, 
            {
               display: '訂單編號',
               name: 'oid', 
               width: 100, 
               align: 'center', 
            }, {
               display: '會員名稱',
               name: 'name', 
               width: 60, 
               align: 'center'
            }, {
               display: '金額',
               name: 'total', 
               width: 60, 
               align: 'center'
            // }, {
            //    display: '交易方式',
            //    name: 'methods', 
            //    width: 150, 
            //    align: 'center'
            }, {
               display: '宅配單號',
               name: 'getno', 
               width: 100, 
               align: 'center'
            }, {
               display: '出貨日期',
               name: 'date2', 
               width: 100, 
               align: 'center'
            }, {
                display: ' ',
                name: 'detail', 
                width: 100, 
                align: 'center',
                process: function(div, sn) {
                    var url = Endold.linkTo('page/page03/order_detail', {sn: sn});
                    var $a = $('<a/>')
                        .html('明細')
                        .bind('click', option.view)
                        .attr({href: Endold.linkTo('page/page03/order_detail.php', {sn: sn}) 
                        });

                    $(div).html($a);
                    // return div;
                }
            }
            // }, {
            //     display: ' ',
            //     name: 'swap', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, oid) {
            //         var url = Endold.linkTo('page/page03/order_swap.php', {oid: oid });
            //         var has = Number(div.innerHTML) !== 0;
            //         var $a = $('<a/>').html('換貨')

            //         if (has) {
            //             $a.css({color: '#aaa', cursor: 'not-allowed'});
            //         } else {
            //             $a.bind('click', option.modify)
            //                 .attr('href', url);
            //         }

            //         $(div).html($a);
            //         // return div;
            //     }

            // }, {
            //     display: ' ',
            //     name: 'reject', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, oid) {
            //         var url = Endold.linkTo('page/page03/order_reject.php', {oid: oid });
            //         var has = Number(div.innerHTML) !== 0;
            //         var $a = $('<a/>').html('退貨')

            //         if (has) {
            //             $a.css({color: '#aaa', cursor: 'not-allowed'});
            //         } else {
            //             $a.bind('click', option.modify)
            //                 .attr('href', url);
            //         }

            //         $(div).html($a);
            //         // return div;
            //     }

            // }, {
            //     display: ' ',
            //     name: 'edit', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, oid) {
            //         var url = Endold.linkTo('page/page03/order_status.php', {oid: oid});
            //         var $a = $('<a/>')
            //             .html('edit')
            //             .bind('click', option.modify)
            //             .attr({href: Endold.linkTo('page/page03/order_status.php', {oid: oid}) 
            //             });

            //         $(div).html($a);
            //         // return div;
            //     }
            // }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '出貨狀態查詢',
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
                url: Endold.cmdTo(314),
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