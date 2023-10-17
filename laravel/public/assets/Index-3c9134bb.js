import{_ as f,A as u,a as k,o as c,c as V,e as p,g as _,b as t,w as a,k as i,t as o,l as g,a9 as b,i as x,aa as y,j as d,p as h}from"./index-59e8678e.js";import{V as v}from"./VAlert-ba5bd8b8.js";import{b as I,V as $}from"./VCard-67f3ee41.js";const w={data(){return{search:"",headers:[],children:[],alert_text:null,loading:!0}},computed:{header(){return this.headers=[{key:"id",title:this.$t("index")},{key:"name",title:this.$t("child_name")},{key:"birth_date",title:this.$t("birth_date")},{key:"actions",title:this.$t("actions")}]}},methods:{getChildren(){u.get("/api/child").then(e=>{this.children=e.data.children,console.log(e.data.children),this.loading=!1})},editItem(e){this.$router.push({name:"EditChildren",params:{id:e}})},deleteItem(e){console.log(e),u.delete(`/api/child/${e}/delete`).then(s=>{s.data.status==200&&(this.alert_text="children deleted successfully ",this.children=s.data.children)})},showItem(e){this.$router.push({name:"ShowChildren",params:{id:e}})},create(){this.$router.push({name:"CreateChildren"})}},mounted(){this.$route.params.alert&&(this.alert_text="done "),this.getChildren()}};function B(e,s,N,S,r,n){const C=k("v-data-table");return c(),V("div",null,[r.alert_text!=null?(c(),p(v,{key:0,type:"success",variant:"tonal",border:"start",elevation:"2",closable:"","close-label":e.$t("close"),text:r.alert_text,class:"mb-8"},null,8,["close-label","text"])):_("",!0),t(g,{text:"Create",color:"green",height:"45",class:"mb-5 mt-5",onClick:n.create},{default:a(()=>[i(o(e.$t("create_button")),1)]),_:1},8,["onClick"]),t($,null,{default:a(()=>[t(I,null,{default:a(()=>[i(o(e.$t("children"))+" ",1),t(b),t(x,{modelValue:r.search,"onUpdate:modelValue":s[0]||(s[0]=l=>r.search=l),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1}),t(C,{headers:n.header,items:r.children,search:r.search},{top:a(()=>[r.loading?(c(),p(y,{key:0,slot:"progress",style:{color:"#135c65"},indeterminate:""})):_("",!0)]),item:a(({item:l})=>[d("tr",null,[d("td",null,o(l.columns.id),1),d("td",null,o(l.columns.name),1),d("td",null,o(l.columns.birth_date),1),d("td",null,[t(h,{small:"",color:"primary",class:"mr-2",onClick:m=>n.showItem(l.columns.id)},{default:a(()=>[i("mdi-eye")]),_:2},1032,["onClick"]),t(h,{small:"",color:"primary",class:"mr-2",onClick:m=>n.editItem(l.columns.id)},{default:a(()=>[i("mdi-pencil")]),_:2},1032,["onClick"]),t(h,{small:"",color:"error",onClick:m=>n.deleteItem(l.columns.id)},{default:a(()=>[i("mdi-delete")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items","search"])]),_:1})])}const j=f(w,[["render",B]]);export{j as default};
