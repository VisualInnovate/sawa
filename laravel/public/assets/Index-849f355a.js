import{B as S,r as o,q as h,o as m,e as w,w as s,b as l,i as T,l as z,k as x,t as i,C as D,D as F,j as r,c as f,F as b,f as _,A as R}from"./index-0f7c46ae.js";import{V as d,a as y}from"./VRow-999e1338.js";import{V as U}from"./VPagination-f09e58cf.js";import{V as q,b as M}from"./VCard-4ef62870.js";const L={__name:"Index",setup($){S();const V=o([]),v=o(""),C=o([{text:"Id",value:"id",sortable:!1},{text:"Name",align:"start",sortable:!1,value:"name"},{text:"Module",value:"module",sortable:!1}]),u=o(1),g=o(0),c=o(10),P=o([5,10,20]),k=(a,t,e)=>{let n={};return a&&(n.name=a),t&&(n.page=t),e&&(n.size=e),n},p=async()=>{const a=k(v.value,u.value,c.value),t=await R.post("/api/permissions",a),{data:e,last_page:n}=t.data.permissions;V.value=e.map(N),g.value=n},B=a=>{u.value=a,p()},I=a=>{c.value=a,u.value=1,p()},N=a=>({id:a.id,name:a.name,module:a.module});return h(()=>{p()}),(a,t)=>(m(),w(y,{align:"center",class:"list px-3 mx-auto"},{default:s(()=>[l(d,{cols:"12",sm:"8"},{default:s(()=>[l(T,{modelValue:v.value,"onUpdate:modelValue":t[0]||(t[0]=e=>v.value=e),label:"Search by Name",onKeyup:t[1]||(t[1]=e=>{u.value=1,p()})},null,8,["modelValue"])]),_:1}),l(d,{cols:"12",sm:"4"},{default:s(()=>[l(z,{color:"success",to:{name:"CreatePermission"},disabled:""},{default:s(()=>[x(i(a.$t("create_button")),1)]),_:1})]),_:1}),l(d,{cols:"12",sm:"12"},{default:s(()=>[l(y,null,{default:s(()=>[l(d,{cols:"4",sm:"3"},{default:s(()=>[l(D,{modelValue:c.value,"onUpdate:modelValue":[t[2]||(t[2]=e=>c.value=e),I],items:P.value,label:"Items per Page"},null,8,["modelValue","items"])]),_:1}),l(d,{cols:"12",sm:"9"},{default:s(()=>[l(U,{rounded:"circle",modelValue:u.value,"onUpdate:modelValue":[t[3]||(t[3]=e=>u.value=e),B],length:g.value,"total-visible":"3","next-icon":"mdi-menu-right","prev-icon":"mdi-menu-left"},null,8,["modelValue","length"])]),_:1})]),_:1})]),_:1}),l(d,{cols:"12",sm:"12"},{default:s(()=>[l(q,{class:"mx-auto",tile:""},{default:s(()=>[l(M,null,{default:s(()=>[x("Permissions")]),_:1}),l(F,null,{default:s(()=>[r("thead",null,[r("tr",null,[(m(!0),f(b,null,_(C.value,e=>(m(),f("th",{key:e.id},i(e.text),1))),128))])]),r("tbody",null,[(m(!0),f(b,null,_(V.value,e=>(m(),f("tr",{key:e.id},[r("td",null,i(e.id),1),r("td",null,i(e.name),1),r("td",null,i(e.module),1)]))),128))])]),_:1})]),_:1})]),_:1})]),_:1}))}};export{L as default};
