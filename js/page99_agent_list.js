(function(Endold, OptionBar) {
    var VIEW_URL = '/page/page99/agent_view.php';

    var app = {
        $form: null,
        init: function() {
            app.$form = $('#agent-log');
            app.bindEvents();
        },
        bindEvents: function() {
        },
        addGridFormData: function() {
            grid.flexOptions({params: app.$form.serializeArray()});
            return true;
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
        onShow: function() {
            view.init();
        }
    });

    var grid = $('#news-list').flexigrid({
        url: Endold.cmdTo(9901),
        dataType: 'json',
        colModel: [
            {
                display: '帳號',
                name: 'account',
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
                name: 'content', 
                width: 200,
                align: 'center',
                process: function(div, id) {
                    var $a = $('<a>檢視</a>')
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
            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '歷程',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250,
        onSubmit: app.addGridFormData

    });

    var view = {
        grid: null,
        init: function() {
            var lid = $('#log-id').val();
            view.grid = $('#log-view').flexigrid({
                url: Endold.cmdTo(9902),
                dataType: 'json',
                colModel: [
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
                ],
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