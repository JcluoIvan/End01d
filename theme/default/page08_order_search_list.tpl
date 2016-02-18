<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}

        <style>
            #modify-iframe {
                width: 100%;
                border:1px solid #aaa;
                height: 0;
                opacity: 0;
                transition: .25s;
            }
            #modify-iframe.show {
                opacity: 1;
                height: 500px;
            }
            #product-list div > a.selling {color: blue; }
            #product-list div > a.unselling {color: red; }
            #product-list div.options > a {
                margin: 0 2px;
            }
        </style>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">取貨記錄</li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>展示中心專區 - 取貨記錄</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <label for="exampleInputName2">搜尋</label>
                    <select id="search" name="search" class="form-control">
                        <option value="phone">會員手機</option>
                        <option value="oid">訂單編號</option>
                        <option value="mid">會員編號</option>
                    </select>
                    <input name="rno" id="rno" type="text" class="form-control" placeholder="請輸入編號" />
                    <div class="form-group">
                        <select id="year" class="form-control" name="year">
                          {{foreach key=ky item=vy from=$year}}
                          <option value="{{$vy}}">{{$vy}}</option>
                          {{/foreach}}
                        </select>年
                        <select id="month" class="form-control" name="month">
                          {{foreach key=km item=vm from=$month}}
                          <option value="{{$vm}}" {{if $right_now_month==$vm}} selected {{/if}}>{{$vm}}</option>
                          {{/foreach}}
                        </select>月
                    </div>
                    <button type="submit" class="btn btn-default">查詢</button>
                </form>
            </div>
                        <div id="option-bar" class="pull-right"></div>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>

        <div id="demo-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" >
                    <input type="hidden" id="orderID" name="orderID"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">輸入郵寄日期</h4>
                    </div>
                    <div class="modal-body">
                        <p>郵寄日期</p>
                        <div class="input-group col-xs-4">
                            <input class="form-control" name="date3" type="text" id="date3" onpropertychange="zzday();">
                            <a id="date3.onclick" class="input-group-addon" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                            <a id="date3.clear" class="input-group-addon btn bt-default clear-date" clear-target="input#date3" href="#">
                                <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                            </a> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">存檔</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="/js/page08_order_search_list.js?{{$smarty.now}}"></script>


</body>
</html>