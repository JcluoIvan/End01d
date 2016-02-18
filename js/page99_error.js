(function(Endold, OptionBar) {
    /* error 錯誤記錄 */
    var VIEW_URL = '/page/page99/error_view.php';

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
        onShow: function() {
            view.init();
        }
    });

    var grid = $('#log-list').flexigrid({
        url: Endold.cmdTo(9980),
        dataType: 'json',
        colModel: [
            {
                display: '錯誤類型',
                name: 'type',
                width: 80,
                align: 'center'
            }, {
                display: '錯誤敘述',
                name: 'caption', 
                width: 200,
                align: 'center'
            }, {
                display: '路徑',
                name: 'path', 
                width: 160,
                align: 'center'
            }, {
                display: '操作人',
                name: 'user', 
                width: 100,
                align: 'center'
            }, {
                display: '時間',
                name: 'time', 
                width: 200,
                align: 'center'
            }, {
                display: '內容',
                name: 'content',
                width: 80,
                align: 'center',
                process: function(div, id) {
                    div.innerHTML = '';
                    $('<a />')
                        .html('內容')
                        .attr({href: Endold.linkTo(VIEW_URL, {id: id}) })
                        .bind('click', option.view)
                        .appendTo($(div));
                }

            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '錯誤記錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250

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