(function(){var a=0,b=[{name:"doksoft_advanced_blocks",pref:"doksoft_advanced_blocks_",idpref:"doksoft-advanced-blocks-X-"},{name:"doksoft_bootstrap_advanced_blocks",pref:"doksoft_bootstrap_advanced_blocks_",idpref:"doksoft-bootstrap-advanced-blocks-X-",classes:"(span[0-9]+|offset[0-9]+|col-xs-[0-9]+|col-md-[0-9]+|col-sm-[0-9]+|col-lg-[0-9]+|col-xs-offset-[0-9]+|col-md-offset-[0-9]+|col-sm-offset-[0-9]+|col-lg-offset-[0-9]+|row-fluid|row)",eye:/visible-pring|visible-lg|visible-md|visible-sm|visible-xs|hidden-print|hidden-lg|hidden-md|hidden-sm|hidden-xs/i,sizesReg:/col-(md|lg|sm|xs)/i,offsetReg:/col-(lg|md|sm)-offset/i,},{name:"doksoft_foundation_advanced_blocks",pref:"doksoft_foundation_advanced_blocks_",idpref:"doksoft-foundation-advanced-blocks-X-",classes:"(large-[0-9]+|medium-[0-9]+|small-[0-9]+|large-offset-[0-9]+|medium-offset-[0-9]+|small-offset-[0-9]+|row)",eye:/show-for-small-only|show-for-medium-up|show-for-medium-only|show-for-large-up|show-for-large-only|show-for-xlarge-up|show-for-xlarge-only|show-for-xxlarge-up/i,sizesReg:/(large|medium|small)/i,offsetReg:/(large|medium|small)-offset/i,}];CKEDITOR.plugins.add(b[a].name,{icon:"icons/"+b[a].name+""+(CKEDITOR.version.charAt(0)=="4"?"_4":"")+".png",onLoad:function(c){},init:function(c){if(false){c.ui.addButton("doksoft_advanced_blocks",{command:"doksoft_advanced_blocks",icon:this.path+"icons/doksoft_advanced_blocks.png"});}var H=["add-mini","add-mini-hover","delete-mini-hover","delete-mini","menu-div","menu-div-hover","menu-span","menu-span-hover","menu-p","menu-p-hover","menu-code","menu-code-hover","menu-p","menu-p-hover","menu-tag","menu-tag-hover","menu-table","menu-table-hover"];c._boxold=false,c._parentold=false;var l=["top","right","bottom","left"];if(c.config[b[a].pref+"margin"]){for(var K in l){if(!c.config[b[a].pref+"margin"][K]){c.config[b[a].pref+"margin"][K]=0;}if(c.config[b[a].pref+"margin_"+l[K]]){c.config[b[a].pref+"margin"][K]=CKEDITOR.config[b[a].pref+"margin_"+l[K]];}}}for(var K in H){(new Image).src=CKEDITOR.basePath+"plugins/"+b[a].name+"/images/"+H[K]+".png";}var M=null,I=function(r){var S=c.document.$;M=S.createElement("style");S.head.appendChild(M);M.innerHTML=r;};var q=".%pref%show p,.%pref%show div,.%pref%show span{min-width:%min-width%;min-height:%min-height%;";if(c.config[b[a].pref+"margin"]){q+="margin:"+c.config[b[a].pref+"margin"][0]+"px "+c.config[b[a].pref+"margin"][1]+"px "+c.config[b[a].pref+"margin"][2]+"px "+c.config[b[a].pref+"margin"][3]+"px;";}q+="}";var A=function(r){var T=c.document.$,S=T.createElement("link");S.href=r;S.type="text/css";S.rel="stylesheet";T.head.appendChild(S);};c.on("contentDom",function(){A(CKEDITOR.basePath+"plugins/"+b[a].name+"/style.css");I(q.replace(/%pref%/g,b[a].pref).replace(/%min-width%/g,parseInt(c.config[b[a].pref+"min_div_width"])?parseInt(c.config[b[a].pref+"min_div_width"])+"px":"inherit").replace(/%min-height%/g,parseInt(c.config[b[a].pref+"min_div_height"])?parseInt(c.config[b[a].pref+"min_div_width"])+"px":"inherit"));});var C,G=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,F;function P(){if(c.readOnly){return;}if(C){return;}C=setTimeout(function(){C=0;c.fire("doksoft_change");},c.config.minimumChangeMilliseconds||300);}c.on("destroy",function(){if(C){clearTimeout(C);}C=null;});c.on("saveSnapshot",function(r){if(!r.data||!r.data.contentOnly){P();}});var Q=c.getCommand("undo");Q&&Q.on("afterUndo",P);var n=c.getCommand("redo");n&&n.on("afterRedo",P);c.on("afterCommandExec",function(r){if(r.data.name=="source"){return;}if(r.data.command.canUndo!==false){P();}});if(G){F=new G(function(r){P();});if(window.console&&window.console.log){console.log("Detecting changes using MutationObservers");}}c.on("contentDom",function(){if(F){var r=setInterval(function(){if(typeof c.document==="object"){F.observe(c.document.getBody().$,{attributes:true,childList:true,characterData:true});clearInterval(r);}},100);}c.document.on("keydown",function(T){if(T.data.$.ctrlKey||T.data.$.metaKey){return;}var S=T.data.$.keyCode;if(S==8||S==13||S==32||(S>=46&&S<=90)||(S>=96&&S<=111)||(S>=186&&S<=222)||S==229){P();}});c.document.on("drop",P);c.document.getBody().on("drop",P);});c.on("mode",function(S){if(c.mode!="source"){return;}var r=(c.textarea||c._.editable);r.on("keydown",function(T){if(!T.data.$.ctrlKey&&!T.data.$.metaKey){P();}});r.on("drop",P);r.on("input",P);if(CKEDITOR.env.ie){r.on("cut",P);r.on("paste",P);}});var z=function(U,ab,aa){var X=U.getBoundingClientRect();var Y=ab.body;var S=ab.documentElement;var r=aa.pageYOffset||S.scrollTop||Y.scrollTop;var V=aa.pageXOffset||S.scrollLeft||Y.scrollLeft;var W=S.clientTop||Y.clientTop||0;var Z=S.clientLeft||Y.clientLeft||0;var ac=X.top+r-W;var T=X.left+V-Z+X.width;return{top:Math.round(ac),left:Math.round(T)};};var d=function(U,V){var S=new RegExp(U,"ig");var r=V.match(S);matchArray=new Array();for(var T in r){nonGlobalRegex=new RegExp(U);nonGlobalMatch=r[T].match(nonGlobalRegex);matchArray.push(nonGlobalMatch[1]);}return matchArray;
};var D=function(r){};var h=["div","span","p","tag","code","table"],f=function(r,U,V,T,S){T.setAttribute("active",parseInt(V));T.style.left=T.style.right=T.style.top=T.style.bottom="auto";switch(parseInt(V)){case 0:if(U.left>=T.offsetWidth){T.style.left=(-T.offsetWidth-1)+"px";}else{T.style.left=(-r.offsetWidth)+"px";}break;case 1:T.style.left="0px";if(U.left+r.offsetWidth+T.offsetWidth<c.document.$.body.offsetWidth){T.style.left="0px";}else{T.style.left=(-r.offsetWidth+T.offsetWidth)+"px";}break;case 2:if(U.left-T.offsetWidth>0){T.style.right="0px";}else{T.style.right=(r.offsetWidth-T.offsetWidth)+"px";}break;case 3:if(U.left+T.offsetWidth<c.document.$.body.offsetWidth){T.style.right=(-T.offsetWidth-1)+"px";}else{T.style.right=(-r.offsetWidth)+"px";}break;}switch(parseInt(V)){case 1:case 0:T.style.top=(r.offsetHeight+1)+"px";T.style.marginBottom="0px";break;case 3:case 2:T.style.bottom="1px";T.style.marginBottom="-"+T.offsetHeight+"px";break;}},R=function(S,r){switch(true){case !!~this.className.search(/plus[0-3]{1}/):f(this,z(this,c.document.$,c.document.getWindow()),this.className.match(/plus([0-3]{1})/)[1],S,r);break;case !!~this.className.indexOf("plus4"):c.fire(b[a].pref+"delete",{box:S,parent:r});break;}},i=function(T,S,r){c.fire("saveSnapshot");switch(parseInt(S.getAttribute("active"))){case 0:r.parentNode.insertBefore(T,r);break;case 1:r.insertBefore(T,r.firstChild);break;case 2:r.appendChild(T);break;case 3:r.parentNode.insertBefore(T,r.nextSibling);break;}c.fire("doksoft_change_selective");S.removeAttribute("active");},J=function(T,S){var U=c.document.$,r="div",V=null;switch(true){case !!~this.className.search(/item_(div|p|span)/):V=U.createElement(r=this.className.match(/item_(div|p|span)/)[1]);V.innerHTML=r;i(V,T,S);break;case !!~this.className.search(/item_(tag)/):c._boxold=T;c._parentold=S;c.openDialog(b[a].pref+"insert_tag");break;case !!~this.className.search(/item_(code)/):c._boxold=T;c._parentold=S;c.openDialog(b[a].pref+"insert_code");break;case !!~this.className.search(/item_(table)/):c._boxold=T;c._parentold=S;c.openDialog(b[a].pref+"insert_table");break;}},m=function(S){var X=c.document.$,W=[X.createElement("a"),X.createElement("a"),X.createElement("a"),X.createElement("a"),X.createElement("a")];var V=X.createElement("a"),U=null;V.setAttribute("contenteditable",false);V.className=b[a].pref+"temper_block_menu";for(var T in h){U=X.createElement("a");U.setAttribute("contenteditable",false);U.className=b[a].pref+"temper_block_menu_item "+b[a].pref+"temper_block_menu_item_"+h[T];U.onmousedown=function(r){var Y=r||window.event;J.call(this,V,S);Y.preventDefault();Y.stopPropagation();};V.appendChild(U);}S.appendChild(V);for(var T in W){W[T].className=b[a].pref+"temper_block_plus "+b[a].pref+"temper_block_plus"+T+" "+b[a].pref+name;W[T].setAttribute("contenteditable",false);W[T].addEventListener("mousedown",function(r){var Y=r||window.event;R.call(this,V,S);Y.preventDefault();Y.stopPropagation();},false);S.appendChild(W[T]);}};var k=1,u=function(){return b[a].idpref+k++;};var p=function(aa,Y){var X=c.document.$,V=X.createElement("a");V.className=b[a].pref+"temper_place";V.setAttribute("contenteditable",false);Y.appendChild(V);switch(a){case 0:L(aa,V);break;case 1:case 2:var S=d(b[a].classes,Y.className);var T=c.config[b[a].pref+"multiline_titles"]?"clearex":"delimer";if(b[a].eye.test(Y.className)){L("eye-"+aa,V);}if(S&&S.length){var W={},Z="",r="";for(var U in S){r=S[U].toLowerCase();if(Z=b[a].sizesReg.exec(r)){if(!W[Z[0]]){W[Z[0]]=[];}if(!~W[Z[0]].indexOf(r)){W[Z[0]].push(r);}}else{W[r]=[r];}}for(Z in W){W[Z].sort();for(var U in W[Z]){if(W[Z][U].match(b[a].offsetReg)&&W[Z].length==1&&c.config[b[a].pref+"multiline_titles"]){L(W[Z][U],V,true);}else{L(W[Z][U],V);}}L(T,V);}}else{L("delimer",V);L(aa,V);}break;}L("clearex",V);return V;};var L=function(r,T,V){var U=c.document.$,S=U.createElement("i");S.className=b[a].pref+"temper_block "+b[a].pref+r.replace(/[0-9]+/g,"x")+" "+b[a].pref+r;S.setAttribute("title",r);S.setAttribute("contenteditable",false);T.appendChild(S);if(V){S.style.marginLeft=(parseInt(S.offsetWidth)+3)+"px";}};var t=0;var e=function(T){var S=T.data.$.target||T.data.$.srcElement;bane=S.tagName?S.tagName.toLowerCase():"",_off=0,off=0;if(bane=="i"&&~S.className.indexOf(b[a].pref+"temper_block")){var r=S.parentNode.parentNode;O(r);T.data.$.stopPropagation();T.data.$.preventDefault();}};var s=true,g=function(X){if(!s||c.mode=="source"||!~c.document.$.body.className.indexOf(b[a].pref+"show")){return;}s=false;var W=0,T=0,U=0,Z=c.document.$,V=c.document.getWindow(),Y=[],S=["p","div","span"];(function(ac,ad){if(X!==true&&~ac.className.indexOf(b[a].pref+"temper")){ac.parentNode.removeChild(ac);return;}var r=ac.tagName.toLowerCase(),aa=(r=="div"||r=="span"||r=="p"||r=="td")?z(ac,Z,V):ad;if(ac.childNodes&&(X!==true||!~ac.className.indexOf(b[a].pref+"temper_block"))){for(var ab=0;ac.childNodes[ab];ab++){if(ac.childNodes[ab].nodeType!=3){arguments.callee(ac.childNodes[ab],aa);}}}if((r=="div"||r=="span"||r=="p"||r=="table"||r=="td")&&(!X||!~ac.className.indexOf(b[a].pref+"temper_block"))){if(X!==true||!ac.hasAttribute(b[a].pref+"logica")){ac.place=false;
if(r!="table"){ac.place=p(r,ac);}if(c.config[b[a].pref+"use_buttons"]){m(ac);}}if(Math.abs(aa.top-ad.top)<7){(function(af,ae,ag){setTimeout(function(){if(!af.parentNode.place){return false;}af.parentNode.setAttribute("data-"+ag[ae].idpref+"offset-top",af.parentNode.place.offsetHeight);},500);})(ac,a,b);}ac.setAttribute(b[a].pref+"logica",true);}})(Z.body,{left:0,top:0});s=true;};var v=false;var o=c.addCommand(b[a].name,{readOnly:1,preserveState:true,editorFocus:false,exec:function(r){this.toggleState();this.refresh(r);},refresh:function(r){if(r.document){v=this.state==CKEDITOR.TRISTATE_ON&&(r.elementMode!=CKEDITOR.ELEMENT_MODE_INLINE||r.focusManager.hasFocus);var S=v?"addClass":"removeClass";if(CKEDITOR.version.charAt(0)=="4"){S=v?"attachClass":"removeClass";r.editable()[S](b[a].pref+"show");}else{r.document.getBody()[S](b[a].pref+"show");}if(v){g();}r.document[(v)?"on":"removeListener"]("mousedown",e);}}});c.on("toDataFormat",function(r){r.data.dataValue=r.data.dataValue.replace(RegExp('[\n\rs]*<i[^>]+class="'+b[a].pref+"temper_block[^>]+></i>[\n\rs]*","g"),"").replace(RegExp('[\n\rs]*<a[^>]+class="'+b[a].pref+"temper_block[^>]+></a>[\n\rs]*","g"),"").replace(RegExp('[\n\rs]*<a[^>]+class="'+b[a].pref+"temper_place[^>]+></a>[\n\rs]*","g"),"").replace(/[\n\r\s]?data-doksoft-[^=]+="[^"]*"/g,"").replace(RegExp("[\\n\\r\\s]?"+b[a].pref+'logica="[^"]*"',"g"),"");},null,null,16);c.on("toHtml",function(r){g();},null,null,1);c.on("doksoft_change",g);c.on("doksoft_change_selective",function(){g(true);});c.on("mode",function(){if(o.state!=CKEDITOR.TRISTATE_DISABLED){o.refresh(c);}});function w(Y,X){var V=[Y],U,W,T=false,S=false;while(U=V.pop()){if(U.nodeType!=3&&U.tagName&&~X.indexOf(U.tagName.toLowerCase())){return true;}else{var r=U.childNodes.length;while(r--){V.push(U.childNodes[r]);}}}return false;}c.on(b[a].pref+"delete",function(T){if(T.data.parent){T.data.parent.removeAttribute("data-"+b[a].idpref+"selected");c.fire("saveSnapshot");c.fire("doksoft_unselect",{element:T.data.parent});var U=T.data.parent.parentNode,r=T.data.parent.tagName?T.data.parent.tagName.toLowerCase():"";U.removeChild(T.data.parent);if((r=="td"||r=="th")&&U){while(U.tagName.toLowerCase()!="table"&&U.tagName.toLowerCase()!="tr"&&U.parentNode){U=U.parentNode;}if(!w(U,["td","th"])){var S=U.parentNode;while(S.tagName.toLowerCase()!="table"&&S.parentNode){S=S.parentNode;}U.parentNode.removeChild(U);if(!w(S,["td","th"])){S.parentNode.removeChild(S);}}}t=0;}});var x=function(S){var r=S.keyCode||S.data.$.keyCode;switch(parseInt(r)){case 46:break;}};window.addEventListener("keydown",x,true);var j=function j(S,ab){var r=0,Y=c.document.$.createRange();Y.setStart(S,0);var X=[S],T,U,V=false,aa=false;while(!aa&&(T=X.pop())){if(T.nodeType==3){U=T;var Z=r+T.length;if(!V&&ab>=r&&ab<=Z){Y.setStart(T,ab-r);V=true;}if(V&&ab>=r&&ab<=Z){Y.setEnd(T,ab-r);aa=true;}r=Z;}else{var W=T.childNodes.length;while(W--){X.push(T.childNodes[W]);}}}if(!V&&U){Y.setStart(U,r);Y.setEnd(U,r);}var ac=c.document.getWindow().$.getSelection();ac.removeAllRanges();ac.addRange(Y);},E=0,N=false,O=function(r){if(!r||N){return;}N=true;c.focus();clearTimeout(E);E=setTimeout(function(){N=false;if(t==r){return;}y();if(r.tagName&&(r.tagName.toLowerCase()=="td"||r.tagName.toLowerCase()=="th")&&r.parentNode){var V=r.parentNode;while(V.tagName.toLowerCase()!="table"&&V.parentNode){V=V.parentNode;}if(V.tagName.toLowerCase()=="table"){V.setAttribute("data-"+b[a].idpref+"selected","yes");}}r.setAttribute("data-"+b[a].idpref+"selected","yes");t=r;c.fire("doksoft_select",{element:t});var S=c.document.getWindow().$.getSelection(),T=c.document.$.createRange();if(r.innerText!=""){try{j(r,1000);c.fire("selectionChange");}catch(U){}}else{r.innerHTML="\u00a0";T.selectNodeContents(r);S.removeAllRanges();S.addRange(T);c.document.$.execCommand("delete",false,null);}},300);},y=function(){if(t){if(t.tagName&&(t.tagName.toLowerCase()=="td"||t.tagName.toLowerCase()=="th")&&t.parentNode){var S=t.parentNode;while(S.tagName.toLowerCase()!="table"&&S.parentNode){S=S.parentNode;}if(S.tagName.toLowerCase()=="table"){S.removeAttribute("data-"+b[a].idpref+"selected");}}t.removeAttribute("data-"+b[a].idpref+"selected");for(var r=0;t.childNodes[r];r++){if(t.childNodes[r].nodeType!=3){t.childNodes[r].removeAttribute("active");}}c.fire("doksoft_unselect",{element:t});t=0;}};c.on("contentDom",function(){if(o.state!=CKEDITOR.TRISTATE_DISABLED){o.refresh(c);}c.document.on("mousedown",function(S){var r=S.data.$.target||S.data.$.srcElement;if(!~r.className.indexOf(b[a].name)){O(r);}});c.window.on("keydown",x);});c.on("instanceReady",function(){if(v=c.config[b[a].pref+"enabled_by_default"]){o.exec(c);}c.on("beforeSetMode",y);});c.ui.addButton(b[a].name,{label:b[a].name,command:b[a].name,icon:"plugins/"+b[a].name+"/icons/"+b[a].name+""+(CKEDITOR.version.charAt(0)=="4"?"_4":"")+".png",toolbar:"tools,20"});c.on("instanceReady",function(T){var U=c.ui.spaceId("path"),S,r=function(){if(!S){S=CKEDITOR.document.getById(U);}return S;};r().$.addEventListener("click",function(Y){var V=Y||window.event;
var X=V.target||V.srcElement;var W=parseInt(X.id.match(/_([0-9]+)$/)[1]);if(c._.elementsPath&&c._.elementsPath.list&&c._.elementsPath.list[W]){O(c._.elementsPath.list[W].$);}});});CKEDITOR.dialog.add(b[a].pref+"insert_tag",function(r){return{title:"Insert tag",minWidth:400,minHeight:200,contents:[{id:"tab_basic",label:"Basic Settings",elements:[{type:"hbox",widths:[null,null],styles:["vertical-align:top"],children:[{type:"vbox",padding:0,children:[{type:"text",id:"tagName","default":"div",label:"Tag name",required:true,},{type:"text",id:"tagId",label:"ID",},{type:"text",id:"tagClass",label:"Class",},{type:"text",id:"tagStyle",label:"Style",},]}]}]},],onCancel:function(){r._boxold.removeAttribute("active");},onOk:function(){var T=this.getValueOf("tab_basic","tagName");if(T.length<1){return false;}var U=T.replace(/[^a-z0-9]/ig,"").toLowerCase();var S=r.document.$.createElement(U?U:"div");S.className=this.getValueOf("tab_basic","tagClass");S.setAttribute("style",this.getValueOf("tab_basic","tagStyle"));S.setAttribute("id",this.getValueOf("tab_basic","tagId"));S.innerHTML=T;i(S,r._boxold,r._parentold);}};});var B="";CKEDITOR.dialog.add(b[a].pref+"insert_table",function(W){var X=b[a].idpref.replace("-x",W.name+CKEDITOR.tools.getNextNumber()),ad=W.config[b[a].pref+"gui_width"]||6,V=W.config[b[a].pref+"gui_height"]||3,Z=false,U,r,aa,T,S,Y,ab,ac;return{title:"Insert table",minWidth:250,minHeight:160,contents:[{id:"tab_basic12",elements:[{type:"hbox",widths:[null,null],styles:["vertical-align:top"],children:[{type:"vbox",padding:0,children:[{type:"html",id:"tableHTML",html:'<table border="0" cellspacing="0" cellpadding="0">'+"<tr>"+"<td>"+'<div id="box-'+X+'"><table border="0" cellpadding="1" cellspacing="1">'+(function(){tb="";var ae=Math.round(140/ad);for(var ag=1;ag<=V;ag++){tb+='<tr id="tr_'+ag+'">';for(var af=1;af<=ad;af++){tb+='<td id="td-'+X+""+ag+"-"+af+'" style="border:1px solid #c3d9ff; background-color:#ddeafb;width:'+ae+"px;height:"+ae+'px;"></td>';}tb+="</tr>";}return tb;})()+'</table></div><div id="sizer-'+X+'" style="text-align:center">1:1</div>'+"</td>"+'<td style="vertical-align:top;">&nbsp;&nbsp;&nbsp;</td>'+'<td style="vertical-align:top;">'+"<table>"+"<tr>"+'<td colspan="3"><input style="width:50px;" class="cke_dialog_ui_input_text" value="1" type="number" id="rows-'+X+'"/></td>'+"<td>&nbsp;x&nbsp;</td>"+'<td colspan="3"><input style="width:50px;" class="cke_dialog_ui_input_text" value="1" type="number" id="cols-'+X+'"/></td>'+"</tr>"+"<tr>"+'<td colspan="7">&nbsp;</td>'+"</tr>"+(!a?"<tr>"+'<td style="width:20px;vertical-align:middle;"><input type="checkbox" id="width-'+X+'"/></td>'+'<td style="vertical-align:middle;" colspan="6">Width: 100%</td>'+"</tr>":"")+(a==1?"<tr>"+'<td style="width:20px;vertical-align:middle;"><input type="checkbox" id="striped-'+X+'"/></td>'+'<td style="width:20px;vertical-align:middle;" colspan="6">Striped</td>'+"</tr>"+"<tr>"+'<td style="width:20px;vertical-align:middle;"><input type="checkbox" id="bordered-'+X+'"/></td>'+'<td style="width:20px;vertical-align:middle;" colspan="6">Bordered</td>'+"</tr>"+"<tr>"+'<td style="width:20px;vertical-align:middle;"><input type="checkbox" id="condenced-'+X+'"/></td>'+'<td style="width:20px;vertical-align:middle;" colspan="6">Condenced</td>'+"</tr>":"")+"</table>"+"</td>"+"</tr>"+"</table>",},]}]}]},],onCancel:function(){},onShow:function(){Z=true;},onLoad:function(){U=document.getElementById("box-"+X);r=document.getElementById("sizer-"+X);aa=document.getElementById("cols-"+X);T=document.getElementById("rows-"+X);S=document.getElementById("width-"+X);Y=document.getElementById("striped-"+X);ab=document.getElementById("bordered-"+X);ac=document.getElementById("condenced-"+X);aa.onblur=T.onblur=function(){var ae=parseInt(this.value.replace(/[^0-9]/g,""));this.value=(!isNaN(ae)&&ae>0)?ae:1;};U.onmouseover=function(af){if(!Z){return false;}var ai=af||window.event;var ae=(ai.srcElement||ai.target);if(ae.tagName.toLowerCase()=="td"){var aj=/-([0-9]+)-([0-9]+)$/.exec(ae.id);for(var ah=1;ah<=V;ah++){for(var ag=1;ag<=ad;ag++){document.getElementById("td-"+X+ah+"-"+ag).style.backgroundColor=(ah<=parseInt(aj[1])&&ag<=parseInt(aj[2]))?"#abcfff":"#ddeafb";}}r.innerHTML=aj[1]+":"+aj[2];T.value=parseInt(aj[1]);aa.value=parseInt(aj[2]);}};U.onmousedown=function(af){var ai=af||window.event;var ae=(ai.srcElement||ai.target);if(ae.tagName.toLowerCase()=="td"){var aj=/-([0-9]+)-([0-9]+)$/.exec(ae.id);Z=false;for(var ah=1;ah<=V;ah++){for(var ag=1;ag<=ad;ag++){document.getElementById("td-"+X+ah+"-"+ag).style.backgroundColor=(ah<=parseInt(aj[1])&&ag<=parseInt(aj[2]))?"#abcfff":"#ddeafb";}}r.innerHTML=aj[1]+":"+aj[2];T.value=parseInt(aj[1]);aa.value=parseInt(aj[2]);}};},onOk:function(){var ah=[(!isNaN(parseInt(T.value))&&parseInt(T.value)>0)?parseInt(T.value):1,(!isNaN(parseInt(aa.value))&&parseInt(aa.value)>0)?parseInt(aa.value):1];var ai=W.document.$.createElement("table"),af=W.document.$.createElement("tbody"),aj,ak;ai.appendChild(af);for(var ag=0;ag<ah[0];
ag++){aj=W.document.$.createElement("tr");for(var ae=0;ae<ah[1];ae++){ak=W.document.$.createElement("td");ak.innerHTML="td";aj.appendChild(ak);}af.appendChild(aj);}switch(a){case 0:if(S.checked){ai.style.width="100%";}break;case 1:ai.className="table ";if(Y.checked){ai.className+="table-striped ";}if(ab.checked){ai.className+="table-bordered ";}if(ac.checked){ai.className+="table-condensed ";}break;}i(ai,W._boxold,W._parentold);}};});CKEDITOR.dialog.add(b[a].pref+"insert_code",function(r){return{title:"Insert tag",minWidth:400,minHeight:160,contents:[{id:"tab_basic1",label:"Basic Settings",elements:[{type:"hbox",widths:[null,null],styles:["vertical-align:top"],children:[{type:"vbox",padding:0,children:[{type:"textarea",id:"codeHTML","default":"<div>div</div>",label:"HTML Code",inputStyle:"resize:vertical;white-space: nowrap;font-size:13px; line-height:14px;min-height:160px;",required:true,},]}]}]},],onCancel:function(){r._boxold.removeAttribute("active");},onLoad:function(){var T=document.getElementById(this.getContentElement("tab_basic1","codeHTML")._.inputId);var S=function(){var U=this.value.split(/[\n\r]/).length;this.style.height=(U>10?(U*16):160)+"px";};T.addEventListener("keyup",S);T.addEventListener("mouseup",S);},onOk:function(){var T=this.getValueOf("tab_basic1","codeHTML");if(T.length<1){return false;}var S=r.document.$.createElement("div");S.innerHTML=this.getValueOf("tab_basic1","codeHTML");i(S.firstChild,r._boxold,r._parentold);}};});}});CKEDITOR.config[b[a].pref+"margin"]=false;CKEDITOR.config[b[a].pref+"use_buttons"]=true;CKEDITOR.config[b[a].pref+"margin_top"]=5;CKEDITOR.config[b[a].pref+"margin_right"]=0;CKEDITOR.config[b[a].pref+"margin_bottom"]=5;CKEDITOR.config[b[a].pref+"margin_left"]=0;CKEDITOR.config[b[a].pref+"multiline_titles"]=true;CKEDITOR.config[b[a].pref+"gui_width"]=6;CKEDITOR.config[b[a].pref+"gui_height"]=6;CKEDITOR.config[b[a].pref+"enabled_by_default"]=true;CKEDITOR.config[b[a].pref+"big_icons"]=true;CKEDITOR.config[b[a].pref+"big_icons"]=true;CKEDITOR.config[b[a].pref+"min_div_width"]=40;CKEDITOR.config[b[a].pref+"min_div_height"]=40;})();