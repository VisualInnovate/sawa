import{_ as V,z as m,o as p,e as h,x as t,y as a,W as C,a3 as b,h as o,t as i,a0 as w,Y as I,a5 as T,Z as y,i as c,w as D,p as k,I as u,F as S,B as F,n as P,a2 as $,P as E,Q as x}from"./main-e2500f66.js";import{P as Q,S as g}from"./Pagination-53f9e7b3.js";import{V as A}from"./VDialog-534b27cf.js";import{V as B,a as z}from"./VRow-e7ffb8d8.js";import{V as N}from"./VPagination-de9a427c.js";const R={components:{Pagination:Q},data(){return{currentPage:5,currentPage:1,pageSize:10,items:[],isEditing:!1,editFormData:{title:""},searchQuery:"",rooms:[],sessionTypes:[],showDialog:!1,showModal:!1,id:"",formData:{title:""}}},computed:{roomss(){return` ${this.this.sessionTypes}`},roomssearchQuery(){return this.sessionTypes.filter(e=>e.title.match(this.searchQuery))}},methods:{deleteItem(e){m.delete(`/api/session-types/${e}`,this.formData).then(s=>{console.log("Item deleted successfully:",s.data),g.fire("تم الحذف بنجاح!","Your treatment has been deleted.","success");const r=this.sessionTypes.findIndex(f=>f.id===e);r!==-1&&this.sessionTypes.splice(r,1)}).catch(s=>{console.error("There was an error deleting the treatment: ",s),g.fire("Error!","There was a problem deleting your treatment.","error")})},getOneSession(e){m.get(`api/session-types/${e}`).then(s=>{this.formData.title=s.data.program_type.title,this.id=s.data.program_type.id}).catch(s=>{console.error("Error fetching session type:",s)})},getAllRoom(){m.get("api/session-types").then(e=>{this.sessionTypes=e.data.sessionTypes,this.items=Array.from({length:50},(s,r)=>({id:r+1,name:`Item ${r+1}`})),console.log(this.sessionTypes)})},editItem(e){this.$router.push({name:"EditRoom",params:{id:e}})},handlePageChange(e){this.currentPage=e},openForm(){this.showDialog=!0},closeForm(){this.showDialog=!1,this.formData={title:""}},saveItem(){m.post("/api/session-types",this.formData).then(e=>{console.log("Item saved successfully"),this.closeForm(),this.getprogramtype(),this.validationErrors={},this.showAlert({type:"success",message:"Item saved successfully."})}).catch(e=>{e.response&&e.response.status===422?this.validationErrors=e.response.data.errors:(console.error("Error saving item:",e),this.showAlert({type:"error",message:"Failed to save item. Please try again."}))})}},mounted(){const e=this.$route.params.id;this.getOneSession(e),this.getAllRoom()}},U=e=>(E("data-v-b429c4b7"),e=e(),x(),e),M={class:"container"},O={class:"mb-1"},Y={class:"header"},j={class:"paragraph"},q={class:"search-section"},L={class:"add-data"},W={class:"first-div"},Z=U(()=>o("i",{class:"fas fa-user"},null,-1)),G={class:"third-div"};function H(e,s,r,f,n,d){return p(),h("div",M,[t(A,{modelValue:n.showDialog,"onUpdate:modelValue":s[1]||(s[1]=l=>n.showDialog=l),class:"form-adds","max-width":"600"},{default:a(()=>[t(C,{class:"form-all",style:{"border-radius":"15px"}},{default:a(()=>[t(b,null,{default:a(()=>[o("h2",O,i(e.$t("addtypesessaion")),1)]),_:1}),t(w,null,{default:a(()=>[t(I,{modelValue:n.formData.title,"onUpdate:modelValue":s[0]||(s[0]=l=>n.formData.title=l),label:e.$t("title"),outlined:"",required:""},null,8,["modelValue","label"])]),_:1}),t(T,null,{default:a(()=>[t(y,{onClick:d.saveItem,class:"submit-button",elevation:"2"},{default:a(()=>[c(i(e.$t("submit")),1)]),_:1},8,["onClick"]),t(y,{onClick:d.closeForm,class:"",elevation:"2"},{default:a(()=>[c(i(e.$t("Cancel")),1)]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["modelValue"]),o("div",Y,[o("div",j,[o("h2",null,i(e.$t("typesessaion")),1),o("p",null,i(e.$t("sessationName")),1)]),o("div",q,[D(o("input",{type:"text","onUpdate:modelValue":s[2]||(s[2]=l=>n.searchQuery=l),placeholder:"Search...",class:"search-input"},null,512),[[k,n.searchQuery]]),t(u,{color:"success",size:"40",onClick:s[3]||(s[3]=l=>e.performSearch()),class:"icon-border"},{default:a(()=>[c("mdi-magnify")]),_:1})]),o("div",L,[t(B,{cols:"12",sm:"6",md:"4",class:"create-user-link",onClick:d.openForm},{default:a(()=>[t(u,{color:"success",size:"40",class:"icon-border"},{default:a(()=>[c("mdi-plus")]),_:1}),o("p",null,i(e.$t("addtypesessaion")),1)]),_:1},8,["onClick"])])]),(p(!0),h(S,null,F(d.roomssearchQuery,(l,_)=>(p(),h("div",{class:"content",key:_},[o("div",W,[Z,o("h5",null,i(e.$t("nameSasstion"))+" :"+i(l.title),1)]),o("div",G,[t(u,{small:"",color:"primary",class:"mx-3",onClick:v=>d.openForm(l.id)},{default:a(()=>[c("mdi-pencil")]),_:2},1032,["onClick"]),t(u,{small:"",color:"error mx-3",onClick:P(v=>d.deleteItem(l.id),["prevent"])},{default:a(()=>[c("mdi-delete")]),_:2},1032,["onClick"])])]))),128)),t($,null,{default:a(()=>[t(z,{justify:"center"},{default:a(()=>[t(N,{modelValue:e.page,"onUpdate:modelValue":s[4]||(s[4]=l=>e.page=l),length:"5",color:"blue"},null,8,["modelValue"])]),_:1})]),_:1})])}const te=V(R,[["render",H],["__scopeId","data-v-b429c4b7"]]);export{te as default};
