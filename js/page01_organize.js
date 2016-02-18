(function(Endold, OptionBar) {
    var $lid = null;
    var $pid = null;
    var $url = null;
    var $formSearch = null;
    var $searchBtn = null;


    var app = {
        $lid: $('#pid').val(),

        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');
            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
        },
        stopEvent: function(event) {
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
        disabled: function() {
            var $this = $(this);
            var $id = $this.data('id');
            var $is_disabled = $this.data('is_disabled');
            var text = $is_disabled === 1 ? '確認啟用?' : '確認停用?';

            if (!confirm(text))
                return false;

            Endold.post(109, {id: $id, is_disabled: $is_disabled})
                .done(app.gridReload);

            event && event.preventDefault();
        },
        changePublicState: function() {
            var $this = $(this);
            var id = $this.data('id');
            var is_public = $this.data('is_public');

            Endold.post(110, {id: id, is_public: is_public ? 0 : 1})
                .done(app.gridReload);
            event && event.preventDefault();
        },
        changeLockedState: function() {
            var $this = $(this);
            var id = $this.data('id');
            var is_locked = $this.data('is_locked');
            Endold.post(150, {id: id, is_locked: is_locked ? 0 : 1})
                .done(app.gridReload);
            event && event.preventDefault();
        }
    };

    var $modify = {
        form: null,
        update: null,
        selectCountry: null,
        selectCity: null,
        inputMap: null,
        storeMap: null,
        map: null,
        queryAddress: null,
    };

    var modify = {
        init: function() {
            $modify.form = $('#option-form');
            $modify.update = $('#iframe-save');
            $modify.selectCountry = $modify.form.find('#country');
            $modify.selectCity = $modify.form.find('#city');
            $modify.inputMap = $modify.form.find('#store-map');
            $modify.storeMap = $modify.form.find('input[name=store_map]');
            $modify.map = $modify.form.find('#map-panel');
            $modify.queryAddress = $modify.form.find('#query-address');
            $modify.copy_address = $modify.form.find('#copy-address');

            $modify.form.attr('action', Endold.cmdTo(103));

            modify.onLoadModifyInit();
            GMap.view($modify.map[0]);


            var latlng = $modify.storeMap.val().split(',');
            if (latlng.length === 2) {
                GMap.addMarker(latlng[0], latlng[1]);
            }
            // GMap.address('台中市東區東英路286號');

            $('#date').length &&
                new Calendar({
                    inputField: "date",
                    dateFormat: "%Y-%m-%d",
                    trigger: "date.onclick",
                    bottomBar: true,
                    weekNumbers: true,
                    onSelect: function() {this.hide();}
                });

            var pid = Number($modify.form.find('input[name=pid]').val()) || 0;

            modify.bindEvents();
        },
        bindEvents: function() {
            $modify.update.bind('load', modify.saveRequest);
            $modify.inputMap.bind('change', modify.onChangeMap);
            $modify.form.find('.nav-tabs li').bind('shown.bs.tab', modify.onChangeTabs);

            $modify.copy_address.bind('click', modify.onClickCopyAddress);
            $modify.map.bind('map.marker.change', modify.onChangeMarker);
            $modify.queryAddress.bind('click', modify.handlerQueryAddress);
            $modify.inputMap.bind('keydown', modify.onKeyDownInputMap);

        },
        onLoadModifyInit: function() {
            var countryDef = parseInt($('#country_def').val()) || null;
            var country = Endold.Postal.data;
            var options = Endold.Postal.options($modify.selectCountry, country, countryDef);
            modify.onChangeModifyCity();
            $modify.selectCountry.bind('change', modify.onChangeModifyCity);
        },
        onChangeModifyCity: function() {
            var cityDef = parseInt($('#city_def').val()) || null;
            var $parent = $modify.selectCountry.find('option:selected');
            var sn = $parent.attr('sn');
            var city = Endold.Postal.data[sn]['children'];
            $modify.selectCity.html('');
            var options = Endold.Postal.options($modify.selectCity, city, cityDef);
        },
        onClickCopyAddress: function() {
            var address = ([
                $modify.selectCountry.find('option:selected').html(),
                $modify.selectCity.find('option:selected').html(),
                $modify.form.find('input[name=address]').val()
            ]).join('');
            GMap.address(address);

        },
        onChangeTabs: function() {
            var tabName = $(this).find('a').attr('href');
            switch (tabName) {
                case '#store':
                    GMap.resize();
                    GMap.toMarker(14);
                    break;
                case '#cursor':
                    break;
            }
        },
        onChangeMarker: function(event, marker, address) {
            $modify.inputMap.val(address);
            $modify.storeMap.val(([
                marker.getPosition().lat(),
                marker.getPosition().lng()
            ]).join(','));

        },
        handlerQueryAddress: function() {
            var address = $modify.inputMap.val();
            if (address) {
                GMap.address(address);
            }

        },
        onKeyDownInputMap: function(event) {
            if (event.keyCode === 13) {
                modify.handlerQueryAddress();
                return false;
            }
        },
        onsave: function() {
            $modify.form.trigger('submit');
            return false;
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
                app.gridReload();
            } else {
                if (! response.status && typeof response.validates === 'object') {
                    option.validates(response.validates);
                } else {
                    alert(response.message);
                }

            }
        }

    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 490,
        onModify: function() {
            var id = $(this).attr('id') || 0;
            $pid = $('#pid').val();
            return Endold.linkTo(
                '/page/page01/organize_modify.php', 
                {
                    pid: $pid, 
                    id: id
                }
            );
        },
        onSaveRequest: function(r) {
            // console.log(r);
            OrganizeApp.gridReload();
        },
        onSave: modify.onsave,
        onShow: modify.init,
        insert: {
        },
        save: {
        },
        cancel: {
        }

    });


    var grid_col = [{
           display: '編號',
           name: 'no', 
           width: 80, 
           align: 'center'
        }, {
           display: '名稱',
           name: 'name', 
           width: 100, 
           align: 'center'
        }, {
           display: '下層數',
           name: 'layers', 
           width: 60,
           align: 'center',
           process: function(div, id) {
                $url = $('#url').val();
                var layers = div.innerHTML;
                var url = Endold.linkTo(
                    $url, {
                        pid: id,
                        lid: OrganizeApp.$lid
                    }
                );
                var $a = $('<a/>')
                    .html(layers)
                    .attr({'href': url});
                $(div).html($a);
          }
        }, {
           display: '手機',
           name: 'phone', 
           width: 100, 
           align: 'center'
        }, {
           display: '銀行代號',
           name: 'bank_code', 
           width: 100, 
           align: 'center'
        }, {
           display: '銀行帳號',
           name: 'bank_account', 
           width: 140, 
           align: 'center'
        }, {
            display: '商店瀏覽鎖定(下層會員)',
            name: 'is_locked',
            width: 140,
            align: 'center',
            process: function(div, id) {
                var $div = $(div);
                var is_locked = parseInt($div.html(), 10) ? 1 : 0;
                var $link = $('<a href="#"/>')
                    .html(is_locked ? '開放' : '鎖定')
                    .css('color', is_locked ? null : 'red')
                    .data({id: id, is_locked: is_locked})
                    .bind('click', app.changeLockedState);

                $div.empty()
                    .append($link);

            }
        }, {
            display: '店家公開狀態',
            name: 'is_public',
            width: 100,
            align: 'center',
            process: function(div, id) {
                var $div = $(div);
                var is_public = parseInt($div.html(), 10) ? 1 : 0;
                var $link = $('<a href="#"/>')
                    .html(is_public ? '公開' : '非公開')
                    .css('color', is_public ? null : 'red')
                    .data({id: id, is_public: is_public})
                    .bind('click', app.changePublicState);

                $div.empty()
                    .append($link);

            }
        }, {
            display: '啟用狀態',
            name: 'is_disabled',
            width: 100,
            align: 'center',
            process: function(div, id) {
                var $div = $(div);
                var is_disabled = parseInt($div.html());
                var text = is_disabled === 1 ? '停用' : '啟用';
                var color = is_disabled === 1 ? 'red' : null;

                var $a = $('<a>')
                    .attr({href: '#'})
                    .html(text)
                    .css('color', color)
                    .data({id: id, is_disabled: is_disabled})
                    .bind('click', app.disabled);

                $div.html('')
                    .html($a);
            }
        }, {
            display: ' ',
            name: 'options', 
            width: 100, 
            align: 'center',
            process: function(div, id) {
                var $a = $('<a>修改</a>')
                    .attr({href: '#', id: id})
                    .bind('click', option.modify);

                $(div).html($a);
            }
        },{
           display: '邀請碼',
           name: 'qrcodeId', 
           width: 120, 
           align: 'center', 
           process: function (div) {
                var pid = parseInt($('#pid').val());
                var $div = $(div);
                if ($div.text() === 'false' || !pid)
                    $(div).text('-');
           }
        },{
           display: '',
           name: 'qrcode', 
           width: 120, 
           align: 'center', 
           process: function (div) {
                var pid = parseInt($('#pid').val());
                var url = $(div).text();
                var $a = '-';
                
                if (url !== 'false') {
                    $a = $('<a>顯示QRcode</a>')
                        .attr({
                            href: url,
                            target: '_blank'
                        });
                }
                if (!pid)
                    $(div).hide();

                $(div).html($a);
           }
        }
    ];
    if (! app.$lid) {
        grid_col = $.grep(grid_col, function(col) {
            return col.name !== 'is_public' && col.name !== 'is_locked';
        });
    }


    var grid = $('#organize-list').flexigrid({
        url: Endold.cmdTo(102),
        dataType: 'json',
        colModel: grid_col,
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
        // onSubmit: addFormData,
        height: 300,
        onSubmit: app.addGridFormData

    });


    app.init();
    window.OrganizeApp = app;
    window.OrganizeGrid = grid;
    window.OrganizeOption = option;
})(top.Endold, top.OptionBar);

var initMap = function() {};
