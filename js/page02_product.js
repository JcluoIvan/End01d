(function(Endold, OptionBar) {

    var _MODIFY_URL = '/page/page02/product_modify.php';
    var _YOUTUBE_EMBED_URL = 'https://www.youtube.com/embed/';
    var $search = $('#search-form');
    var app = {
        init: function() {
            $search = $('#search-form');
            app.bindEvents();
        },
        bindEvents: function() {
            $search.find('select').bind('change', app.reloadGrid);
        },
        changeSellingStatus: function(event) {
            var change_to = $(this).hasClass('selling') ? 0 : 1;
            var id = $(this).attr('data-id');
            Endold.post(222, {id: id, selling: change_to})
                .done(app.changeRequest);
            event && event.preventDefault();

        },
        changeMainStatus: function(event) {
            var change_to = $(this).hasClass('main') ? 0 : 1;
            var id = $(this).attr('data-id');
            Endold.post(223, {id: id, main: change_to})
                .done(app.changeRequest);
            event && event.preventDefault();
        },
        changeRequest: function(response) {
            if (! response.status) return alert(response.message);
            app.reloadGrid(false);
        },
        addGridFormData: function() {
            var data = $search.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        reloadGrid: function(reset_page) {
            option.cancel();
            
            /* 設定頁數為第一頁 */
            if (reset_page !== false)
                grid.flexOptions({newp: 1});
            grid.flexReload();
        }
    };


    var $modify = {
        form: null,
        update: null,
        video_url: null,
        video: null,
        images: null,
        remove: null,
        video_wrapper: null
    };
    var $video = {
        add: null,
        form: null,
        wrapper: null,
        iframe: null,
        no: null,
        url: null,
        grid: null
    };
    var modify = {
        video_rows: null,
        init: function() {
            $modify.form = $('#option-form');
            $modify.form.attr('action', Endold.cmdTo(221));

            $modify.update = $('#iframe-save');
            $modify.update.bind('load', modify.saveRequest);

            $modify.images = $modify.form.find('#images, #edm');

            $modify.remove = $modify.form.find('.remove-image');

            $video.wrapper = $('#video-wrapper');
            $video.form = $video.wrapper.find('form');
            $video.iframe = $video.wrapper.find('#youtube-iframe');
            $video.no = $video.form.find('input[name=video_no]');
            $video.url = $video.form.find('input#video-url');
            $video.add = $('#add-video')
                .data('video.url', '')
                .data('video.id', 0);

            modify.bindEvents();

            $video.grid = $('#video-list').flexigrid({
                url: Endold.cmdTo(225),
                dataType: 'json',
                colModel: [ 
                    {
                       display: '標題',
                       name: 'title', 
                       width: 150, 
                       align: 'center'
                    }, {
                       display: '影片網址',
                       name: 'no', 
                       width: 350, 
                       align: 'center', 
                       process: function(div, id) {
                            if (div.innerHTML && div.innerHTML !== '&nbsp;') {
                                div.innerHTML = _YOUTUBE_EMBED_URL + 
                                    modify.parseYoutubeVideoID(div.innerHTML);
                            }
                       }

                    }, {
                       display: '',
                       name: 'url', 
                       width: 100, 
                       align: 'center',
                       process: function(div, id) {
                            var $div = $(div).empty().html(' / ');
                            $('<a href="#">修改</a>')
                                .data('video.row', modify.video_rows[id])
                                .bind('click', modify.modifyVideo)
                                .prependTo($div);
                            $('<a href="#">刪除</a>')
                                .data('video.row', modify.video_rows[id])
                                .bind('click', modify.deleteVideo)
                                .appendTo($div);
                       }
                    }
                ],
                idProperty: 'id',
                usepager: true,
                title: '影片清單',
                useRp: true,
                rp: 10,
                width: '100%',
                height: 250,
                params: [
                    {name: 'pid', value: $modify.form.find('input[name=id]').val()}
                ],
                preProcess: function(request) {
                    modify.video_rows = {};
                    $.each(request.rows, function(i, row) {
                        modify.video_rows[row.id] = row;
                    });
                    return request;
                }
            });
            /* 等 modify 畫面展開後, 再執行 youtube 的影片載入 */
            // setTimeout(function() {
            //     $modify.video_url.trigger('change');
            // }, 300);
        },
        bindEvents: function() {
            $modify.remove.bind('click', modify.removeImage);
            $modify.images
                .on('click', 'img', modify.onclickImage)
                .on('click', '.remove-active-background', modify.onclickImage);

            $video.add.bind('click', modify.modifyVideo);
            $video.form.bind('submit', modify.updateVideo);
            $video.url.bind('change', modify.loadYoutubeVideo)
            $video.wrapper.bind('shown.bs.modal', modify.loadYoutubeVideo);
            $video.wrapper.bind('hide.bs.modal', modify.clearVideoModal);
        },
        parseYoutubeVideoID: function(url) {
            var matchs = [];
            if (url.match(/www.youtube.com\/embed/)) {
                matchs = url.match(/embed\/([\w-]+)/);
            } else if (url.match(/youtu.be/)) {
                matchs = url.match(/youtu.be\/([\w-]+)/);
            } else if(url.match(/http|https/)) {
                matchs = url.match(/v=([^&^#]+)/);
            } else {
                return $.trim(url);
            }
            return (matchs && matchs.length > 1) ?
                $.trim(matchs[1]):
                null;
        },
        loadYoutubeVideo: function() {
            var id = modify.parseYoutubeVideoID($video.url.val());
            var url = id ? _YOUTUBE_EMBED_URL + id : '';
            $video.no.val(id);
            $video.url.val(url);
            $video.iframe
                .attr('src', url);
        },
        clearVideoModal: function() {
            $video.iframe.removeAttr('src');
        },
        modifyVideo: function() {
            var row = $(this).data('video.row');
            $video.wrapper.modal('show')
                .find('input[name=video_id]').val(row.id).end()
                .find('input[name=video_title]').val(row.title).end();
            $video.url.val(row.no);

        },
        updateVideo: function(event) {
            event.preventDefault();
            if (! $video.iframe.attr('src')) {
                if (! confirm('影片網址解析失敗, 可能無法顯示影片, 確定儲存此設定？')) return;
            }
            var data = $(this).serialize();
            Endold.post(226, data)
                .done(modify.requestUpdateVideo);

        },
        deleteVideo: function(event) {
            event.preventDefault();
            if (! confirm('確定刪除此影片？')) return;
            Endold.post(227, {vid: $(this).data('video.row').id})
                .done(modify.requestDeleteVideo);

        },
        requestUpdateVideo: function(o) {
            if (! o.status) return alert(o.message);
            $video.wrapper.modal('hide');
            $video.grid.flexReload();
        },
        requestDeleteVideo: function(o) {
            if (! o.status) return alert(o.message);
            $video.grid.flexReload();
        },
        onclickImage: function() {
            var $this = $(this);
            var $item = $this.closest('.image-item');
            if ($item.attr('image-id') == 0) return;
            $item.toggleClass('remove-active');
        },
        removeImage: function() {

            var imgs = [];
            $modify.images.find('.remove-active').each(function() {
                var id = Number($(this).attr('image-id')) || 0;
                if (id > 0) {
                    imgs.push(id);
                }
            });

            if (imgs.length === 0) return alert('請選擇圖片');

            if (! confirm('確定刪除圖片？')) return;

            Endold.post(224, {images: imgs})
                  .done(modify.requestRemoveImage);
            event && event.preventDefault();
        },
        requestRemoveImage: function(response) {

            $modify.images.find('.remove-active').each(function() {
                var $this = $(this);
                var id = Number($this.attr('id'));

                /* 檢查選擇的圖片是否刪除成功 */
                if ($.inArray(id, response.fails) < 0) {
                    $this.removeClass('remove-active')
                        .attr('image-id', 0);
                    $this.find('img').attr('src', '');
                }

            });

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
                app.reloadGrid();
            } else {
                if (! response.status && typeof response.validates === 'object') {
                    option.validates(response.validates);
                } else {
                    alert(response.message);
                }

            }
        }
    }
    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 620,
        onModify: function() {
            var pid = $(this).attr('pid') || 0;
            return Endold.linkTo(_MODIFY_URL, {id: pid});
        },
        onSave: modify.onsave,
        onShow: modify.init,
        insert: {},
        save: {},
        cancel: {}
    })


    var grid = $('#product-list').flexigrid({
        url: Endold.cmdTo(220),
        dataType: 'json',
        colModel: [ 
            {
               display: '產品序號',
               name: 'no', 
               width: 100, 
               align: 'center'
            }, {
               display: '產品名稱',
               name: 'name', 
               width: 200, 
               align: 'center'
            }, {
               display: '產品類別',
               name: 'type', 
               width: 140, 
               align: 'center'
            }, {
               display: '售價',
               name: 'price', 
               width: 100, 
               align: 'center'
            }, {
               display: '會員價',
               name: 'member_price', 
               width: 100, 
               align: 'center'
            }, {
               display: '販售方式',
               name: 'sell_type', 
               width: 80, 
               align: 'center',
               process: function(div, id) {
                    div.innerHTML = (Number(div.innerHTML) || 0)
                        ? '購物金 <span class="glyphicon glyphicon-asterisk"></span>'
                        : '現金 <span class="glyphicon glyphicon-usd"></span>'
               }
            }, {
               display: '最後編輯',
               name: 'editor', 
               width: 100, 
               align: 'center'
            }, {
               display: '上架',
               name: 'selling', 
               width: 60, 
               align: 'center', 
               process: function(div, id) {
                    var selling = Number(div.innerHTML) !== 0;
                    var className = selling && 'selling' || 'unselling';
                    var label = selling && '上架' || '下架';
                    var $div = $(div).html('');

                    $('<a href="#"/>')
                        .html(label)
                        .attr('data-id', id)
                        .addClass(className)
                        .bind('click', app.changeSellingStatus)
                        .appendTo($div);
                }
            }, {
               display: '主力產品',
               name: 'main', 
               width: 100, 
               align: 'center', 
               process: function(div, id) {
                    var main = Number(div.innerHTML) !== 0;
                    var className = main && 'main' || 'not-main';
                    var label = main && '主力' || '非主力';
                    var $div = $(div).html('');

                    $('<a href="#"/>')
                        .html(label)
                        .attr('data-id', id)
                        .addClass(className)
                        .bind('click', app.changeMainStatus)
                        .appendTo($div);
                }
            }, {
               display: '排序',
               name: 'sort', 
               width: 60, 
               align: 'center'
            }, {
                display: '操作',
                name: 'options', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    // var url = Endold.linkTo('modify.php', {id: id});
                    var $div = $(div).addClass('options').html('');

                    $('<a href="#">修改</a>')
                        .attr('pid', id)
                        .bind('click', option.modify)
                        .appendTo($div);

                    // return div;
                }
            }
        ],
        perProcess: function() {
            console.log(arguments);
        },
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250,
        onSubmit: app.addGridFormData

    });

    window.ProductApp = app;
    window.ProductGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);

