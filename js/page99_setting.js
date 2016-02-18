(function(Endold, OptionBar) {
    var MODIFY_URL = '/page/page99/setting_modify.php';

    var $bank_account = {
        filter: null,
        codes: null,
    };

    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
        },
        modifyBankAccount: function() {
            $bank_account.codes = $('select[name=bank_code]');
            $bank_account.filter = $('#bank-code-filter');
            $bank_account.filter.bind('input', app.filterBankCode);
        },
        filterBankCode: function() {
            var query = $(this).val().toString().replace(/\s/g, '');
            var $opt = $bank_account.codes.find('#filter-codes');
            if ($opt.length === 0) {
                $opt = $('<optgroup id="filter-codes"/>')
                    .prependTo($bank_account.codes);
            }
            if (query.length === 0) return $opt.remove();

            $opt.html('');

            $bank_account.codes.find('> option').each(function() {

                if (
                    (this.innerHTML.toString().indexOf(query) >= 0) ||
                    (this.value.toString().indexOf(query) >= 0)
                ) {
                    $opt.append($(this).clone());
                }
            });

            $opt.attr('label', '查詢-' + query);
            if ($opt.find('option').length === 0) {
                $('<option value="">查無相關資料</option>')
                    .prop('selected', true)
                    .appendTo($opt);
            } else {
                $opt.find('option').eq(0).prop('selected', true);
            }
        },
        changeSettingStatus: function() {
            var data = $(this).data('row.data');
            Endold.post(9991, {id: data.id, value: data.value})
                .done(app.request);
        },
        changeSettingNumber: function() {

            var data = $(this).data('row.data');
            while (true) {

                var value = prompt('修改數值', data.value);
                if (value === null) return;

                if (isNaN(value)) {
                    alert('只能輸入數字，請重新輸入');
                } else {
                    Endold.post(9991, {id: data.id, value: value})
                        .done(app.request);
                    return;
                }
            }
        },
        request: function(response) {
            if (! response.status) return;
            app.gridReload();
        },

        modifyMobileTitleImage: function() {
            $('#mobile-title-images-wrapper .image-item')
                .bind('click', app.onclickMobileTitleImage);
        },
        onclickMobileTitleImage: function() {
            $(this).toggleClass('active');
            var $img = $(this).find('img');
            var url = $img.attr('src');
            $('#mobile-title-image').attr('src', url);

            url = url.substring(url.lastIndexOf('/') + 1);
            $('input[name=image_name]').val(url);
        },
        saveRequest: function() {
            option.cancel();
            app.gridReload();
        },
        gridReload: function() {
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 180,
        insert: false,
        save: {},
        cancel: {},
        onShow: function() {
            var init_method = 'modify' + ($('#setting-key').val() || 'unknown');
            (init_method in app) && app[init_method]();
            $('#update-iframe').bind('load', app.saveRequest);
        },
        onSave: function() {
            $('#option-form')
                .attr('action', Endold.cmdTo(9992))
                .trigger('submit');
            return false;
        },
        onModify: function() {
            option.height($(this).data('options.height') || 180);
            return $(this).attr('href');
        }
    });

    var grid = $('#setting-list').flexigrid({
        url: Endold.cmdTo(9990),
        dataType: 'json',
        colModel: [
            {
                display: '功能',
                name: 'caption',
                width: 300,
                align: 'left'
            }, {
                display: '狀態',
                name: 'value', 
                width: 320,
                align: 'center',
                process: function(div, id) {
                    var data = $.parseJSON(div.innerHTML);
                    var $link = $('<a class="link-option" href="#" />');
                    switch (data.key) {
                        /* 簡訊通知, App通知 */
                        case 'GrantNoticeBySMS':
                        case 'GrantNoticeByApp':
                            data.value = Number(data.value);                            
                            $link
                                .html(data.value ? '啟用中' : '停用中')
                                .toggleClass('disabled', data.value === 0)
                                .bind('click', app.changeSettingStatus)
                                .data('row.data', {
                                    id: id,
                                    value: (data.value ? 0 : 1)
                                });
                            break;

                        /* 運費 */
                        case 'Fare':    
                            $link
                                .html(data.value)
                                .bind('click', app.changeSettingNumber)
                                .data('row.data', {
                                    id: id,
                                    value: Number(data.value)
                                });
                            break;

                        /* 會員購物金回饋 % */
                        case 'RewardPercent':
                            $link
                                .html(data.value + ' %')
                                .bind('click', app.changeSettingNumber)
                                .data('row.data', {
                                    id: id,
                                    value: Number(data.value)
                                });
                            break;
                        /* 銀行帳號 */
                        case 'BankAccount':
                            var url = Endold.linkTo(MODIFY_URL, {id: id})
                            $link
                                .html((data.value || 'none').replace('*', '-'))
                                .attr('href', url)
                                .bind('click', option.modify)
                                .data('row.data', data);
                            break;
                        case 'EmailNotice':
                            var url = Endold.linkTo(MODIFY_URL, {id: id});
                            var obj = $.parseJSON(data.value || '{}');
                            var label = obj.emails ? (
                                    obj.emails.split(';')[0] + '...'
                                ) : '未設定';

                            var disabled = obj.disabled ? true : false;
                            $link
                                .html(disabled ? '停用中' :  label)
                                .toggleClass('disabled', disabled)
                                .attr('href', url)
                                .bind('click', option.modify)
                                .data('row.data', data);
                            break;
                    }
                    $(div).html($link);

                    // var value = Number(div.innerHTML) > 0;
                    // $link.html(value ? '啟用中' : '停用中')
                    //     .addClass(value ? 'enabled' : 'disabled')
                    //     .data('row.data', {id: id, action: (value ? 0 : 1)})
                    //     .bind('click', app.changeStatus);
                    // $(div).html($link);
                }
            }
        ],
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '設定',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250

    });

    


    app.init();
})(top.Endold, top.OptionBar);