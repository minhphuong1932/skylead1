var doksoftTemplatesUtils={pluginName:"doksoft_templates",escapeHtml:function(a){return a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#039;");},getHtmlOfTemplate:function(e,a,b,f){var g="img";if(e[2]!==undefined){g=e[2];}var i="";if(e[3]!=undefined){i=e[3];}var d="";if(g=="img"){d='<img src="'+e[0]+'"/>';}else{if(g=="text"){var c=25;var j=15;c=j+8;d='<div style="font-size:'+j+"px;line-height:"+c+"px;min-width:"+c+"px;min-height:"+c+'px;border:solid #CCC 1px;text-align:center;vertical-align:middle;cursor:pointer">'+e[0]+"</div>";}else{d=e[0];}}d='<div id="'+this.pluginName+"_template_"+a+'" class="'+this.pluginName+'_template" style="display:table-cell;float:left;padding:5px"><div class="'+this.pluginName+'_template_html">'+d+"</div>";d+='<div class="'+this.pluginName+'_template_name" style="width:100%; max-width:100%; font-size:11px; text-align:center;'+(b?"":"display:none")+'">'+this.escapeHtml(i)+"</div>";d+="</div>";d=d.replace(/\{path\}/g,CKEDITOR.basePath+"plugins/"+this.pluginName);return d;},insertSelectedTemplate:function(e,f){var b=e.config.doksoft_templates[f][1];if(Object.prototype.toString.call(b)==="[object Array]"){for(var a=0;a<b.length;a++){b[a]=b[a].replace(/\{path\}/g,CKEDITOR.basePath+"plugins/"+this.pluginName);}}else{b=b.replace(/\{path\}/g,CKEDITOR.basePath+"plugins/"+this.pluginName);}if(e.config.doksoft_templates[f][2]=="text"){var d=e.document.createElement("span");d.setHtml(b);e.insertText(d.getText());}else{if(e.config.doksoft_templates[f][2]=="html_arr"){for(a=0;a<b.length;a++){var c=CKEDITOR.dom.element.createFromHtml(b[a]);e.insertElement(c);}}else{var c=CKEDITOR.dom.element.createFromHtml(b);e.insertElement(c);}}},readBooleanVar:function(b,a){if(b===undefined){b=a;}else{if(b!=a){b=!a;}}return b;},readIntVar:function(b,a){if(b===undefined){b=a;}return b;},readStringVar:function(b,a){if(b===undefined){b=a;}return b;},search:function(){var e=CKEDITOR.currentInstance;var b=document.getElementById(this.pluginName+"_search").value;var d=document.getElementsByClassName(this.pluginName+"_template");for(var c=0;c<d.length;c++){if(b==""){d[c].style.display="block";}else{var a=d[c].getElementsByClassName(this.pluginName+"_template_name");d[c].style.display=(a[0]!==undefined&&a[0].innerHTML.toLowerCase().indexOf(b.toLowerCase())>-1)?"block":"none";}}}};CKEDITOR.plugins.add(doksoftTemplatesUtils.pluginName,{lang:"en,ru",requires:["panelbutton","floatpanel"],icons:doksoftTemplatesUtils.pluginName,init:function(g){if(false){g.ui.addButton("doksoft_templates",{command:"doksoft_templates",icon:this.path+"icons/doksoft_templates.png"});}if(typeof g.lang.doksoft_templates.doksoft_templates!="undefined"){g.lang.doksoft_templates=g.lang.doksoft_templates.doksoft_templates;}g.config.doksoft_templates_use_builtins=doksoftTemplatesUtils.readBooleanVar(g.config.doksoft_templates_use_builtins,true);g.config.doksoft_templates_show_search=doksoftTemplatesUtils.readBooleanVar(g.config.doksoft_templates_show_search,false);g.config.doksoft_templates_show_titles=doksoftTemplatesUtils.readBooleanVar(g.config.doksoft_templates_show_titles,false);g.config.doksoft_templates_use_dialog=doksoftTemplatesUtils.readBooleanVar(g.config.doksoft_templates_use_dialog,false);g.config.doksoft_templates_popup_width=doksoftTemplatesUtils.readIntVar(g.config.doksoft_templates_popup_width,375);if((typeof g.config.doksoft_templates)!="array"&&(typeof g.config.doksoft_templates)!="object"){g.config.doksoft_templates=[];}if(g.config.doksoft_templates_use_builtins){g.config.doksoft_templates=g.config.doksoft_templates.concat([["{path}/img/templates/w33w67.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:33%"><p>33%</p></div><div class="cke_show_border" style="float:left;width:67%"><p>67%</p></div></div>',"img","33%/ 67%"],["{path}/img/templates/w50w50.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:50%"><p>50%</p></div><div class="cke_show_border" style="float:left;width:50%"><p>50%</p></div></div>',"img","50% / 50%"],["{path}/img/templates/w67w33.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:67%"><p>67%</p></div><div class="cke_show_border" style="float:left;width:33%"><p>33%</p></div></div>',"img","67% / 33%"],["{path}/img/templates/w25w25w50.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:50%"><p>50%</p></div></div>',"img","25% / 25% / 50%"],["{path}/img/templates/w25w25w25w25.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div></div>',"img","25%/25%/25%/25%"],["{path}/img/templates/w50w25w25.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:50%"><p>50%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div></div>',"img","50% / 25% / 25%"],["{path}/img/templates/imgl.png",'<div class="cke_show_border" style="float:left;width:100%;text-align:left"><p><img src="{path}/img/sample.png" style="float:left;padding:0 20px 20px 0">Text text text</p></div>',"img","Image + Text"],["{path}/img/templates/w25w50w25.png",'<div class="cke_show_border" style="float:left;width:100%"><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div><div class="cke_show_border" style="float:left;width:50%"><p>50%</p></div><div class="cke_show_border" style="float:left;width:25%"><p>25%</p></div></div>',"img","25% / 50% / 25%"],["{path}/img/templates/imgr.png",'<div class="cke_show_border" style="float:left;width:100%;text-align:right"><p>Text text text<img src="{path}/img/sample.png" style="float:right;padding:0 0 20px 20px"></p></div>',"img","Text + Image"]]);
}var e=function(b){return new g.dom.element(b,g.document);};var f=function(j){for(var b in j){return[b,j[b]];}};var h=0,i,d=-1,c=function(b){var p=document.getElementById(b);var o=p.getBoundingClientRect(),q=document.body,k=document.documentElement,j=window.pageYOffset||k.scrollTop||q.scrollTop,m=window.pageXOffset||k.scrollLeft||q.scrollLeft,n=k.clientTop||q.clientTop||0,r=k.clientLeft||q.clientLeft||0,s=o.top+j-n,l=o.left+m-r;return{top:Math.round(s),left:Math.round(l)};};g.on("instanceReady",function(n){var b='<div id="cke_'+doksoftTemplatesUtils.pluginName+"_"+g.name+'1" style="'+"overflow-y:scroll;padding:5px;"+(n.editor.config.doksoft_templates_use_dialog?"max-height:500px;max-width:500px;height:500px;width:500px;border:1px solid gray":"max-height:500px;max-width:"+n.editor.config.doksoft_templates_popup_width+"px;width:"+n.editor.config.doksoft_templates_popup_width+"px;")+'">';if(n.editor.config.doksoft_templates_show_search){b+='<div style="width:100%">'+'<input oninput="doksoftTemplatesUtils.search()" style="'+(n.editor.config.doksoft_templates_use_dialog?"width:90%":"width:"+(n.editor.config.doksoft_templates_popup_width-75)+"px")+";padding:6px 6px 6px 34px;margin:5px 5px 15px 5px;border:1px solid gray;font-size:14px;background:url("+"'"+CKEDITOR.basePath+"plugins/"+doksoftTemplatesUtils.pluginName+"/icons/search.png"+"'"+') no-repeat scroll 4px 2px" id="'+doksoftTemplatesUtils.pluginName+'_search"/>'+"</div>";}b+='<div style="width:100%;padding:0;margin:0">';for(var l=0;l<g.config.doksoft_templates.length;l++){b+=doksoftTemplatesUtils.getHtmlOfTemplate(g.config.doksoft_templates[l],l,g.config.doksoft_templates_show_titles,n.editor);}b+="</div>";b+="</div>";h=document.createElement("div");h.setAttribute("id","cke_"+doksoftTemplatesUtils.pluginName+"_"+g.name);var k='<style type="text/css">.'+doksoftTemplatesUtils.pluginName+"_template:hover { outline: 1px silver solid; background: #EFEFFF; cursor:pointer} </style>";h.innerHTML=k+b;var j="cke_tpl_list_label_"+CKEDITOR.tools.getNextNumber();CKEDITOR.dialog.add(doksoftTemplatesUtils.pluginName,function(q){return{width:520,height:520,minWidth:520,maxHeight:520,resizable:0,title:q.lang[doksoftTemplatesUtils.pluginName].title,contents:[{id:"tab1",expand:true,focus:true,elements:[{type:"vbox",padding:10,children:[{id:"selectTpl",type:"html",html:"<div></div>",},],}],}],onLoad:function(){},onShow:function(){d=-1;if(!this.sdfsdf){var r=this.getContentElement("tab1","selectTpl");r.getElement().$.innerHtml="";r.getElement().$.appendChild(h);this.sdfsdf=1;}},onOk:function(){if(d>-1){doksoftTemplatesUtils.insertSelectedTemplate(n.editor,d);}}};});i=g.addCommand(doksoftTemplatesUtils.pluginName,new CKEDITOR.dialogCommand(doksoftTemplatesUtils.pluginName));if(!n.editor.config.doksoft_templates_use_dialog){h.setAttribute("style","display:none;background:#fff; border:1px solid #ccc;padding:5px;position:absolute;");document.body.appendChild(h);}var m=h.getElementsByClassName(doksoftTemplatesUtils.pluginName+"_template"),p=function(v){var r=g.getSelection(),s=r.createBookmarks();var t=v||window.event;var u=this,q="";if(u.id&&(q=/^doksoft_templates_template_([0-9]+)$/.exec(u.id))){!n.editor.config.doksoft_templates_use_dialog&&(h.style.display="none");doksoftTemplatesUtils.insertSelectedTemplate(n.editor,q[1]);setTimeout(function(){g.focus();},10);}else{if(u.id!="cke_"+doksoftTemplatesUtils.pluginName+"_"+g.name&&u.id!="cke_"+doksoftTemplatesUtils.pluginName+"_"+g.name+"1"){!n.editor.config.doksoft_templates_use_dialog&&(h.style.display="none");}}},o=function(u){var t=this,q="";if(t.id&&(q=/^doksoft_templates_template_([0-9]+)$/.exec(t.id))){var s=h.getElementsByClassName(doksoftTemplatesUtils.pluginName+"_template");for(var r=0;r<s.length;r++){if(s[r].id&&(/^doksoft_templates_template_([0-9]+)$/.exec(s[r].id))){s[r].style.backgroundColor="#fff";}}t.style.backgroundColor="#9EC2F3";d=q[1];}};for(var l=0;l<m.length;l++){if(m[l].id&&(line=/^doksoft_templates_template_([0-9]+)$/.exec(m[l].id))){m[l]["onmousedown"]=!n.editor.config.doksoft_templates_use_dialog?p:o;n.editor.config.doksoft_templates_use_dialog&&(m[l]["ondblclick"]=p);}}if(!n.editor.config.doksoft_templates_use_dialog){g.document.$.addEventListener("mousedown",function(q){h.style.display="none";},false);window.addEventListener("mousedown",function(s){var q=s||window.event;var r=(q.srcElement||q.target);if(h.style.display=="block"&&r.id!=doksoftTemplatesUtils.pluginName+"_search"&&r.id!="cke_"+doksoftTemplatesUtils.pluginName+"_"+g.name&&r.id!="cke_"+doksoftTemplatesUtils.pluginName+"_"+g.name+"1"){h.style.display="none";}else{}},false);}});var a=0;if(!g.config.doksoft_templates_use_dialog){g.ui.add(doksoftTemplatesUtils.pluginName,CKEDITOR.UI_PANELBUTTON,{label:g.lang[doksoftTemplatesUtils.pluginName].title,title:g.lang[doksoftTemplatesUtils.pluginName].title,modes:{wysiwyg:1},className:"cke_button_templates",panel:{attributes:{role:"listbox","aria-label":"ang.panelTitle"}},onBlock:function(b,j){window[doksoftTemplatesUtils.pluginName+"_"+g.name+"_button_id"]=this._.id;
var k=c(this._.id);h.style.left=(k.left)+"px";h.style.top=(k.top+24)+"px";h.style.zIndex=(g.config.baseFloatZIndex+1);b.onShow=function(){id=window[doksoftTemplatesUtils.pluginName+"_"+g.name+"_button_id"];var l=c(id);this.element.setStyle("visibility","hidden");h.style.display="block";h.style.left=(l.left)+"px";h.style.top=(l.top+24)+"px";h.style.zIndex=(g.config.baseFloatZIndex+1);};},icon:this.path+"/icons/"+doksoftTemplatesUtils.pluginName+(CKEDITOR.version.charAt(0)=="4"?"_4":"")+".png",});}else{g.ui.addButton(doksoftTemplatesUtils.pluginName,{className:"cke_button_templates",label:g.lang[doksoftTemplatesUtils.pluginName].title,title:g.lang[doksoftTemplatesUtils.pluginName].title,icon:this.path+"/icons/"+doksoftTemplatesUtils.pluginName+(CKEDITOR.version.charAt(0)=="4"?"_4":"")+".png",command:doksoftTemplatesUtils.pluginName});}}});