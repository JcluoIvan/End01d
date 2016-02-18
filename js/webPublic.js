var sit = 0, hig = 0;
var rbset = new Array();
var aryData = new Array();

function wopPage(page){
	window.open(page);
}
function chgPage(page){
	document.getElementById("ifcon").src = page;
}
function getSetIntSit(){
	return sit;
}
function proSetIntSit(n){
	sit = Number(n);
}
function proBaseData_init(){
	var i,j,k,x,aryJ;
	aryJ = new Array();
	aryJ['st'] = sit;
	ary = JQAjaxSynsSend('201',aryJ);

	proUserArray_init(ary['U']);
	proBaseRatio_init(ary['R']);
	aryData['b'] = new Array();
	//aryData['b']['sn_lu'] = 6;
  aryData['b']['sn_lu'] = ary['P']['snl'];
	aryData['b']['csn_lu'] = ary['P']['bmn'];
	aryData['b']['bsp_sn'] = ary['P']['bss'];
  aryData['b']['mbd_en'] = ary['P']['embd'];

	aryData['m'] = new Array();
	aryData['m']['m_chg'] = ary['M']['MT'];
	aryData['m']['m_str'] = new Array();
	for(i in ary['M']['MS']){
		aryData['m']['m_str'].push(ary['M']['MS'][i]);
	}
}
function proUserArray_init(obj){
	aryData['u'] = new Array();
	aryData['u']['ui'] = obj.id;
	aryData['u']['un'] = obj.name;
	aryData['u']['us'] = obj.site;
	aryData['u']['up'] = obj.point;
}
function proBaseRatio_init(obj){
	var i, j, k, idx;
	for(i in obj){
		if(i=='err'){ continue; }

		i = Number(i);
		if(typeof(rbset[i])!='object'){ rbset[i] = new Array(); }
		for(j in obj[i]){

			j = Number(j);
			if(typeof(rbset[i][j])!='object'){ rbset[i][j] = new Array(); }
			for(k in obj[i][j]){

				if(k=='R'){ rbset[i][j]['R'] = obj[i][j][k]; continue; }
				if(k!='R'){
					k = Number(k);
					for(idx in obj[i][j][k]){
						if(idx=='R'){
							if(typeof(rbset[i][j][k])!='object'){ rbset[i][j][k] = new Array(); }
							rbset[i][j][k]['R'] = obj[i][j][k]['R'];
							rbset[i][j][k]['Name'] = obj[i][j][k]['pname'];
						}
					}
				}
			}
		}
	}
}
function getBaseRatio(p){
	if(typeof(rbset[p])!='object'){ proBaseData_init(); }
	return rbset[p];
}
function chkCallBack_STO(async,callback){
	var i,j,k,x,aryTmp;
	aryTmp = new Array();

	aryTmp["g"] = 0;
	if(typeof(aryData['g'])!='undefined' && typeof(aryData['g']['gi'])!='undefined'){
		aryTmp["g"] = aryData['g']['gi'];
	}
	aryTmp["p"] = 0;
	if(typeof(aryData['u'])!='undefined' && typeof(aryData['u']['up'])!='undefined'){
		aryTmp["p"] = aryData['u']['up'];
	}
	aryTmp["b"] = 0;
	if(typeof(aryData['b'])!='undefined' && typeof(aryData['b']['bn'])!='undefined'){
		aryTmp["b"] = aryData['b']['bn'];
	}
	aryTmp["o"] = 0;
	if(typeof(aryData['g'])!='undefined' && typeof(aryData['g']['os'])!='undefined'){
		aryTmp["o"] = aryData['g']['os'];
	}
  aryTmp["m"] = 0;
  if(typeof(aryData['m'])!='undefined' &&  typeof(aryData['m']['m_chg'])!='undefined'){
  	aryTmp["m"] = aryData['m']['m_chg'];
  }
	aryTmp["st"] = sit;

	if(async){ return JQAjaxSynsSend('203',aryTmp); }
	if(!async){ JQAjaxCbackSend('203',aryTmp,callback); }
}
function JQAjaxSynsSend(code, cmds){
	var aryRes,aryData,strJSON,resJSON;
	aryData = new Array();
	aryData['cmd'] = code;
	aryData['side'] = 1;
	aryData['parame'] = cmds;
	strJSON = proAryToJSON(aryData);
	$.ajax({
		url: '/pub/gateway.php?'+code,
		type: 'POST',
		data: { cmd: encodeURI(strJSON) },
		async: false,
		cache: false,
		success: function(response){ resJSON = response; },
		error: function(xhr) { alert("網路連線發生錯誤!!"); }
	});
	try{ aryRes = $.parseJSON(resJSON);	}catch(e){ aryRes = ''; }
	return aryRes;
}
function JQAjaxStand(code, cmds){
	var aryRes,aryData,strJSON,resJSON;
	aryData = new Array();
	aryData['cmd'] = code;
	aryData['side'] = 0;
	aryData['parame'] = cmds;
	strJSON = proAryToJSON(aryData);
	return strJSON;
}
function JQAjaxCbackSend(code, cmds, callback){
	var aryRes,ajaxResp,aryData,strJSON;
	aryData = new Array();
	aryData['cmd'] = code;
	aryData['side'] = 1;
	aryData['parame'] = cmds;
	strJSON = proAryToJSON(aryData);
	$.ajax({
		url: '/pub/gateway.php?'+code,
		type: 'POST',
		cache: false,
		data: { cmd: encodeURI(strJSON) },
           success: function(response){ try{eval(callback+'('+response+');'); }catch(e){} },
		failure: function(response){ alert("資料更新錯誤!!"); },
		error: function(xhr) { alert("網路連線發生錯誤!!"); }
	});
}
function callb(abc){
    alert(111);
}
function proLogout(){
  JQAjaxSynsSend('993','');
	JQAjaxSynsSend('999','');
	this.location.href = '/';
}
function proErrLogin(){
	JQAjaxSynsSend('999','');
	this.location.href = '/page/ref_loginerr.php';
}
function proOffline(){
  JQAjaxSynsSend('993','');
}
function proAryToJSON(ary) {
	var parts = [];
	var is_list = (Object.prototype.toString.apply(ary) === '[object Array]');

	for(var key in ary) {
		var value = ary[key];
		if(typeof(value) == "object") { //Custom handling for arrays

				if(is_list){
					/* :RECURSION: */
					if(typeof(key)!='number'){
						parts.push('"'+key+'":'+proAryToJSON(value));
					}else{
						parts.push('['+proAryToJSON(value)+']');
					}
				}else{
					/* :RECURSION: */
					parts[key] = proAryToJSON(value);
				}

		}else {
			var str = "";

			var ktype = typeof(key);
			if(ktype!='number'){
				str = '"' + key + '":';
			}

			var vtype = typeof(value);
			switch(vtype){
				case 'number': 	str += value; 	break;
				case 'boolean': str += value.toString(); 	break;
				default: str += '"'+value+'"'; break;
			}

			parts.push(str);
		}
	}
	var json = parts.join(",");

	//Return numerical JSON
	//if(is_list) return '[' + json + ']';
	//Return associative JSON
	return '{' + json + '}';
}
function proChangIfmHeight(h){
	var domTab = $('table');
	$(domTab[1]).height(hig);
	if(Number(h) > Number(hig)){ $(domTab[1]).height(Number(h)); }
}