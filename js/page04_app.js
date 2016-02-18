(function(Endold, OptionBar) {
    var MODIFY_URL = '/page/page04/app_modify.php';
    var $form = null;
    var $iframe = null;

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
    var $modify = {
        form: null,
        iframe: null,
        rmeove: null,
        image_wrapper: null,
        image_link: null
    };
    var modify = {
        init: function() {
            $modify.form = $('#option-form');
            $modify.form.attr('action', Endold.cmdTo(400));

            $modify.iframe = $('#iframe-save');
            $modify.iframe.bind('load', modify.saveRequest);

            $modify.remove = $('#remove-image');
            $modify.remove.bind('click', modify.removeImage);

            $modify.image_wrapper = $('#image-wrapper');
            $modify.image_link = $('#image-link');
            // modify.init();
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
                grid.flexReload();
            } else {
                if (! response.status && typeof response.validates === 'object') {
                    option.validates(response.validates);
                } else if (
                    OptionBar.onSaveRequest && 
                    OptionBar.onSaveRequest.apply(this, arguments) !== false
                ) {
                    alert(response.message);
                }

            }
        },
        removeImage: function() {
            var id = Number($(this).attr('news-id'));
            if (! confirm('確定刪除此圖片？')) return ;

            Endold.post(403, {id: id})
                .done(modify.requestRemoveImage);
        },
        requestRemoveImage: function(response) {
            if (! response.status) return alert(response.message);
            if ($modify.image_wrapper.length) {
                $modify.image_wrapper.remove();
            }
        },
        onsave: function() {
            $modify.form.trigger('submit');
            return false;

        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 400,
        onModify: function() {
            var id = $(this).attr('nid') || 0;
            return Endold.linkTo(MODIFY_URL, {id: id});
        },
        onSave: modify.onsave,
        onShow: modify.init,
        insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#news-list').flexigrid({
        url: Endold.cmdTo(401),
        dataType: 'json',
        colModel: [
            {
            //    display: '通知對象',
            //    name: 'notice_for', 
            //    width: 160, 
            //    align: 'center'
            // }, {
               display: '建立時間',
               name: 'time', 
               width: 160, 
               align: 'center'
            }, {
               display: '標題',
               name: 'title', 
               width: 400
               // align: 'center', 
            }, {
                display: ' ',
                name: 'options', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var url = Endold.linkTo(MODIFY_URL, {id: id});
                    var $a = $('<a>修改</a>')
                        .attr({href: '#', nid: id})
                        .bind('click', option.modify);

                    $(div).html($a);
                    // return div;
                }
            // }, {
            //     display: ' ',
            //     name: 'view', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, id) {
            //         var url = Endold.linkTo('modify.php', {id: id});
            //         var $a = $('<a>檢視</a>')
            //             .attr({href: Endold.linkTo(MODIFY_URL, {id: id}) })
            //             .bind('click', option.view);

            //         $(div).html($a);
            //         // return div;
            //     }
            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        params: [{name: 'type', value: 'app'} ],
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300

    });


    /* modify 用到的 grid, 由 option.onShow 時設定 */
    // var modify = {
    //     grid: null,
    //     notice_for: null,
    //     rows: [],
    //     $label: null,
    //     $all_checked: null,
    //     $count: null,
    //     $users: null,
    //     $notice_for: null,
    //     $list_panel: null,
    //     $form: null,
    //     $query_text: null,
    //     $query_button: null,
    //     init: function($form) {
    //         modify.grid = $('#member-grid').flexigrid({
    //             url: Endold.cmdTo(402),
    //             dataType: 'json',
    //             colModel: [
    //                 {
    //                     display: '<input class="all-checked" type="checkbox"/>',
    //                     name: 'select',
    //                     width: 80,
    //                     align: 'center',
    //                     process: function(div, id) {
    //                         var $input = $('<input type="checkbox" />');

    //                         id = Number(id);
    //                         $input.prop('checked', $.inArray(id, modify.rows) >= 0);

    //                         $(div).html($input)
    //                             .addClass('cursor-point')
    //                             .data('member.id', id)
    //                             .bind('click', modify.selectMember);

    //                     }
    //                 }, {
    //                     display: '編號',
    //                     name: 'no',
    //                     width: 140,
    //                     align: 'center'
    //                 }, {
    //                     display: '姓名',
    //                     name: 'name',
    //                     width: 140,
    //                     align: 'center'
    //                 }
    //             ],
    //             searchitems : [
    //                 {display: '編號', name : 'no'},
    //                 {display: '姓名', name : 'name', isdefault: true}
    //             ],
    //             showToggleBtn: false,
    //             idProperty: 'id',
    //             sortname: 'id',
    //             sortorder: 'asc',
    //             usepager: true,
    //             title: '<label id="grid-label"></label> - 已選取 : <span id="selected-count">0</span>',
    //             useRp: true,
    //             rp: 10,
    //             showTableToggleBtn: true,
    //             height: 275,
    //             onSubmit: modify.addGridFormData
    //         });

    //         modify.$form = $('#option-form');

    //         modify.$all_checked = $('.hDivBox .all-checked');

    //         modify.$count = $('#selected-count');

    //         modify.$users = $('#users');

    //         modify.$label = $('#grid-label');

    //         modify.$notice_for = $('#notice-for');

    //         modify.$list_panel = $('#member-list-options');

    //         modify.$query_text = $('#query-text');

    //         modify.$query_button = $('#query-button');

    //         modify.bindEvents();

    //         modify.rows = [];


    //         var users = modify.$users.val();

    //         if (users) {

    //             modify.notice_for = modify.$notice_for.val();

    //             $.each(users.split(',') || [], function(i, value) {
    //                 modify.rows.push(Number(value));
    //             });

    //             modify.$notice_for.trigger('change');
                
    //         }


    //     },
    //     bindEvents: function() {
    //         modify.$all_checked.bind('click', modify.onClickAllChecked)
    //         modify.$notice_for.bind('change', modify.onChangeNoticeFor);
    //         modify.$query_button.bind('click', function() { 
    //             modify.grid.flexReload(); 
    //         });
    //     },
    //     onChangeNoticeFor: function() {
    //         var show = (this.value == 'none' || this.value == 'all');
    //         modify.$list_panel.toggleClass('hide', show);
    //         (! show) && modify.grid.flexReload();

    //     },
    //     addGridFormData: function() {

    //         if (! modify.$list_panel || modify.$list_panel.hasClass('hide')) {
    //             return false;
    //         }

    //         var data = [
    //             {name: 'notice_for', value: modify.$notice_for.val()},
    //             {name: 'query_text', value: modify.$query_text.val()}
    //         ];

    //         if (modify.$notice_for.val() != modify.notice_for) {
    //             modify.notice_for = modify.$notice_for.val();
    //             modify.$label.html(modify.$notice_for.find(':selected').html());
    //             modify.rows = [];
    //             modify.$count.html(0);
    //             modify.$users.val('');
    //             modify.$all_checked.prop('checked', false);
    //             modify.grid.flexOptions({newp: 1});
    //         }
    //         modify.grid.flexOptions({params: data});
    //         return true;
    //     },
    //     onClickAllChecked: function() {
    //         var $this = $(this);
    //         var isChecked = $this.prop('checked');

    //         if (isChecked) {
    //             modify.grid
    //                 .find('input[type=checkbox]')
    //                 .not(':checked')
    //                     .trigger('click');
    //         } else {
    //             modify.grid
    //                 .find('input[type=checkbox]')
    //                 .filter(':checked')
    //                     .trigger('click');
    //         }
    //         // $this.prop('checked', isChecked);
    //     },
    //     selectMember: function() {
    //         var $this = $(this);
    //         var id = Number($this.data('member.id'));
    //         var idx = $.inArray(id, modify.rows);

    //         if (idx >= 0) {
    //             modify.rows.splice(idx, 1);
    //             modify.$all_checked.prop('checked', false);
    //         } else {
    //             modify.rows.push(id);
    //         }
    //         $this.find('> input').prop('checked', idx < 0);
    //         modify.$users.val(modify.rows.join(','));
    //         modify.$count.html(modify.rows.length);
    //     }

    // };

    app.init();
    window.NewsApp = app;
    window.NewsGrid = grid;
})(top.Endold, top.OptionBar);