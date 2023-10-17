import{_,A as m,a as k,o as h,c as C,b as t,w as a,p as d,k as o,t as n,l as p,e as V,g as b,a9 as x,i as g,j as u}from"./index-59e8678e.js";import{V as w}from"./VAlert-ba5bd8b8.js";import{b as $,V as y}from"./VCard-67f3ee41.js";const B={data(){return{search:"",headers:[],evaluations:[],alert_text:null}},methods:{getEvaluations(){m.get(`/api/side-profiles/${this.$route.params.id}/evaluations`).then(e=>{this.evaluations=e.data.evaluations,console.log(e.data.evaluations)})},editItem(e){this.$router.push({name:"EditEvaluations",params:{id:e}})},deleteItem(e){console.log(e),m.delete(`/api/evaluations/${e}/delete`).then(i=>{i.data.status==200&&(this.alert_text="evaluation deleted successfully ",this.evaluations=i.data.evaluations)})},create(){this.$router.push({name:"CreateEvaluations",params:{sideProfile_id:this.$route.params.id}})},showItem(e){this.$router.push({name:"ShowEvaluations",params:{id:e}})}},computed:{header(){return this.headers=[{title:this.$t("index")},{key:"title",title:this.$t("evaluation_title")}]}},mounted(){this.getEvaluations()}};function E(e,i,I,S,l,r){const v=k("v-data-table");return h(),C("div",null,[t(p,{height:"45",class:"mb-5 text-white",color:"#A9AB7F",onClick:e.goBack},{default:a(()=>[t(d,{start:"",icon:"mdi-arrow-left"}),o(" "+n(e.$t("back")),1)]),_:1},8,["onClick"]),l.alert_text!=null?(h(),V(w,{key:0,type:"success",variant:"tonal",border:"start",elevation:"2",closable:"","close-label":e.$t("close"),text:l.alert_text,class:"mb-8"},null,8,["close-label","text"])):b("",!0),t(p,{text:"Create",color:"green",height:"45",class:"mb-5 mt-5",onClick:r.create},{default:a(()=>[o(n(e.$t("create_button")),1)]),_:1},8,["onClick"]),t(y,null,{default:a(()=>[t($,null,{default:a(()=>[o(n(e.$t("evaluations"))+" ",1),t(x),t(g,{modelValue:l.search,"onUpdate:modelValue":i[0]||(i[0]=s=>l.search=s),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1}),t(v,{headers:r.header,items:l.evaluations,search:l.search},{item:a(({item:s,index:f})=>[u("tr",null,[u("td",null,n(f+1),1),u("td",null,n(s.columns.title),1),u("td",null,[t(d,{small:"",color:"primary",class:"mx-3",onClick:c=>r.showItem(s.raw.id)},{default:a(()=>[o("mdi-plus-box")]),_:2},1032,["onClick"]),t(d,{small:"",color:"primary",class:"mx-3",onClick:c=>r.editItem(s.raw.id)},{default:a(()=>[o("mdi-pencil")]),_:2},1032,["onClick"]),t(d,{small:"",color:"error mx-3",onClick:c=>r.deleteItem(s.raw.id)},{default:a(()=>[o("mdi-delete")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items","search"])]),_:1})])}const F=_(B,[["render",E]]);export{F as default};
