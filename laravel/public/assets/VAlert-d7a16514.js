import{av as I,H as L,I as A,K as D,az as R,L as w,aB as z,aC as F,M,O,P as E,Q as H,R as K,Z as o,U as Q,aF as j,aG as G,aH as N,aI as U,aK as Z,aL as q,aM as J,aQ as W,a0 as X,S as Y,b as t,aP as p,aw as c,p as ee,l as ae}from"./index-0f7c46ae.js";const te=I("v-alert-title"),le=["success","info","warning","error"],oe=L({name:"VAlert",props:{border:{type:[Boolean,String],validator:e=>typeof e=="boolean"||["top","end","bottom","start"].includes(e)},borderColor:String,closable:Boolean,closeIcon:{type:A,default:"$close"},closeLabel:{type:String,default:"$vuetify.close"},icon:{type:[Boolean,String,Function,Object],default:null},modelValue:{type:Boolean,default:!0},prominent:Boolean,title:String,text:String,type:{type:String,validator:e=>le.includes(e)},...D(),...R(),...w(),...z(),...F(),...M(),...O(),...E(),...H({variant:"flat"})},emits:{"update:modelValue":e=>!0},setup(e,u){let{slots:a}=u;const n=K(e,"modelValue"),l=o(()=>{if(e.icon!==!1)return e.type?e.icon??`$${e.type}`:e.icon}),d=o(()=>({color:e.color??e.type,variant:e.variant})),{themeClasses:v}=Q(e),{colorClasses:m,colorStyles:y,variantClasses:f}=j(d),{densityClasses:b}=G(e),{dimensionStyles:P}=N(e),{elevationClasses:C}=U(e),{locationStyles:V}=Z(e),{positionClasses:k}=q(e),{roundedClasses:x}=J(e),{textColorClasses:S,textColorStyles:_}=W(X(e,"borderColor")),{t:g}=Y(),r=o(()=>({"aria-label":g(e.closeLabel),onClick(s){n.value=!1}}));return()=>{var s,i;const B=!!(a.prepend||l.value),T=!!(a.title||e.title),$=!!(e.text||a.text),h=!!(a.close||e.closable);return n.value&&t(e.tag,{class:["v-alert",e.border&&{"v-alert--border":!!e.border,[`v-alert--border-${e.border===!0?"start":e.border}`]:!0},{"v-alert--prominent":e.prominent},v.value,m.value,b.value,C.value,k.value,x.value,f.value],style:[y.value,P.value,V.value],role:"alert"},{default:()=>[p(!1,"v-alert"),e.border&&t("div",{key:"border",class:["v-alert__border",S.value],style:_.value},null),B&&t(c,{key:"prepend",defaults:{VIcon:{density:e.density,icon:l.value,size:e.prominent?44:28}}},{default:()=>[t("div",{class:"v-alert__prepend"},[a.prepend?a.prepend():l.value&&t(ee,null,null)])]}),t("div",{class:"v-alert__content"},[T&&t(te,{key:"title"},{default:()=>[a.title?a.title():e.title]}),$&&(a.text?a.text():e.text),(s=a.default)==null?void 0:s.call(a)]),a.append&&t("div",{key:"append",class:"v-alert__append"},[a.append()]),h&&t(c,{key:"close",defaults:{VBtn:{icon:e.closeIcon,size:"x-small",variant:"text"}}},{default:()=>[t("div",{class:"v-alert__close"},[((i=a.close)==null?void 0:i.call(a,{props:r.value}))??t(ae,r.value,null)])]})]})}}});export{oe as V};
