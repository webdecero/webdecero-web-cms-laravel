(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-c57d3732"],{"3ef4":function(e,t,a){},"460f":function(e,t,a){"use strict";a("7428")},"5c04":function(e,t,a){"use strict";a("a0e5")},7428:function(e,t,a){},a0e5:function(e,t,a){},ca95:function(e,t,a){"use strict";a.r(t);var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"app-container"},[a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{offset:1,xs:22,sm:22,md:22,lg:22,xl:22}},[a("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.handleClick}},[a("el-tab-pane",{attrs:{label:"SEO"}},[a("seo")],1),a("el-tab-pane",{attrs:{label:"CSS"}},[a("css")],1),a("el-tab-pane",{attrs:{label:"JavaScript"}},[a("javascript")],1),e.isPage?a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,"element-loading-text":"Cargando...",type:"flex",justify:"center"}},[a("el-col",{attrs:{xs:23,sm:23,md:23,lg:23,xl:23}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Custom")])]),a("div",[a("codemirror",{ref:"editorJavascript",attrs:{options:e.cmOptions},model:{value:e.content,callback:function(t){e.content=t},expression:"content"}})],1),a("div",{staticClass:"margin-10"},[a("el-button",{attrs:{type:"primary",size:"small"},on:{click:function(t){return t.stopPropagation(),t.preventDefault(),e.saveCustom.apply(null,arguments)}}},[e._v(" Actualizar")])],1)])],1)],1):e._e(),a("el-button",{staticClass:"go-index",attrs:{type:"danger",size:"small",icon:"el-icon-back"},on:{click:e.goToIndex}},[e._v(" Cancelar")])],1)],1)],1)],1)},r=[],i=a("c7eb"),s=a("1da1"),l=(a("d3b7"),a("9057")),o=a("be92"),c=a("b775");function d(e){return Object(c["a"])({url:"pages/"+e+"/seo",method:"get"})}function u(e,t){return Object(c["a"])({url:"pages/"+t+"/seo",method:"put",data:e})}var p,f=a("35a4"),m=Object(f["a"])(),v=Object(l["a"])(),g=Object(o["c"])("seo",{state:function(){return{configStore:m,pageStore:v,keyName:"",list:{},form:{}}},actions:{indexSeo:function(e){var t=this;return Object(s["a"])(Object(i["a"])().mark((function a(){return Object(i["a"])().wrap((function(a){while(1)switch(a.prev=a.next){case 0:return v.loading=!0,a.next=3,d(e).then((function(e){return t.list=e.data,t.list})).catch((function(e){console.log("responseCatch -> data",e)})).finally((function(){return v.loading=!1}));case 3:return a.abrupt("return",a.sent);case 4:case"end":return a.stop()}}),a)})))()},updateSeo:function(e,t){var a=this;return Object(s["a"])(Object(i["a"])().mark((function n(){return Object(i["a"])().wrap((function(n){while(1)switch(n.prev=n.next){case 0:return v.loading=!0,n.next=3,u(e,t).then((function(e){return a.list=e.data,a.list})).catch((function(e){console.log("responseCatch -> data",e)})).finally((function(){return v.loading=!1}));case 3:return n.abrupt("return",n.sent);case 4:case"end":return n.stop()}}),n)})))()}}}),h=a("9ff9"),b=a("60d7"),x=a("8f94"),C=a("5c96"),S=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,"element-loading-text":"Cargando...",type:"flex",justify:"center"}},[a("el-col",{attrs:{xs:23,sm:23,md:12,lg:12,xl:12}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Archivos")])]),a("div",{staticClass:"text item"},[a("label",[e._v("Arrastra tu archivo js para agregarlo al sitio")]),a("br"),a("el-upload",{staticClass:"upload-demo",attrs:{name:"fileJS",action:"#","show-file-list":!1,drag:"","http-request":e.uploadFile}},[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v(" Suelta tu archivo aquí o "),a("em",[e._v("haz clic para cargar")])]),a("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v(" Solo archivos CSS con un tamaño menor de 10 MB ")])])],1),a("el-divider"),a("div",[a("label",[e._v("Agrega url CDN par agregarla al sitio")]),a("br"),a("br"),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{span:19}},[a("el-input",{attrs:{placeholder:"Url CDN"},model:{value:e.cdnUrl,callback:function(t){e.cdnUrl=t},expression:"cdnUrl"}})],1),a("el-col",{attrs:{span:2}},[a("el-button",{attrs:{type:"success"},on:{click:e.uploadCDN}},[e._v(" Agregar CDN ")])],1)],1)],1)],1)],1),a("el-col",{attrs:{xs:23,sm:23,md:11,lg:11,xl:11}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Archivos cargados en el sitio")])]),a("div",{staticClass:"text item"},[a("div",{staticClass:"custom-tree-container"},[a("div",{staticClass:"block"},[a("el-tree",{attrs:{data:e.javascriptStore.list,"node-key":"id",props:e.defaultProps,"default-expand-all":"",draggable:"","allow-drop":e.allowDrop},on:{"node-drop":e.handleDrop},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.node,r=t.data;return a("span",{staticClass:"custom-tree-node"},[a("span",[e._v(e._s(n.label))]),a("span",[a("el-button",{attrs:{type:"text",size:"mini"},on:{click:function(){return e.deleteFile(n,r)}}},[e._v(" Eliminar ")])],1)])}}])}),a("br"),a("div",{attrs:{align:"right"}},[a("el-button",{attrs:{type:"primary",size:"medium",aling:"right"},on:{click:function(t){return e.updateTree()}}},[e._v(" Actualizar ")])],1)],1)])])])],1)],1)],1)},_=[],y=(a("b0c0"),a("c740"),a("a434"),a("ac90")),w=a("2ef0"),k=a.n(w),j=Object(b["a"])(),O=Object(l["a"])(),D={name:"Javascript",components:{},data:function(){return{javascriptStore:j,pageStore:O,cdnUrl:"",defaultProps:{label:"name"},cmOptions:{tabSize:4,theme:"dracula",lineNumbers:!0,line:!0}}},created:function(){},computed:{codemirror:function(){return this.$refs.editorJavascript.codemirror}},mounted:function(){},methods:{uploadCDN:function(){var e=this;return Object(s["a"])(Object(i["a"])().mark((function t(){var a,n;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:O.loading=!0,j.file.name=e.cdnUrl,j.file.pathFile=e.cdnUrl,j.file.type="External",j.file.order=j.list.length+1,a=k.a.cloneDeep(O.keyName),n=k.a.cloneDeep(j.file),j.storeJavascriptFile(n,a).finally((function(){e.cdnUrl="",O.loading=!1}));case 8:case"end":return t.stop()}}),t)})))()},uploadFile:function(e){return Object(s["a"])(Object(i["a"])().mark((function t(){var a;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:O.loading=!0,a=new FormData,a.append("file",e.file),a.append("fileName",e.file.name),a.append("folder","page/"+O.keyName),Object(y["a"])(a).then((function(t){j.file.name=e.file.name,j.file.pathFile=t.data,j.file.type="Internal",j.file.order=j.list.length+1;var a=k.a.cloneDeep(j.file),n=k.a.cloneDeep(O.keyName);j.storeJavascriptFile(a,n)})).catch((function(t){e.onError()})).finally((function(){return O.loading=!1}));case 6:case"end":return t.stop()}}),t)})))()},handleDrop:function(){j.orderFilesJavascript()},allowDrop:function(e,t,a){if("inner"!==a)return!0},updateTree:function(){var e=k.a.cloneDeep(O.keyName),t=k.a.cloneDeep(j.list);O.loading=!0,j.updateJavascriptFiles(t,e).finally((function(){return O.loading=!1}))},deleteFile:function(e,t){var a=this;this.$confirm("Se borrara el arvhivo de su sitio, ¿Esta seguro?","Cuidado",{confirmButtonText:"OK",cancelButtonText:"Cancelar",type:"warning"}).then((function(){O.loading=!0;var a=e.parent,n=a.data.children||a.data,r=n.findIndex((function(e){return e._id===t._id})),i=k.a.cloneDeep(O.keyName),s=k.a.cloneDeep(t._id);j.deleteJavascriptFile(i,s).then((function(e){n.splice(r,1)})).finally((function(){return O.loading=!1}))})).catch((function(){a.$message({showClose:!0,type:"info",message:"Se cancelo la operación"})}))},saveCustomJavascript:function(){var e=k.a.cloneDeep(O.keyName),t=k.a.cloneDeep(j.content);j.updateCustomJavascript(e,t)}}},N=D,F=a("2877"),U=Object(F["a"])(N,S,_,!1,null,null,null),$=U.exports,z=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",{directives:[{name:"loading",rawName:"v-loading",value:e.pageStore.loading,expression:"pageStore.loading"}],attrs:{gutter:10,"element-loading-text":"Cargando...",type:"flex",justify:"center"}},[a("el-col",{attrs:{xs:23,sm:23,md:12,lg:12,xl:12}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Agrega archivos a tu sitio")])]),a("div",{staticClass:"text item"},[a("label",[e._v("Arrastra tu archivo css para agregarlo a tu plantilla")]),a("br"),a("el-upload",{staticClass:"upload-demo",attrs:{name:"fileCSS",action:"#","show-file-list":!1,"http-request":e.uploadFile,drag:""}},[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v(" Suelta tu archivo aquí o "),a("em",[e._v("haz clic para cargar")])]),a("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v(" Solo archivos CSS con un tamaño menor de 10 MB ")])])],1),a("el-divider"),a("div",[a("label",[e._v("Agrega url CDN par agregarla al sitio")]),a("br"),a("br"),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{span:19}},[a("el-input",{attrs:{placeholder:"Url CDN"},model:{value:e.cdnUrl,callback:function(t){e.cdnUrl=t},expression:"cdnUrl"}})],1),a("el-col",{attrs:{span:2}},[a("el-button",{attrs:{type:"success"},on:{click:e.uploadCDN}},[e._v(" Agregar CDN ")])],1)],1)],1)],1)],1),a("el-col",{attrs:{xs:23,sm:23,md:11,lg:11,xl:11}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("span",[e._v("Archivos cargados en el sitio")])]),a("div",{staticClass:"text item"},[a("div",{staticClass:"custom-tree-container"},[a("div",{staticClass:"block"},[a("el-tree",{attrs:{data:e.cssStore.list,"node-key":"id",props:e.defaultProps,"default-expand-all":"",draggable:"","allow-drop":e.allowDrop},on:{"node-drop":e.handleDrop},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.node,r=t.data;return a("span",{staticClass:"custom-tree-node"},[a("span",[e._v(e._s(n.label))]),a("span",[a("el-button",{attrs:{type:"text",size:"mini"},on:{click:function(){return e.deleteFile(n,r)}}},[e._v(" Eliminar ")])],1)])}}])}),a("br"),a("div",{attrs:{align:"right"}},[a("el-button",{attrs:{type:"primary",size:"medium",aling:"right"},on:{click:function(t){return e.updateTree()}}},[e._v(" Actualizar ")])],1)],1)])])])],1)],1)],1)},T=[],E=a("bca1"),P=Object(h["a"])(),J=Object(l["a"])(),A={name:"Css",components:{},data:function(){return{cssStore:P,pageStore:J,cdnUrl:"",defaultProps:{label:"name"},content:"",cmOptions:{tabSize:4,mode:"text/css",theme:"dracula",lineNumbers:!0,line:!0}}},created:function(){},mounted:function(){},computed:{codemirror:function(){return this.$refs.editorCss.codemirror}},methods:{uploadCDN:function(){var e=this;return Object(s["a"])(Object(i["a"])().mark((function t(){var a,n;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:J.loading=!0,P.file.name=e.cdnUrl,P.file.pathFile=e.cdnUrl,P.file.type="External",P.file.order=P.list.length+1,a=k.a.cloneDeep(P.file),n=k.a.cloneDeep(J.keyName),P.storeCssFile(a,n).finally((function(){e.cdnUrl="",J.loading=!1}));case 8:case"end":return t.stop()}}),t)})))()},uploadFile:function(e){return Object(s["a"])(Object(i["a"])().mark((function t(){var a;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:J.loading=!0,a=new FormData,a.append("file",e.file),a.append("fileName",e.file.name),a.append("folder","page/"+J.keyName),Object(E["a"])(a).then((function(t){P.file.name=e.file.name,P.file.pathFile=t.data,P.file.type="Internal",P.file.order=P.list.length+1;var a=k.a.cloneDeep(P.file),n=k.a.cloneDeep(J.keyName);P.storeCssFile(a,n)})).catch((function(t){e.onError()})).finally((function(){return J.loading=!1}));case 6:case"end":return t.stop()}}),t)})))()},handleDrop:function(){P.orderFilesCss()},allowDrop:function(e,t,a){if("inner"!==a)return!0},updateTree:function(){J.loading=!0;var e=k.a.cloneDeep(J.keyName),t=k.a.cloneDeep(P.list);P.updateCssFiles(t,e).finally((function(){return J.loading=!1}))},deleteFile:function(e,t){var a=this;this.$confirm("Se borrara el arvhivo de su sitio, ¿Esta seguro?","Cuidado",{confirmButtonText:"OK",cancelButtonText:"Cancelar",type:"warning"}).then((function(){J.loading=!0;var a=e.parent,n=a.data.children||a.data,r=n.findIndex((function(e){return e._id===t._id})),i=k.a.cloneDeep(J.keyName),s=k.a.cloneDeep(t._id);P.deleteCssFile(i,s).then((function(e){n.splice(r,1)})).finally((function(){return J.loading=!1}))})).catch((function(){a.$message({showClose:!0,type:"info",message:"Se cancelo la operación"})}))},saveCustomCss:function(){var e=k.a.cloneDeep(J.keyName),t=k.a.cloneDeep(P.content);P.updateCustomCss(e,t)}}},I=A,q=(a("5c04"),Object(F["a"])(I,z,T,!1,null,null,null)),B=q.exports,M=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-row",{attrs:{gutter:10,type:"flex",justify:"center"}},[a("el-col",{attrs:{offset:1,xs:22,sm:22,md:16,lg:16,xl:16}},[a("el-row",{staticClass:"text-color-gray",attrs:{type:"flex"}},[a("el-col",{attrs:{span:12}},[a("label",{staticStyle:{"padding-left":"10px"}},[e._v("Editar:")]),e._v("   "),a("el-switch",{model:{value:e.isUpdateForm,callback:function(t){e.isUpdateForm=t},expression:"isUpdateForm"}})],1)],1),a("div",{staticStyle:{margin:"20px"}}),e.isUpdateForm?e._e():a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"text item"},[a("label",{staticClass:"text-color-gray"},[e._v("Título: "),e.seoStore.list.title?a("span",[e._v(e._s(e.seoStore.list.title))]):e._e()]),a("br"),a("label",{staticClass:"text-color-gray"},[e._v("Descripción: "),e.seoStore.list.description?a("span",[e._v(e._s(e.seoStore.list.description))]):e._e()]),a("br"),a("label",{staticClass:"text-color-gray"},[e._v("MetaTags: "),e.seoStore.list.description?a("span",[e._v(e._s(e.seoStore.list.metaTag))]):e._e()]),a("br"),a("label",{staticClass:"text-color-gray"},[e._v("Schema: "),e.seoStore.list.schema?a("span",[e._v(e._s(e.seoStore.list.schema))]):e._e()]),a("br"),a("label",{staticClass:"text-color-gray"},[e._v("Imagen:")]),a("br"),e.seoStore.list.image?a("img",{staticClass:"image-seo",attrs:{src:e.configStore.baseUrl+e.seoStore.list.image}}):a("div",[a("span",[e._v("Sin imagen")])])])]),e.isUpdateForm?a("div",{staticStyle:{"margin-top":"20px"}},[a("el-card",{staticClass:"box-card"},[a("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[a("strong",[a("span",[e._v("Agregar SEO")])])]),a("div",{staticClass:"text item"},[a("ValidationObserver",{ref:"form",scopedSlots:e._u([{key:"default",fn:function(t){var n=t.invalid;return[a("el-form",{attrs:{"label-position":"top","label-width":"120px",model:e.seoStore.list}},[a("el-form-item",{attrs:{label:"Título"}},[a("ValidationProvider",{attrs:{name:"título",rules:"required|min:4|max:60"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.errors;return[a("el-input",{attrs:{size:"mini","show-word-limit":"",minlength:"4",maxlength:"60"},model:{value:e.seoStore.list.title,callback:function(t){e.$set(e.seoStore.list,"title",t)},expression:"seoStore.list.title"}}),a("span",[e._v(e._s(n[0]))])]}}],null,!0)})],1),a("el-form-item",{attrs:{label:"Descripción"}},[a("ValidationProvider",{attrs:{name:"descripción",rules:"required|min:10|max:160"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.errors;return[a("el-input",{attrs:{size:"mini",type:"textarea",rows:2,minlength:"10",maxlength:"160","show-word-limit":""},model:{value:e.seoStore.list.description,callback:function(t){e.$set(e.seoStore.list,"description",t)},expression:"seoStore.list.description"}}),a("span",[e._v(e._s(n[0]))])]}}],null,!0)})],1),a("el-form-item",{attrs:{label:"Imagen"}},[a("el-upload",{staticClass:"avatar-uploader",attrs:{drag:"",name:"image",action:"#","show-file-list":!1,"http-request":e.uploadImage,"before-upload":e.beforeUpload}},[e.seoStore.list.image?a("img",{attrs:{src:e.configStore.baseUrl+e.seoStore.list.image,alt:""}}):[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v(" Suelta tu foto aquí o "),a("em",[e._v("haz clic para cargar")])])],a("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v(" Solo archivos jpg con una medida de 800X800 pixeles ")])],2)],1),a("el-form-item",{attrs:{label:"Tags"}},[a("ValidationProvider",{attrs:{name:"Tags",rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.errors;return[a("el-select",{attrs:{size:"mini",multiple:"",filterable:"","allow-create":"",placeholder:"Tags"},model:{value:e.seoStore.list.metaTag,callback:function(t){e.$set(e.seoStore.list,"metaTag",t)},expression:"seoStore.list.metaTag"}},e._l(e.siteStore.optionsTags,(function(e){return a("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})})),1),a("span",[e._v(e._s(n[0]))])]}}],null,!0)})],1),a("el-form-item",{attrs:{label:"Schema"}},[a("ValidationProvider",{attrs:{name:"schema",rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.errors;return[a("el-input",{attrs:{size:"mini","show-word-limit":""},model:{value:e.seoStore.list.schema,callback:function(t){e.$set(e.seoStore.list,"schema",t)},expression:"seoStore.list.schema"}}),a("span",[e._v(e._s(n[0]))])]}}],null,!0)})],1),a("el-form-item",[a("el-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-upload2",disabled:n},on:{click:function(t){return t.stopPropagation(),t.preventDefault(),e.checkSave.apply(null,arguments)}}},[e._v(" "+e._s(e.siteStore.isSeoUpdate?"Actualizar":"Guardar"))])],1)],1)]}}],null,!1,3617959159)})],1)])],1):e._e()],1)],1)},V=[],K=(a("a15b"),a("fb6a"),a("ac1f"),a("1276"),a("30b3")),G=a("4ab8"),X=Object(K["a"])(),H=Object(f["a"])(),L=g(),Q=Object(l["a"])(),R={name:"Seo",data:function(){return{siteStore:X,configStore:H,seoStore:L,pageStore:Q,isUpdateForm:!1}},created:function(){var e=this;return Object(s["a"])(Object(i["a"])().mark((function t(){var a;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return Q.keyName=e.$route.params.keyName,a=k.a.cloneDeep(Q.keyName),t.next=4,L.indexSeo(a);case 4:case"end":return t.stop()}}),t)})))()},methods:{uploadImage:function(e){return Object(s["a"])(Object(i["a"])().mark((function t(){var a,n,r,s;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:Q.loading=!0,a=e.file.name,n=a.split(".").slice(0,-1).join("."),r=a.split(".").pop(),s=new FormData,s.append("name",n),s.append("thumbName","thumb-"+n),s.append("originalName",a),s.append("extension",e.file.type),s.append("image",e.file),s.append("orientation","horizontal"),s.append("format",r),s.append("isPublic",1),s.append("width","250"),s.append("height","250"),s.append("title","Image"),s.append("alt","ciberseguridadSeo"),Object(G["d"])(s).then((function(t){L.list.image=t.data.path,e.onSuccess(t.data.path)})).catch((function(t){e.onError()})).finally((function(){return Q.loading=!1}));case 18:case"end":return t.stop()}}),t)})))()},checkSave:function(){var e=this;Q.loading=!0;var t=k.a.cloneDeep(L.list),a=k.a.cloneDeep(Q.keyName);L.updateSeo(t,a).then((function(){e.isUpdateForm=!1})).finally((function(){return Q.loading=!1}))},beforeUpload:function(e){var t="image/jpeg"===e.type,a="image/png"===e.type,n=e.size/1024/1024<10,r=!0;return t||a||(this.$message.error("¡El archivo debe ser una imagen!"),r=!1),n||this.$message.error("¡El archivo excede los 10MB!"),r&&n}}},W=R,Y=(a("460f"),Object(F["a"])(W,M,V,!1,null,"682d5c24",null)),Z=Y.exports,ee=Object(l["a"])(),te=g(),ae=Object(h["a"])(),ne=Object(b["a"])(),re={components:{javascript:$,css:B,seo:Z,codemirror:x["codemirror"]},data:function(){return{pageStore:ee,cssStore:ae,javascriptStore:ne,seoStore:te,form:{title:"",header:"",footer:""},isPage:!1,content:"",cmOptions:{tabSize:4,mode:"",theme:"dracula",lineNumbers:!0,line:!0}}},created:function(){var e=this;return Object(s["a"])(Object(i["a"])().mark((function t(){var a;return Object(i["a"])().wrap((function(t){while(1)switch(t.prev=t.next){case 0:return ee.keyName=e.$route.params.keyName,a=k.a.cloneDeep(ee.keyName),t.next=4,ae.fetchCss(a).then((function(){Object(C["Message"])({showClose:!0,message:"Pagina encontrada",type:"success"})})).catch((function(){Object(C["Message"])({showClose:!0,message:"Pagina no encontrada",type:"danger"})}));case 4:return t.next=6,ae.fetchCustomCss(a);case 6:return t.next=8,ne.fetchJavascript(a);case 8:return t.next=10,ne.fetchCustomJavascript(a);case 10:return t.next=12,te.indexSeo(a);case 12:case"end":return t.stop()}}),t)})))()},methods:{handleClick:function(e,t){"pane-0"===e.$el.id?this.isPage=!1:"pane-1"===e.$el.id?(this.isPage=!0,this.content=ae.content,this.cmOptions.mode="text/css",p=e.$el.id):"pane-2"===e.$el.id&&(this.isPage=!0,this.content=ne.content,this.cmOptions.mode="text/javascript",p=e.$el.id)},saveCustom:function(){ee.loading=!0;var e=k.a.cloneDeep(ee.keyName);if("pane-1"===p){var t=k.a.cloneDeep(this.content);ae.updateCustomCss(t,e).finally((function(){return ee.loading=!1}))}else if("pane-2"===p){var a=k.a.cloneDeep(this.content);ne.updateCustomJavascript(a,e).finally((function(){return ee.loading=!1}))}},goToIndex:function(){this.$router.push({name:"pages.index"})}}},ie=re,se=(a("f033"),Object(F["a"])(ie,n,r,!1,null,"a8101f10",null));t["default"]=se.exports},f033:function(e,t,a){"use strict";a("3ef4")}}]);
//# sourceMappingURL=chunk-c57d3732.834d4097.js.map