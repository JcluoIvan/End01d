(function(Endold, OptionBar) {
    var $formSearch = null;
    var $searchBtn = null;
    var $lvKind = null;

    var $demo_modal = null;
    var $clear_date = null;
    var $my_friends = null;

    var app = {
        cmd: null,

        init: function() {
            $pid = $('#pid').val();
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');
            $lvKind = $('#lv-kind');

            $demo_modal = $('#demo-modal');
            $clear_date = $('.clear-date');
            $my_friends = $('#my-friends');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
            $lvKind.bind('change', app.changePage);

            $clear_date.bind('click', app.onclearDate);
        },
        stopEvent: function(){
            event && event.preventDefault();
        },
        gridReload: function() {
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $formSearch.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        changePage: function() {
            var $this = $(this);
            var url = $this.val() + '.php';
            location.href = Endold.linkTo(url);
        },
        onclearDate: function() {
            var target = $(this).attr('clear-target');
            var $input = $(target);
            ($input.length) && $input.val('');
        },

        showDialog: function() {
            var $this = $(this);
            // $('#oid').val($this.data('oid'));
            $my_friends.prop('src', $this.data('url'));
            $demo_modal.modal('show');

            return true;
        },
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            var $this = $(this);
            var $url = $this.attr('url');
            var $id = $this.attr('id');
            return Endold.linkTo($url, {id: $id});
        },
        onSave: function() {
        },
        onSaveRequest: function(r) {
        },
        onShow: function() {
            detail.init();
        },
        insert: false,
        save: false,
        cancel: {}
    });

    var grid = $('#member-list').flexigrid({
        url: Endold.cmdTo(1103),
        dataType: 'json',
        colModel: [
            {
               display: '編號',
               name: 'no', 
               width: 100, 
               align: 'center'
            }, {
               display: '名稱',
               name: 'name', 
               width: 100, 
               align: 'center', 
            }, {
               display: '手機',
               name: 'phone', 
               width: 100, 
               align: 'center', 
            }, {
                display: '訂購記錄',
                name: 'black_join', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var $div = $(div);
                    $div.html('');
                    var url = 'page/page11/order_record.php';

                    var $a = $('<a>明細</a>')
                        .attr({href: '#', url: url, id: id})
                        .bind('click', option.modify)
                        .appendTo($div);
                }
            }, 
            // {
            //     display: '',
            //     name: '', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, id) {
            //         var $div = $(div);
            //         $div.html('');
            //         var url = Endold.linkTo('dialogue.php', {id: id});
            //         var $a = $('<a>客服記錄</a>')
            //             .attr({href: url})
            //             .appendTo($div);
            //     }
            // }, 
            {
               display: '',
               name: 'qrcode', 
               width: 100, 
               align: 'center', 
               process: function (div) {
                    var $div = $(div);
                    var url = $div.html();
                    var $a = $('<a>顯示QRcode</a>')
                        .attr({
                            href: url,
                            target: '_blank'
                        });
                    $div.html($a);

                    if (! url || url == 0)
                        $div.hide();
               }
            }, {
                display: '',
                name: '', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var $div = $(div);
                    $div.html('');
                    var url = Endold.linkTo('friends.php', {id: id});
                    var $a = $('<a/>')
                        .attr('href', '#')
                        .html('好友')
                        .data('url', url)
                        .bind('click', app.showDialog)
                        .appendTo($div);
                }
            }, {
               display: '專業經理人 (編號 - 名稱)',
               name: 'leader', 
               width: 150, 
               align: 'center'
            }, {
               display: '展示中心 (編號 - 名稱)',
               name: 'radar', 
               width: 150, 
               align: 'center', 
            },
        ],
        method: 'POST',
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData

    });

    var detail = {
        $formSearch: null,

        init: function() {
            detail.$formSearch = $('#option-form-search');

            detail.grid = $('#order-record-list').flexigrid({
                url: Endold.cmdTo(1106),
                dataType: 'json',
                colModel: [
                    {
                       display: '日期',
                       name: 'date', 
                       width: 200, 
                       align: 'center'
                    }, {
                       display: '訂單編號',
                       name: 'oid',
                       width: 200,
                       align: 'center',
                    }, {
                       display: '金額',
                       name: 'money', 
                       width: 200, 
                       align: 'center', 
                    }, {
                        display: '',
                        name: 'sn',
                        width: 200,
                        align: 'center',
                        process: function(div, id) {
                            var $sn = div.innerHTML;
                            var $div = $(div).html('');
                            var url = Endold.linkTo('buy_detail.php', {oid: $sn});
                            var $a = $('<a/>')
                                .attr('href', url)
                                .html('明細')
                                .appendTo($div);
                        }
                    },
                ],
                method: 'POST',
                idProperty: 'id',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: '訂購紀錄',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                onSubmit: detail.addGridFormData,
            });
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = detail.$formSearch.serializeArray();
            detail.grid.flexOptions({params: data});
            return true;
        },
    };
    app.init();
    window.MemberApp = app;
    window.MemberAppeGrid = grid;
})(top.Endold, top.OptionBar);