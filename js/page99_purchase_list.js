(function(Endold, OptionBar) {
    var VIEW_URL = '/page/page99/purchase_view.php';

    var app = {
        $form: null,
        init: function() {
            app.$form = $('#purchase-log');
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
        height: 350,
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

    var grid = $('#news-list').flexigrid({
        url: Endold.cmdTo(9941),
        dataType: 'json',
        colModel: [
            {
                display: '展示中心',
                name: 'agent',
                width: 120,
                align: 'center'
            }, {
                display: '資料類型',
                name: 'type_name', 
                width: 120,
                align: 'center'
            }, {
                display: '商品名稱',
                name: 'product_name', 
                width: 120,
                align: 'center'
            }, {
                display: '操作行為',
                name: 'action_name', 
                width: 120,
                align: 'center'
            }, {
                display: '內容',
                name: 'action', 
                width: 200,
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
        action: null, /* 此資料的行為 ( add, edit, delete) */
        init: function() {
            var lid = $('#log-id').val();
            var columns = {
                add: view.addActionColumns,
                edit: view.editActionColumns,
                delete: view.deleteActionColumns
            };

            view.grid = $('#log-view').flexigrid({
                url: Endold.cmdTo(9942),
                dataType: 'json',
                colModel: columns[view.action](),
                idProperty: 'id',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: '修改記錄',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                params: [ {name: 'lid', value: lid} ],
            });

        },
        editActionColumns: function() {
            return [
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
        },
        addActionColumns: function() {
            return [
                {
                    display: '欄位名稱',
                    name: 'name',
                    width: 120,
                    align: 'center'
                }, {
                    display: (view.action =='add' ? '新增資料' : '刪除資料'),
                    name: 'new', 
                    width: 120,
                    align: 'center'
                }
            ];
        },
        deleteActionColumns: function() {
            return [
                {
                    display: '欄位名稱',
                    name: 'name',
                    width: 120,
                    align: 'center'
                }, {
                    display: (view.action =='add' ? '新增資料' : '刪除資料'),
                    name: 'old', 
                    width: 120,
                    align: 'center'
                }
            ];
        }
    };
    app.init();
})(top.Endold, top.OptionBar);