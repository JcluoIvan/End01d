(function(Endold, OptionBar) {
    var $pid = null;
    var $formSearch = null;
    var $searchBtn = null;

    var $modify = {
        selectCountry: null
    };

    var $demo_modal = null;
    var $clear_date = null;
    var $my_friends = null;

    var app = {
        cmd: null,

        init: function() {
            $pid = $('#pid').val();
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');

            $demo_modal = $('#demo-modal');
            $clear_date = $('.clear-date');
            $my_friends = $('#my-friends');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);

            $clear_date.bind('click', app.onclearDate);
        },
        stopEvent: function(){
            event && event.preventDefault();
        },
        disabled: function(){
            if (!confirm('確認除會?'))
                return false;
            var id = $(this).attr('id');
            Endold.post(1123, {id: id})
                .done(app.gridReload);
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
        onLoadModifyInit: function() {
            var $is_city = $('#is_city');
            var value = parseInt($is_city.html());
            $is_city.css('display', 'none');

            app.onChangeModifyCity();

            if (value)
                $('#city-' + value).prop('selected', true);

            $modify.selectCountry.bind('change', app.onChangeModifyCity);
        },
        onChangeModifyCity: function() {
            var postId = $modify.selectCountry.val();
            $('#city option').addClass('hide');
            $('#city option.pid-' + postId).removeClass('hide');
            $('#city option').not('.hide').eq(0).prop('selected', true);
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
        // onModify: function() {
        //     var $this = $(this);
        //     var id = $this.attr('id') || 0;
        //     var url =
        //         $this.attr('url') ||
        //         '/page/page11/organize_member_modify.php';

        //     app.cmd = $this.attr('cmd') || 1121;

        //     var is_black = parseInt($this.attr('is_black')) || 0;

        //     $pid = $('#pid').val();

        //     /* 已加入黑名單 回傳 false */
        //     if (is_black === 1)
        //         return false;

        //     return Endold.linkTo(
        //         url, {
        //             pid: $pid,
        //             id: id
        //         }
        //     );
        // },
        // onSave: function() {
        //     var ret = Endold.cmdTo(app.cmd);
        //     // app.cmd = null;

        //     return ret;
        // },
        // onSaveRequest: function(r) {
        //     // console.log(r);
        //     OrganizeMemberApp.gridReload();
        // },
        // onShow: function() {
        //     detail.init();
        //     var $form = $('#option-form');
        //     $modify.selectCountry = $form.find('#country');
        //     app.onLoadModifyInit();

        //     $('#date').length &&
        //         new Calendar({
        //             inputField: "date",
        //             dateFormat: "%Y-%m-%d",
        //             trigger: "date.onclick",
        //             bottomBar: true,
        //             weekNumbers: true,
        //             onSelect: function() {
        //                 this.hide();
        //             }
        //         });
        // },
        insert: false,
        save: false,
        cancel: false
    });

    var grid = $('#organize_member-list').flexigrid({
        url: Endold.cmdTo(1322),
        dataType: 'json',
        colModel: [
            {
               display: '編號',
               name: 'no',
               width: 150,
               align: 'center'
            }, {
               display: '名稱',
               name: 'name',
               width: 100,
               align: 'center',
            }, {
               display: '手機',
               name: 'phone',
               width: 150,
               align: 'center',
            }/*, {
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
            }, {
                display: '黑名單',
                name: 'is_blacklist',
                width: 100,
                align: 'center',
                process: function(div, id) {
                    var is_black = div.innerHTML;
                    var className = Number(is_black)
                        ? 'blackTrue'
                        : 'blackFalse';
                    var name = Number(is_black)
                        ? '已加入'
                        : '未加入' ;
                    var $div = $(div).html('');
                    $('<a/>')
                        .attr({
                            href: '#',
                            cmd: 1124,
                            url: '/page/page11/blacklist_modify.php',
                            id: id,
                            is_black: is_black
                        })
                        .addClass(className)
                        .html(name)
                        .bind('click', option.modify)
                        .appendTo($div);
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
                display: '',
                name: 'disabled',
                width: 80,
                align: 'center',
                process: function(div, id) {
                    var $a = $('<a>除會</a>')
                        .attr({href: '#', id: id})
                        .bind('click', app.disabled);

                    $(div).html($a);
                    // return div;
                }
            }, {
                display: ' ',
                name: 'options',
                width: 80,
                align: 'center',
                process: function(div, id) {
                    var $a = $('<a>修改</a>')
                        .attr({href: '#', id: id})
                        .bind('click', option.modify);
                    $(div).html($a);
                }
            },{
               display: '',
               name: 'qrcode',
               width: 150,
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
            }*/
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
    window.OrganizeMemberApp = app;
    window.OrganizeMemberAppeGrid = grid;
})(top.Endold, top.OptionBar);