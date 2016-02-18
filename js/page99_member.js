(function(Endold, OptionBar) {
    /* agent 修改歷程記錄 */
    var LIST_URL = '/page/page99/member_list.php';
    /* agent 修改記錄 */
    var VIEW_URL = '/page/page99/member_view.php';

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
        height: 400,
        insert: false,
        save: false,
        cancel: {},
        onView: function() {
            view.action = $(this).data('row.action');
            return $(this).attr('href');
        },
        onShow: function() {
            view.init();
        }
    });

    var grid = $('#log-list').flexigrid({
        url: Endold.cmdTo(9910),
        dataType: 'json',
        colModel: [
            {
                display: '手機號碼',
                name: 'phone',
                width: 120,
                align: 'center'
            }, {
                display: '姓名',
                name: 'name', 
                width: 120,
                align: 'center'
            }, {
                display: '操作行為',
                name: 'action', 
                width: 120,
                align: 'center'
            }, {
                display: '內容',
                name: 'view', 
                width: 120,
                align: 'center',
                process: function(div, id) {
                    var $a = $('<a>檢視</a>')
                        .data('row.action', div.innerHTML)
                        .attr({href: Endold.linkTo(VIEW_URL, {id: id}) })
                        .bind('click', option.view);
                    $(div).html($a);
                    // return div;
                }
            }, {
                display: '操作者',
                name: 'editor', 
                width: 80, 
                align: 'center'
            }, {
                display: 'IP',
                name: 'ip', 
                width: 100, 
                align: 'center'
            }, {
                display: '操作時間',
                name: 'datetime', 
                width: 140, 
                align: 'center'
            }, {
                display: ' ',
                name: 'list', 
                width: 100, 
                align: 'center',
                process: function(div) {
                    var id = div.innerHTML;
                    var url = Endold.linkTo(LIST_URL, {id: Number(id)});
                    var $a = $('<a>修改歷程</a>')
                        .attr({href: url});
                    $(div).html($a);
                    // return div;
                }
            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '記錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250

    });
    var view = {
        grid: null,
        action: null, /* 此資料的行為 ( add, edit) */
        init: function() {
            var lid = $('#log-id').val();
            view.grid = $('#log-view').flexigrid({
                url: Endold.cmdTo(9912),
                dataType: 'json',
                colModel: columns,
                idProperty: 'id',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: $('#sub-title').val() || '記錄',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                params: [
                    {name: 'lid', value: lid}
                ]
            });
        }
    };
    var view = {
        grid: null,
        action: null, /* 此資料的行為 ( add, edit) */
        init: function() {
            var lid = $('#log-id').val();
            var columns = [
                {
                    display: '欄位名稱',
                    name: 'name',
                    width: 120,
                    align: 'center'
                }, {
                    display: '修改前',
                    name: 'old',
                    width: 160,
                    align: 'center'
                }, {
                    display: '修改後',
                    name: 'new', 
                    width: 160,
                    align: 'center'
                }
            ];
            console.log(view.action);
            if (view.action == 'add') {
                columns = [
                    {
                        display: '欄位名稱',
                        name: 'name',
                        width: 120,
                        align: 'center'
                    }, {
                        display: '新增資料',
                        name: 'new', 
                        width: 160,
                        align: 'center'
                    }
                ];
            }
            view.grid = $('#log-view').flexigrid({
                url: Endold.cmdTo(9912),
                dataType: 'json',
                colModel: columns,
                idProperty: 'id',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: $('#sub-title').val() || '記錄',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                params: [
                    {name: 'lid', value: lid}
                ]
            });
        }
    };
    app.init();
})(top.Endold, top.OptionBar);