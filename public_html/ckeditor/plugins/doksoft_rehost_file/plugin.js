CKEDITOR.plugins.add("doksoft_rehost_file",{lang:["en","ru"],init:function(a){if(typeof a.lang.doksoft_rehost_file.doksoft_rehost_file!="undefined"){a.lang.doksoft_rehost_file=a.lang.doksoft_rehost_file.doksoft_rehost_file;}var b=a.addCommand("doksoft_rehost_file",new CKEDITOR.dialogCommand("doksoft_rehost_file"));b.modes={wysiwyg:1,source:0};b.canUndo=true;if(CKEDITOR.version.charAt(0)=="4"){a.ui.addButton("doksoft_rehost_file",{label:a.lang.doksoft_rehost_file.button_label,command:"doksoft_rehost_file",icon:this.path+"doksoft_rehost_file_4.png"});}else{a.ui.addButton("doksoft_rehost_file",{label:a.lang.doksoft_rehost_file.button_label,command:"doksoft_rehost_file",icon:this.path+"doksoft_rehost_file.png"});}CKEDITOR.dialog.add("doksoft_rehost_file",this.path+"dialogs/dlg_upload.js");}});