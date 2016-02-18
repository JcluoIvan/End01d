(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var Reject_LIST_URL = '/page/page03/reject_list.php';
    var Swap_LIST_URL = '/page/page03/swap_list.php'; 
    var $searchForm = null;
    var $demo_modal = $('#demo-modal');

    var app = {
        $clear_date: null,
        init: function() {
            $searchForm = $('#command-search');
            $printButton = $('#print');
            $clear_date = $('.clear-date');
            new Calendar({
                  inputField: "date1",
                  dateFormat: "%Y-%m-%d",
                  trigger: "trigger1",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
            new Calendar({
                  inputField: "date2",
                  dateFormat: "%Y-%m-%d",
                  trigger: "trigger2",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
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
            $printButton.bind('click', app.onclickPrint);
        },
        onclickPrint: function() {
            var no = $('#no').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page03/order_print.php', {
                no: no,
                date1: date1,
                date2: date2
            });
            window.open(url);
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
            var data = $(this).serialize();
            Endold.post(320, data)
                .done(app.requestUpdate);
            event && event.preventDefault();
        },
        requestUpdate: function(){ 
            $demo_modal.modal('hide');
            grid.flexReload();
        },
        saveRequest: function() {
            var $this = $(this);
            var $body = $($this[0].contentDocument.body);
            var response = $body.find('*').length 
                ? $body.find('*').html() 
                : $body.html();

            response = $.parseJSON(response);

            if (response.status) {
                option.cancel();
                app.gridReload();
            } else {
                if (! response.status && typeof response.validates === 'object') {
                    option.validates(response.validates);
                } else if (
                    OptionBar.onSaveRequest && 
                    OptionBar.onSaveRequest.apply(this, arguments) !== false
                ) {
                    option.state('default');
                    option.cancel();
                }

            }
        },
        reloadModifyImage: function(files){
            $('#photo-images').html('');
            // $('#photo-sgs').html('');
            $('#upload-images-list').html('');
            // $('#upload-sgs-list').html('');
            // image
            for (var row in files.images) {
                var str = "<img ";
                str += "class='productImg' ";
                str += "src='"+files.images[row]['src']+"' />";

                str += "<input ";
                str += "type='checkbox' ";
                str += "class='imageCheckbox'";
                str += "name='deleteImage[]' ";
                str += "value='"+files.images[row]['filename']+"' />";

                var $images = $('<label />')
                    .attr("class","imgPointer")
                    .html(str);

                $images.appendTo('#photo-images'); 

                // if (files.images[row]['sort'] == 1) {
                //     $images.appendTo('#photo-images');            
                // }
                // if (files.images[row]['sort'] == 2) {
                //     $images.appendTo('#photo-sgs');            
                // }
            }
            // upload
            for (var row in files.total) {
                var name = row == 'sgs' 
                    ? 'files[sgs][]'
                    : 'files[product][]';

                // 目前檔案上傳只設定傳一張
                for (var i=files.total[row]; i<1; i++) {
                    var $upload = $('<input />').attr({
                        type: 'file',
                        name: name,
                        'class': 'form-control'
                    });

                    if (row == 'img') {
                        $upload.appendTo('#upload-images-list');  
                    }
                }
            }
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function(event) {
            event && event.preventDefault();
            grid.flexReload();
        },
        deleteOrder: function() {
            if (! confirm('確定刪除此訂單？')) return ;

            var sn = $(this).data('order.sn');
            Endold.post(327, {sn: sn})
                .done(app.deleteRequest);

        },
        deleteRequest: function(o) {
            if (! o.status) return alert(o.message);
            app.gridReload();

        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 750,
        onModify: function() {
            return $(this).attr('href') || Endold.linkTo('/page/page03/order_detail.php', {id: id});
        },
        onSave: function() {
            var $this = $(this);
            if ($this.hasClass('reject')) {
                return Endold.cmdTo(300);
            } else if ($this.hasClass('swap')) {
                return Endold.cmdTo(304);
            } else if ($this.hasClass('modify')) {
                var $form = $('#option-form');
                $form.attr('action', Endold.cmdTo(308));
                $form.trigger('submit');
                return false;
            }
            // var $form = $('#option-form');
            // $form.attr('action', Endold.cmdTo(317));
            // $form.trigger('submit');
        },
        onShow: function() {
            modify.init();
            var $iframe = $('#iframe-save');
            $iframe.bind('load', app.saveRequest);
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
        url: Endold.cmdTo(301),
        dataType: 'json',
        colModel: [ 
            {
               display: '訂單編號',
               name: 'oid', 
               width: 100, 
               align: 'center'
            }, {
               display: '訂貨人',
               name: 'name', 
               width: 60, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 60, 
               align: 'center'
            }, {
               display: '取貨方式',
               name: 'getmode', 
               width: 60, 
               align: 'center',
               process: function(div, sn) {
                    var data = div.innerHTML.split(',');
                    var type = data[0];
                    var no = data[1];
                    var date = data[2];
                    if(type=='csv'){
                        $(div).html('到店取貨');
                    }else{
                        var $demo_modal = $('#demo-modal');
                        var $a = $('<a/>')
                            .html('宅配')
                            .data('order.id', sn)
                            .data('order.no', no)
                            .data('order.date', date)
                            .bind('click', app.onshowDialog);
                        $(div).html($a);
                    }
                }
            }, {
               display: '付款方式',
               name: 'methods', 
               width: 60, 
               align: 'center'
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
            }, {
               display: '交易日期',
               name: 'date1', 
               width: 80, 
               align: 'center'
            }, {
               display: '出貨日期',
               name: 'date2', 
               width: 80, 
               align: 'center'   
            }, {
               display: '核帳日期',
               name: 'check_date', 
               width: 80, 
               align: 'center'
            }, {
               display: '最後修改人員',
               name: 'keyman', 
               width: 100, 
               align: 'center'

            }, {
                display: '換貨單列表',
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
                display: '退貨單列表',
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
                width: 100, 
                align: 'center',
                process: function(div, sn) {
                    var $div = $(div).html('');
                    var date1 = $('#date1').val();
                    var date2 = $('#date2').val();
                    var m_url = Endold.linkTo('page/page03/order_modify.php', {sn: sn});
                    var d_url = Endold.linkTo('page/page03/order_detail.php', {sn: sn});
                    var p_url = Endold.linkTo('order_detail_print.php', {sn: sn,date1: date1,date2: date2});
                    var $mlink = $('<a/>');
                    var $dlink = $('<a/>');
                    var $plink = $('<a/>');

                    $mlink
                        .html('修改')
                        .attr('href', m_url)
                        .bind('click', option.modify);
                    $dlink
                        .html('明細')
                        .attr('href', d_url)
                        .bind('click', option.view);
                    $plink
                        .html('列印')
                        .attr('href', p_url);
                        // .bind('click', option.view);
                    $div
                        .append($mlink)
                        .append(' / ')
                        .append($dlink)
                        .append(' / ')
                        .append($plink);

                }
            }, {
                display: '',
                name: 'delete', 
                width: 60, 
                align: 'center',
                process: function(div, sn) {
                    var can_delete = Number(div.innerHTML) || 0;
                    var $link = '-';
                    if (can_delete) {
                        $link = $('<a class="delete-link">刪除訂單</a>')
                            .data('order.sn', sn)
                            .bind('click', app.deleteOrder);
                    }
                    $(div).empty().html($link);

                    // return div;
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
        $clear_date: null,
        $remove_receipt: null,
        init: function($form) {
            modify.grid = $('#member-grid').flexigrid({
                url: Endold.cmdTo(314),
                dataType: 'json',
                colModel: [
                    {
                        display: '產品編號',
                        name: 'no',
                        width: 100,
                        align: 'center'
                    }, {
                        display: '品名',
                        name: 'name',
                        width: 100,
                        align: 'center'
                    }, {
                        display: '產品單價',
                        name: 'money',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '購買數量',
                        name: 'count',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '- 退貨數量',
                        name: 'reject_count',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '=  剩餘數量',
                        name: 'totalcount',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '購買金額',
                        name: 'total',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '- 退貨金額',
                        name: 'reject_money',
                        width: 80,
                        align: 'center'
                    }, {
                        display: '= 剩餘金額',
                        name: 'totalmoney',
                        width: 80,
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
                rpOptions: [10, 15, 20, 30, 50],
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

            modify.$clear_date = $('.clear-date');

            modify.$remove_receipt = $('#remove-receipt-image');

            $('#delivery').length &&
                new Calendar({
                      inputField: "delivery",
                      dateFormat: "%Y-%m-%d",
                      trigger: "delivery.onclick",
                      bottomBar: true,
                      weekNumbers: true,
                      onSelect: function() {this.hide();}
                    });
            $('#signoff').length &&
                new Calendar({
                      inputField: "signoff",
                      dateFormat: "%Y-%m-%d",
                      trigger: "signoff.onclick",
                      bottomBar: true,
                      weekNumbers: true,
                      onSelect: function() {this.hide();}
                    });
            $('#receivable').length &&
                new Calendar({
                      inputField: "receivable",
                      dateFormat: "%Y-%m-%d",
                      trigger: "receivable.onclick",
                      bottomBar: true,
                      weekNumbers: true,
                      onSelect: function() {this.hide();}
                    });
            modify.bindEvents();
        },
        bindEvents: function() {
            modify.$clear_date.bind('click', modify.clearDate);
            modify.$remove_receipt.bind('click', modify.removeReceipt);
        },
        clearDate: function() {
            var target = $(this).attr('clear-target');
            var $input = $(target);
            ($input.length) && $input.val('');
        },
        removeReceipt: function() {

            var $files = Array();
            // var $id = $('input[name="id"]').val();
            var id = $(this).attr('rid');

            if (confirm('確定刪除發票')) {
                Endold.post(317, {id: id})
                    .done(modify.requestRemoveReceipt);
            }

            // if (! $files.length) return;
            // if (! confirm('刪除圖片')) return;

            // Endold.post(317, {id: id, files: $files})
            //       .done(app.reloadModifyImage);
            // event && event.preventDefault();

        },
        requestRemoveReceipt: function(response) {
            if (response) {
                /* 成功刪除後, 修改發票顯示的樣式 */
            }
            alert(response.message);
        }

    };

    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);