import{_ as f,z as u,l as k,o as c,e as V,f as h,V as x,q as m,x as t,y as s,i as d,t as r,Z as C,a3 as b,af as v,Y as H,bl as I,h as n,I as p,W as $,F as q}from"./main-e2500f66.js";const B={data(){return{search:"",headers:[],questionHeaders:[],alert_text:null,loading:!0}},methods:{getQuestionHeaders(){u.get("/api/evaluationheaders").then(e=>{this.questionHeaders=e.data.headers,this.loading=!1})},editItem(e){this.$router.push({name:"EditHeaders",params:{id:e}})},deleteItem(e){console.log(e),u.delete(`/api/evaluationheaders/${e}/delete`).then(o=>{o.data.status==200&&(this.alert_text="category has been deleted successfully ",this.questionHeaders=o.data.headers)})},create(){this.$router.push({name:"CreateHeaders"})}},computed:{header(){return this.headers=[{key:"id",title:this.$t("index")},{key:"title",title:this.$t("header_title")},{key:"type",title:this.$t("header_type")},{key:"min_age",title:this.$t("min_age")},{key:"actions",title:this.$t("actions")}]}},mounted(){this.getQuestionHeaders()}};function N(e,o,F,S,a,i){const _=k("v-data-table");return c(),V(q,null,[a.alert_text!=null?(c(),h(x,{key:0,type:"success",variant:"tonal",border:"start",elevation:"2",closable:"","close-label":e.$t("close"),text:a.alert_text,class:"mb-8"},null,8,["close-label","text"])):m("",!0),t(C,{text:"Create",color:"green",height:"45",class:"mb-5 mt-5",onClick:i.create},{default:s(()=>[d(r(e.$t("create_button")),1)]),_:1},8,["onClick"]),t($,null,{default:s(()=>[t(b,null,{default:s(()=>[d(r(e.$t("headers"))+" ",1),t(v),t(H,{modelValue:a.search,"onUpdate:modelValue":o[0]||(o[0]=l=>a.search=l),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1}),t(_,{headers:i.header,items:a.questionHeaders,search:a.search},{top:s(()=>[a.loading?(c(),h(I,{key:0,slot:"progress",style:{color:"#135c65"},indeterminate:""})):m("",!0)]),item:s(({item:l,index:g})=>[n("tr",null,[n("td",null,r(g+1),1),n("td",null,r(l.columns.title),1),n("td",null,r(l.columns.type),1),n("td",null,r(l.columns.min_age)+" months",1),n("td",null,[t(p,{small:"",color:"primary",class:"mr-2",onClick:y=>i.editItem(l.columns.id)},{default:s(()=>[d("mdi-pencil")]),_:2},1032,["onClick"]),t(p,{small:"",color:"error",onClick:y=>i.deleteItem(l.columns.id)},{default:s(()=>[d("mdi-delete")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items","search"])]),_:1})],64)}const E=f(B,[["render",N]]);export{E as default};
