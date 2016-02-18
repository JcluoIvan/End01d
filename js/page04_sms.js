(function(Endold, OptionBar) {
    var MODIFY_URL = '/page/page04/sms_modify.php';
    var VIEW_URL = '/page/page04/sms_view.php';
    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
        },
        gridReload: function() {
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            var id = $(this).attr('nid') || 0;
            return Endold.linkTo(MODIFY_URL, {id: id});
        },
        onSave: function() {
            return Endold.cmdTo(400);
        },
        onShow: function() {
            modify.init();
        },
        onSaveRequest: function(response) {

            if (! response.status) {
                alert(response.message)
                return false;
            }

            NewsApp.gridReload();

        },
        insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#news-list').flexigrid({
        url: Endold.cmdTo(401),
        dataType: 'json',
        colModel: [
            {
               display: '發送時間',
               name: 'time', 
               width: 200, 
               align: 'center'
            }, {
                display: '通知對象',
                name: 'notice_for',
                width: 200,
                align: 'center'
            }, {
               display: '內容',
               name: 'content', 
               width: 400
               // align: 'center'
            }, {
                display: ' ',
                name: 'view', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var $a = $('<a>檢視</a>')
                        .attr({href: Endold.linkTo(VIEW_URL, {id: id}) })
                        .bind('click', option.view);

                    $(div).html($a);
                    // return div;
                }
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
        height: 300,
        params: [{name: 'type', value: 'sms'}]

    });


    /* modify 用到的 grid, 由 option.onShow 時設定 */
    var modify = {
        grid: null,
        notice_for: null,
        rows: [],
        $label: null,
        $all_checked: null,
        $count: null,
        $notice_for: null,
        $users: null,
        $list_panel: null,
        $form: null,
        $query_text: null,
        $query_button: null,
        init: function($form) {
            modify.grid = $('#member-grid').flexigrid({
                url: Endold.cmdTo(402),
                dataType: 'json',
                colModel: [
                    {
                        display: '<input class="all-checked" type="checkbox"/>',
                        name: 'select',
                        width: 60,
                        align: 'center',
                        process: function(div, id) {
                            var $input = $('<input type="checkbox" />');

                            id = Number(id);
                            $input.prop('checked', $.inArray(id, modify.rows) >= 0);

                            $(div).html($input)
                                .addClass('cursor-point')
                                .data('member.id', id)
                                .bind('click', modify.selectMember);

                        }
                    }, {
                        display: '編號',
                        name: 'no',
                        width: 120,
                        align: 'center'
                    }, {
                        display: '姓名',
                        name: 'name',
                        width: 100,
                        align: 'center'
                    }, {
                        display: '手機',
                        name: 'phone',
                        width: 100,
                        align: 'center'
                    }
                ],
                showToggleBtn: false,
                idProperty: 'id',
                sortname: 'id',
                sortorder: 'asc',
                usepager: true,
                title: '<label id="grid-label"></label> - 已選取 : <span id="selected-count">0</span>',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                height: 275,
                onSubmit: modify.addGridFormData
            });


            modify.$form = $('#option-form');

            modify.$all_checked = $('.hDivBox .all-checked');

            modify.$count = $('#selected-count');

            modify.$label = $('#grid-label');

            modify.$notice_for = $('#notice-for');

            modify.$users = $('#users');

            modify.$list_panel = $('#member-list-options');

            modify.$query_type = $('#query-type');

            modify.$query_text = $('#query-text');

            modify.$query_button = $('#query-button');

            modify.bindEvents();
        },
        bindEvents: function() {
            modify.$all_checked.bind('click', modify.onClickAllChecked)
            modify.$notice_for.bind('change', modify.onChangeNoticeFor);
            modify.$query_text.bind('keydown', modify.onKeyPassQueryText);
            modify.$query_button.bind('click', function() { modify.grid.flexReload(); });
        },
        onChangeNoticeFor: function() {
            var show = (this.value == 'none' || this.value == 'all');
            modify.$list_panel.toggleClass('hide', show);
            (! show) && modify.grid.flexReload();

        },
        onKeyPassQueryText: function(event) {
            (event.keyCode == 13) && modify.grid.flexReload();
        },
        addGridFormData: function() {

            if (! modify.$list_panel || modify.$list_panel.hasClass('hide')) {
                return false;
            }

            var data = [
                {name: 'notice_for', value: modify.$notice_for.val()},
                {name: 'query_type', value: modify.$query_type.val()},
                {name: 'query_text', value: modify.$query_text.val()}
            ];

            if (modify.$notice_for.val() != modify.notice_for) {
                modify.notice_for = modify.$notice_for.val();
                modify.$label.html(modify.$notice_for.find(':selected').html());
                modify.rows = [];
                modify.$users.val('');
                modify.$count.html(0);
                modify.$all_checked.prop('checked', false);
                modify.grid.flexOptions({newp: 1});

            }
            modify.grid.flexOptions({params: data});
            return true;
        },
        onClickAllChecked: function() {
            var $this = $(this);
            var isChecked = $this.prop('checked');

            if (isChecked) {
                modify.grid
                    .find('input[type=checkbox]')
                    .not(':checked')
                        .trigger('click');
            } else {
                modify.grid
                    .find('input[type=checkbox]')
                    .filter(':checked')
                        .trigger('click');
            }
            // $this.prop('checked', isChecked);
        },
        selectMember: function() {
            var $this = $(this);
            var id = Number($this.data('member.id'));
            var idx = $.inArray(id, modify.rows);

            if (idx >= 0) {
                modify.rows.splice(idx, 1);
                modify.$all_checked.prop('checked', false);
            } else {
                modify.rows.push(id);
            }
            $this.find('> input').prop('checked', idx < 0);
            modify.$users.val(modify.rows.join(','));
            modify.$count.html(modify.rows.length);
        }

    };

    app.init();
    window.NewsApp = app;
    window.NewsGrid = grid;
})(top.Endold, top.OptionBar);