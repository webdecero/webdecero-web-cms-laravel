(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a04a5984"],{"0a07":function(e,t,a){},"61f0":function(e,t,a){},"6374f":function(e,t,a){"use strict";a("61f0")},ac26:function(e,t,a){"use strict";a.r(t);var n,r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"iframe-container"},[a("el-row",[e.pageStore.isVisibleNavBar?a("el-card",{staticClass:"box-card"},[a("el-menu",{staticClass:"el-menu-demo",attrs:{"default-active":e.activeIndex,mode:"horizontal"},on:{select:e.handleSelect}},[a("el-button",{staticClass:"button-nav-bar",attrs:{type:"success",size:"small",plain:""},on:{click:e.saveContent}},[e._v("Guardar plantilla")]),a("el-button",{staticClass:"button-nav-bar",attrs:{type:"primary",size:"small",plain:""},on:{click:e.clearTemplate}},[e._v("Limpiar Plantilla")]),a("el-button",{staticClass:"button-nav-bar",attrs:{type:"danger",size:"small",plain:""},on:{click:e.goToIndex}},[e._v("Cancelar")]),a("el-button",{staticClass:"button-nav-bar",attrs:{type:"warning",size:"small",plain:""},on:{click:e.showEditorSettings}},[e._v("Configuración de Editor")]),a("el-button",{staticClass:"button-nav-bar",attrs:{type:"info",size:"small",plain:""},on:{click:e.showPreviewPage}},[e._v("Previsualización de la pagina")]),a("el-submenu",{staticClass:"files-nav-bar",attrs:{index:"1"}},[a("template",{slot:"title"},[e._v("Archivos CSS")]),a("el-menu-item",{attrs:{index:"1-1"}},[e._v("Añadir un archivo CSS")]),a("el-menu-item",{attrs:{index:"1-2"}},[e._v("Añadir un CDN de CSS")])],2),a("el-submenu",{staticClass:"files-nav-bar",attrs:{index:"2"}},[a("template",{slot:"title"},[e._v("Archivos JavaScript")]),a("el-menu-item",{attrs:{index:"2-1"}},[e._v("Añadir un archivo JavaScript")]),a("el-menu-item",{attrs:{index:"2-2"}},[e._v("Añadir un CDN de JavaScript")])],2)],1)],1):e._e()],1),a("el-tooltip",{staticClass:"item",attrs:{effect:"dark",content:e.pageStore.isVisibleNavBar?"Cerrar Barra":"Abrir Barra",placement:"right"}},[a("el-button",{staticClass:"test",attrs:{type:"text"},on:{click:e.pageStore.showNavBar}},[e.pageStore.isVisibleNavBar?a("i",{staticClass:"el-icon-top icon-button"}):a("i",{staticClass:"el-icon-bottom icon-button"})])],1),a("el-dialog",{attrs:{title:e.pageStore.isJavascript?"Añade JavaScript":"Añande CSS",visible:e.pageStore.dialogVisible,width:"50%","before-close":e.pageStore.handleClose},on:{"update:visible":function(t){return e.$set(e.pageStore,"dialogVisible",t)}}},[e.pageStore.isJavascript?a("javascript"):a("css"),"3"===e.pageStore.isFile?a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,type:"flex",justify:"center"}},[a("el-col",{attrs:{xs:23,sm:23,md:23,lg:23,xl:23}},[a("h2",[e._v(" Edita el "+e._s(e.pageStore.isJavascript?"JavaScript":"CSS")+" Personalizado ")]),a("div",[a("codemirror",{attrs:{"v-model":e.content,options:e.cmOptions}})],1)])],1):e._e(),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(t){e.pageStore.dialogVisible=!1}}},[e._v("Cancel")]),a("el-button",{attrs:{type:"success"},on:{click:function(t){"3"!==e.pageStore.isFile?e.useAssets():e.onSaveCustomContent()}}},[e._v("Guardar")])],1)],1),a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{"element-loading-text":"Cargando...",gutter:10}},[a("el-col",{attrs:{xs:24,sm:24,md:24,lg:24,xl:24}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"text item"},[a("iframe",{staticStyle:{height:"650px",width:"100%"},attrs:{id:"viewEditor"}})])])],1)],1)],1)},i=[],s=a("c7eb"),l=a("1da1"),o=(a("d3b7"),a("d9e2"),a("ac1f"),a("1276"),a("35a4")),c=a("9ff9"),u=a("60d7"),d=a("9057"),p=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,"element-loading-text":"Cargando...",type:"flex",justify:"center"}},[a("el-col",{attrs:{xs:23,sm:23,md:12,lg:12,xl:12}},["1"===e.pageStore.isFile?a("div",[a("label",[e._v("Arrastra tu archivo js para agregarlo al sitio")]),a("br"),a("el-upload",{staticClass:"upload-demo",attrs:{name:"fileJS",action:"#","show-file-list":!1,drag:"","http-request":e.uploadFile}},[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v(" Suelta tu archivo aquí o "),a("em",[e._v("haz clic para cargar")])]),a("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v(" Solo archivos CSS con un tamaño menor de 10 MB ")])])],1):e._e(),"2"===e.pageStore.isFile?a("div",[a("label",[e._v("Agrega url CDN par agregarla al sitio")]),a("br"),a("br"),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{span:24}},[a("el-input",{attrs:{placeholder:"Url CDN"},model:{value:e.cdnUrl,callback:function(t){e.cdnUrl=t},expression:"cdnUrl"}})],1)],1),a("el-button",{attrs:{type:"success"},on:{click:e.uploadCDN}},[e._v(" Agregar CDN ")])],1):e._e()]),"1"===e.pageStore.isFile||"2"===e.pageStore.isFile?a("el-col",{attrs:{xs:23,sm:23,md:15,lg:17,xl:15}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Archivos cargados en el sitio")])]),a("div",{staticClass:"text item"},[a("div",{staticClass:"custom-tree-container"},[a("div",{staticClass:"block"},[a("el-tree",{attrs:{data:e.javascriptStore.list,"node-key":"id",props:e.defaultProps,"default-expand-all":"",draggable:"","allow-drop":e.allowDrop},on:{"node-drop":e.handleDrop},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.node,r=t.data;return a("span",{staticClass:"custom-tree-node"},[a("span",[e._v(e._s(n.label))]),a("span",[a("el-button",{attrs:{type:"text",size:"mini"},on:{click:function(){return e.deleteFile(n,r)}}},[e._v(" Eliminar ")])],1)])}}],null,!1,1570934514)}),a("br"),a("div",{attrs:{align:"right"}},[a("el-button",{attrs:{type:"primary",size:"medium",aling:"right"},on:{click:function(t){return e.updateTree()}}},[e._v(" Actualizar ")])],1)],1)])])])],1):e._e()],1)],1)},f=[],m=(a("b0c0"),a("c740"),a("a434"),a("ac90")),v=a("2ef0"),g=a.n(v),b=Object(u["a"])(),h=Object(d["a"])(),C={name:"Javascript",components:{},data:function(){return{loading:!1,cdnUrl:"",javascriptStore:b,pageStore:h,defaultProps:{label:"name"},cmOptions:{tabSize:4,mode:"javascript",theme:"dracula",lineNumbers:!0,line:!0}}},created:function(){},computed:{codemirror:function(){return this.$refs.editorJavascript.codemirror}},mounted:function(){},methods:{uploadCDN:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){var a,n;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:h.loading=!0,b.file.name=e.cdnUrl,b.file.pathFile=e.cdnUrl,b.file.type="External",b.file.order=b.list.length+1,a=g.a.cloneDeep(h.keyName),n=g.a.cloneDeep(b.file),b.storeJavascriptFile(n,a).finally((function(){e.cdnUrl="",h.loading=!1}));case 8:case"end":return t.stop()}}),t)})))()},uploadFile:function(e){return Object(l["a"])(Object(s["a"])().mark((function t(){var a;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:h.loading=!0,a=new FormData,a.append("file",e.file),a.append("fileName",e.file.name),a.append("folder","page/"+h.keyName),Object(m["a"])(a).then((function(t){b.file.name=e.file.name,b.file.pathFile=t.data,b.file.type="Internal",b.file.order=b.list.length+1;var a=g.a.cloneDeep(b.file),n=g.a.cloneDeep(h.keyName);b.storeJavascriptFile(a,n)})).catch((function(t){e.onError()})).finally((function(){return h.loading=!1}));case 6:case"end":return t.stop()}}),t)})))()},handleDrop:function(){b.orderFilesJavascript()},allowDrop:function(e,t,a){if("inner"!==a)return!0},updateTree:function(){var e=g.a.cloneDeep(h.keyName),t=g.a.cloneDeep(b.list);b.updateJavascriptFiles(t,e)},deleteFile:function(e,t){var a=this;this.$confirm("Se borrara el arvhivo de su sitio, ¿Esta seguro?","Cuidado",{confirmButtonText:"OK",cancelButtonText:"Cancelar",type:"warning"}).then((function(){var a=e.parent,n=a.data.children||a.data,r=n.findIndex((function(e){return e._id===t._id})),i=g.a.cloneDeep(h.keyName),s=g.a.cloneDeep(t._id);b.deleteJavascriptFile(i,s).then((function(e){n.splice(r,1)}))})).catch((function(){a.$message({showClose:!0,type:"info",message:"Se cancelo la operación"})}))},saveCustomJavascript:function(){var e=g.a.cloneDeep(h.keyName),t=g.a.cloneDeep(b.content);b.updateCustomJavascript(e,t)}}},x=C,w=a("2877"),S=Object(w["a"])(x,p,f,!1,null,null,null),_=S.exports,y=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,type:"flex",justify:"center","element-loading-text":"Cargando..."}},[a("el-col",{attrs:{xs:23,sm:23,md:12,lg:12,xl:12}},["1"===e.pageStore.isFile?a("div",[a("label",[e._v("Arrastra tu archivo css para agregarlo a tu plantilla")]),a("br"),a("el-upload",{staticClass:"upload-demo",attrs:{name:"fileCSS",action:"#","show-file-list":!1,"http-request":e.uploadFile,drag:""}},[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v(" Suelta tu archivo aquí o "),a("em",[e._v("haz clic para cargar")])]),a("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v(" Solo archivos CSS con un tamaño menor de 10 MB ")])])],1):e._e(),"2"===e.pageStore.isFile?a("div",[a("label",[e._v("Agrega url CDN par agregarla al sitio")]),a("br"),a("br"),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{span:24}},[a("el-input",{attrs:{placeholder:"Url CDN"},model:{value:e.cdnUrl,callback:function(t){e.cdnUrl=t},expression:"cdnUrl"}})],1)],1),a("el-button",{attrs:{type:"success"},on:{click:e.uploadCDN}},[e._v(" Agregar CDN ")])],1):e._e()]),"1"===e.pageStore.isFile||"2"===e.pageStore.isFile?a("el-col",{attrs:{xs:23,sm:23,md:15,lg:17,xl:15}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Archivos cargados en el sitio")])]),a("div",{staticClass:"text item"},[a("div",{staticClass:"custom-tree-container"},[a("div",{staticClass:"block"},[a("el-tree",{attrs:{data:e.cssStore.list,"node-key":"id",props:e.defaultProps,"default-expand-all":"",draggable:"","allow-drop":e.allowDrop},on:{"node-drop":e.handleDrop},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.node,r=t.data;return a("span",{staticClass:"custom-tree-node"},[a("span",[e._v(e._s(n.label))]),a("span",[a("el-button",{attrs:{type:"text",size:"mini"},on:{click:function(){return e.deleteFile(n,r)}}},[e._v(" Eliminar ")])],1)])}}],null,!1,1570934514)}),a("br"),a("div",{attrs:{align:"right"}},[a("el-button",{attrs:{type:"primary",size:"medium",aling:"right"},on:{click:function(t){return e.updateTree()}}},[e._v(" Actualizar ")])],1)],1)])])])],1):e._e()],1)],1)},k=[],j=a("bca1"),O=Object(c["a"])(),D=Object(d["a"])(),N={name:"Css",components:{},data:function(){return{cssStore:O,pageStore:D,cdnUrl:"",defaultProps:{label:"name"},content:"",cmOptions:{tabSize:4,mode:"text/css",theme:"dracula",lineNumbers:!0,line:!0}}},created:function(){},mounted:function(){},computed:{codemirror:function(){return this.$refs.editorCss.codemirror}},methods:{uploadCDN:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){var a,n;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:D.loading=!0,O.file.name=e.cdnUrl,O.file.pathFile=e.cdnUrl,O.file.type="External",O.file.order=O.list.length+1,a=g.a.cloneDeep(O.file),n=g.a.cloneDeep(D.keyName),O.storeCssFile(a,n).finally((function(){e.cdnUrl="",D.loading=!1}));case 8:case"end":return t.stop()}}),t)})))()},uploadFile:function(e){return Object(l["a"])(Object(s["a"])().mark((function t(){var a;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:D.loading=!0,a=new FormData,a.append("file",e.file),a.append("fileName",e.file.name),a.append("folder","page/"+D.keyName),Object(j["a"])(a).then((function(t){O.file.name=e.file.name,O.file.pathFile=t.data,O.file.type="Internal",O.file.order=O.list.length+1;var a=g.a.cloneDeep(O.file),n=g.a.cloneDeep(D.keyName);O.storeCssFile(a,n)})).catch((function(t){e.onError()})).finally((function(){return D.loading=!1}));case 6:case"end":return t.stop()}}),t)})))()},handleDrop:function(){O.orderFilesCss()},allowDrop:function(e,t,a){if("inner"!==a)return!0},updateTree:function(){var e=g.a.cloneDeep(D.keyName),t=g.a.cloneDeep(O.list);O.updateCssFiles(t,e)},deleteFile:function(e,t){var a=this;this.$confirm("Se borrara el arvhivo de su sitio, ¿Esta seguro?","Cuidado",{confirmButtonText:"OK",cancelButtonText:"Cancelar",type:"warning"}).then((function(){var a=e.parent,n=a.data.children||a.data,r=n.findIndex((function(e){return e._id===t._id})),i=g.a.cloneDeep(D.keyName),s=g.a.cloneDeep(t._id);O.deleteCssFile(i,s).then((function(e){n.splice(r,1)}))})).catch((function(){a.$message({showClose:!0,type:"info",message:"Se cancelo la operación"})}))}}},F=N,J=(a("6374f"),Object(w["a"])(F,y,k,!1,null,null,null)),A=J.exports,E=a("8f94"),I=Object(o["a"])(),z=Object(d["a"])(),U=Object(c["a"])(),T=Object(u["a"])(),B={components:{javascript:_,codemirror:E["codemirror"],css:A},data:function(){return{configStore:I,pageStore:z,cssStore:U,javascriptStore:T,isFile:!0,activeIndex:"1",content:"ds",slug:"",contentHtml:"",cmOptions:{tabSize:4,mode:z.isJavascript?"javascript":"text/css",theme:"dracula",lineNumbers:!0,line:!0}}},mounted:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return e.$nextTick(Object(l["a"])(Object(s["a"])().mark((function e(){return Object(s["a"])().wrap((function(e){while(1)switch(e.prev=e.next){case 0:n=document.getElementById("viewEditor"),this.useAssets();case 2:case"end":return e.stop()}}),e,this)})))),window.addEventListener("message",(function(t){e.contentHtml=t.data})),t.next=4,e.getInfoIframe("noEdit");case 4:case"end":return t.stop()}}),t)})))()},created:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){var a;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return z.isEdit=!0,z.keyName=e.$route.params.keyName,e.slug=e.$route.params.slug,a=g.a.cloneDeep(z.keyName),t.next=6,U.fetchCss(a);case 6:return t.next=8,U.fetchCustomCss(a);case 8:return t.next=10,T.fetchJavascript(a);case 10:return t.next=12,T.fetchCustomJavascript(a);case 12:return t.next=14,z.showPage(a);case 14:case"end":return t.stop()}}),t)})))()},methods:{goToIndex:function(){this.$router.push({name:"pages.index"})},useAssets:function(){z.dialogVisible=!1,n.setAttribute("src",I.baseUrl+"manager/editor/pages/"+I.langSelected+"/"+z.keyName)},getInfoIframe:function(e){var t=this;return Object(l["a"])(Object(s["a"])().mark((function a(){return Object(s["a"])().wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.abrupt("return",new Promise((function(a,n){var r=document.getElementById("viewEditor").contentWindow;r.postMessage(e,"*"),setTimeout((function(){return void 0!==t.contentHtml?a(t.contentHtml):n(new Error("esperando resultado"))}),2e3)})));case 1:case"end":return a.stop()}}),a)})))()},saveContent:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){var a,n;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return z.loading=!0,t.next=3,e.getInfoIframe("html");case 3:return a=g.a.cloneDeep(e.contentHtml),n=g.a.cloneDeep(z.keyName),t.next=7,z.updateContentHtml(a,n).then((function(t){t.success&&e.goToIndex()})).finally((function(){return z.loading=!1}));case 7:case"end":return t.stop()}}),t)})))()},clearTemplate:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){var a,n;return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return z.loading=!0,t.next=3,e.getInfoIframe("clear");case 3:a=g.a.cloneDeep(e.contentHtml),n=g.a.cloneDeep(z.keyName),z.updateContentHtml(a,n).finally((function(){z.loading=!1,e.useAssets()}));case 6:case"end":return t.stop()}}),t)})))()},showEditorSettings:function(){var e=this;return Object(l["a"])(Object(s["a"])().mark((function t(){return Object(s["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.getInfoIframe("settings");case 2:case"end":return t.stop()}}),t)})))()},onSaveCustomContent:function(){if(z.isJavascript){var e=g.a.cloneDeep(T.content),t=g.a.cloneDeep(z.keyName);T.updateCustomJavascript(e,t)}else{var a=g.a.cloneDeep(z.keyName);console.log("~ keyName",a)}},showPreviewPage:function(){var e=z.node.parent,t="/"+z.data.slug;while(e.level>=1)t="/"+e.data.slug+t,e=e.parent;window.open(I.baseUrl+t.substring(1,t.length),"_blank")},handleSelect:function(e,t){z.dialogVisible=!0,"2"===t[0]?(z.isJavascript=!0,z.isFile=e.split("-")[1]):(z.isJavascript=!1,z.isFile=e.split("-")[1])}}},$=B,P=(a("ee61"),Object(w["a"])($,r,i,!1,null,"605fe921",null));t["default"]=P.exports},ee61:function(e,t,a){"use strict";a("0a07")}}]);
//# sourceMappingURL=chunk-a04a5984.f32eb155.js.map