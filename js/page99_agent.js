(function(Endold, OptionBar) {
    /* agent 修改歷程記錄 */
    var LIST_URL = '/page/page99/agent_list.php';
    /* agent 修改記錄 */
    var VIEW_URL = '/page/page99/agent_view.php';

    var $option_main = $('#option-main');
    $search = {
        form: $('form.search-form'),
        type: $('form.search-form select[name=type]'),
        query: $('form.search-form input[name=query]'),
        query_clear: $('form.search-form a#clear-query')
    };

    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
            $search.form.bind('submit', app.onsubmitSearchForm);
            $search.type.bind('change', app.onsubmitSearchForm);
            $search.query_clear.bind('click', app.onclickClearQuery);
        },
        onsubmitSearchForm: function(event) {
            app.search();
            event && event.preventDefault();
        },
        onclickClearQuery: function() {

            $search.query.val('');
            event && event.preventDefault();
        },
        findUser: function(event) {
            $search.query.val($(this).data('row.account'));
            app.search();
            event && event.preventDefault();
        },
        search: function() {
            option.cancel();
            grid.flexOptions({newp: 1});
            grid.flexReload();

        },
        addGridFormData: function() {
            var data = $search.form.serializeArray();
            grid.flexOptions({params: data});
            return true;
        }
    };


    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $option_main,
        formElement: '#option-form',
        height: 420,
        insert: false,
        save: false,
        cancel: {},
        onShow: function() {
            view.init();
        }
    });

    var grid = $('#log-list').flexigrid({
        url: Endold.cmdTo(9900),
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
                name: 'type', 
                width: 200,
                align: 'center',
                process: function(div, id) {
                    var type = div.innerHTML;
                    var $a = $('<a>檢視</a>')
                        .attr({href: Endold.linkTo(VIEW_URL, {id: id, type: type}) })
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
                name: 'account', 
                width: 100, 
                align: 'center',
                process: function(div) {
                    var account = div.innerHTML;
                    div.innerHTML = '';
                    $('<a href="#">修改歷程</a>')
                        .data('row.account', account)
                        .bind('click', app.findUser)
                        .appendTo($(div));
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