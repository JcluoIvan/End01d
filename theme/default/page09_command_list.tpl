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
						<li class="active">業務獎金查詢</li>
				</ol>
				<h3 class="title-bar">
						<!-- <div id="option-bar" class="pull-right"></div> -->
						<label>專業經理人專區 - 業務獎金查詢</label>
				</h3>
				<div class="col-xs-8">
	                <fieldset>
	                    <legend>
	                    	銀行代號  {{$bank_account}}
	                    	<Br>
	                    	銀行帳號  {{$bank_code}}
	                    </legend>
	                </fieldset>
            	</div>
				<div style="display:inline-block; width: 100%">
						<div class="pull-left" >
								<form id="command-search" class="form-inline">
										<label for="exampleInputName2">搜尋</label>
										<select id="memsearch" name="memsearch" class="form-control">
												<option value="id">展示中心編號</option>
												<option value="name">展示中心名稱</option>
										</select>
										<input name="no" id="no" type="text" class="form-control" placeholder="請輸入編號 or 名稱" />
										<div class="form-group">
				                        <select id="year" class="form-control" name="year">
				                          {{foreach key=ky item=vy from=$year}}
				                          <option value="{{$vy}}">{{$vy}}</option>
				                          {{/foreach}}
				                        </select>年
				                        <select id="month" class="form-control" name="month">
				                          {{foreach key=km item=vm from=$month}}
				                          <option value="{{$vm}}" {{if $right_now_month==$vm}}selected{{/if}}>{{$vm}}</option>
				                          {{/foreach}}
				                        </select>月
                    					</div>
										<button type="submit" class="btn btn-default">查詢</button>
								</form>
						</div>
						<div id="option-bar" class="pull-right"></div>
				</div>
				<div id="option-main"></div>
				<!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
				
				<div id="order-list"></div>
		</div>
		<script type="text/javascript" src="/js/page09_main.js?{{$smarty.now}}"></script>


</body>
</html>