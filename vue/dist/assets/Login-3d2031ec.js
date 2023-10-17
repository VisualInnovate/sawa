import{a2 as y,a3 as c,k as h,o as u,e as p,q as e,a4 as l,a5 as k,x as s,a6 as b,a7 as C,f as S,F as E,z as F,t as g,V as B,p as L,l as P,a8 as w,h as r,i,a9 as V,aa as I,w as N,v as q,ab as z,G as A}from"./main-0ea29110.js";import{V as T}from"./VForm-fb70fdc9.js";const U={class:"py-4"},$=["value"],j={key:1,class:"d-block"},D=r("div",{class:"text-subtitle-1 text-medium-emphasis"},"Account",-1),G={class:"text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"},M=r("p",null,"Sign in with your email and password:",-1),R=r("p",null,[i("Email: "),r("strong",null,"admin@admin.com")],-1),H=r("p",null,[i("Password: "),r("strong",null,"password")],-1),Q={__name:"Login",setup(J){const n=y(),m=c(!1),d=c({email:"",password:""}),v=c(!1),_=c({email:[o=>!!o||"E-mail is required",o=>/.+@.+/.test(o)||"E-mail must be valid"],password:[o=>!!o||"Password is required"]});return(o,a)=>{const f=h("router-link");return u(),p("div",U,[e(k,{class:"mx-auto mb-10","max-width":"228",src:l(C)},null,8,["src"]),e(b,{class:"mx-auto pa-12 pb-8",elevation:"8","max-width":"448",rounded:"lg"},{default:s(()=>[l(n).errors.length!==0?(u(),S(B,{key:0,class:"custom-alert-class",type:"error",variant:"tonal",border:"start",elevation:"2",closable:"","close-label":o.$t("close")},{default:s(()=>[typeof l(n).errors=="object"?(u(!0),p(E,{key:0},F(l(n).errors,(t,x)=>(u(),p("small",{class:"d-block",value:x,key:x},g(t),9,$))),128)):(u(),p("small",j,g(l(n).errors),1))]),_:1},8,["close-label"])):L("",!0),e(T,{onSubmit:a[3]||(a[3]=P(t=>l(n).handleLogin(d.value),["prevent"])),modelValue:v.value,"onUpdate:modelValue":a[4]||(a[4]=t=>v.value=t)},{default:s(()=>[D,e(w,{density:"compact",placeholder:"Email address","prepend-inner-icon":"mdi-email-outline",variant:"outlined",modelValue:d.value.email,"onUpdate:modelValue":a[0]||(a[0]=t=>d.value.email=t),rules:_.value.email},null,8,["modelValue","rules"]),r("div",G,[i(" Password "),e(f,{class:"text-caption text-decoration-none text-blue",to:{name:"ForgotPassword"},rel:"noopener noreferrer",target:"_blank"},{default:s(()=>[i(" Forgot login password?")]),_:1})]),e(w,{"append-inner-icon":m.value?"mdi-eye-off":"mdi-eye",type:m.value?"text":"password",density:"compact",placeholder:"Enter your password","prepend-inner-icon":"mdi-lock-outline",variant:"outlined","onClick:appendInner":a[1]||(a[1]=t=>m.value=!m.value),modelValue:d.value.password,"onUpdate:modelValue":a[2]||(a[2]=t=>d.value.password=t),rules:_.value.password},null,8,["append-inner-icon","type","modelValue","rules"]),e(b,{class:"mb-12",color:"surface-variant",variant:"tonal"},{default:s(()=>[e(V,{class:"text-medium-emphasis text-caption"},{default:s(()=>[M,R,H]),_:1})]),_:1}),e(I,{block:"",type:"submit",class:"mb-8",color:"blue",size:"large",variant:"tonal"},{default:s(()=>[N(e(z,{indeterminate:"",color:"info",class:"mx-3",size:"25"},null,512),[[q,l(n).loading]]),i(" Log In ")]),_:1})]),_:1},8,["modelValue"]),e(V,{class:"text-center"},{default:s(()=>[e(f,{class:"text-blue text-decoration-none",to:{name:"Register"},rel:"noopener noreferrer"},{default:s(()=>[i(" Sign up now "),e(A,{icon:"mdi-chevron-right"})]),_:1})]),_:1})]),_:1})])}}};export{Q as default};
