import{s as I,bj as h,an as k,am as p,ao as B,ap as H,j as V,ar as _,bk as x,l as E,ag as F,o as a,f as b,y as o,x as s,av as R,w as K,e as C,m as f,r as w,g as S,q as L,h as c,t as m,L as A,_ as P,z,E as T,V as D,i as v,Z as N,a3 as U,af as q,Y as M,bl as Y,I as j,W as Z}from"./main-e2500f66.js";var O={name:"ConfirmPopup",extends:I,inheritAttrs:!1,props:{group:String},data(){return{visible:!1,confirmation:null,autoFocusAccept:null,autoFocusReject:null}},target:null,outsideClickListener:null,scrollHandler:null,resizeListener:null,container:null,confirmListener:null,closeListener:null,mounted(){this.confirmListener=e=>{e&&e.group===this.group&&(this.confirmation=e,this.target=e.target,this.confirmation.onShow&&this.confirmation.onShow(),this.visible=!0)},this.closeListener=()=>{this.visible=!1,this.confirmation=null},h.on("confirm",this.confirmListener),h.on("close",this.closeListener)},beforeUnmount(){h.off("confirm",this.confirmListener),h.off("close",this.closeListener),this.unbindOutsideClickListener(),this.scrollHandler&&(this.scrollHandler.destroy(),this.scrollHandler=null),this.unbindResizeListener(),this.container&&(k.clear(this.container),this.container=null),this.target=null,this.confirmation=null},methods:{accept(){this.confirmation.accept&&this.confirmation.accept(),this.visible=!1},reject(){this.confirmation.reject&&this.confirmation.reject(),this.visible=!1},onHide(){this.confirmation.onHide&&this.confirmation.onHide(),this.visible=!1},onAcceptKeydown(e){(e.code==="Space"||e.code==="Enter")&&(this.accept(),p.focus(this.target),e.preventDefault())},onRejectKeydown(e){(e.code==="Space"||e.code==="Enter")&&(this.reject(),p.focus(this.target),e.preventDefault())},onEnter(e){this.autoFocusAccept=this.confirmation.defaultFocus===void 0||this.confirmation.defaultFocus==="accept",this.autoFocusReject=this.confirmation.defaultFocus==="reject",this.bindOutsideClickListener(),this.bindScrollListener(),this.bindResizeListener(),k.set("overlay",e,this.$primevue.config.zIndex.overlay)},onAfterEnter(){this.focus()},onLeave(){this.autoFocusAccept=null,this.autoFocusReject=null,this.unbindOutsideClickListener(),this.unbindScrollListener(),this.unbindResizeListener()},onAfterLeave(e){k.clear(e)},alignOverlay(){p.absolutePosition(this.container,this.target);const e=p.getOffset(this.container),i=p.getOffset(this.target);let d=0;e.left<i.left&&(d=i.left-e.left),this.container.style.setProperty("--overlayArrowLeft",`${d}px`),e.top<i.top&&p.addClass(this.container,"p-confirm-popup-flipped")},bindOutsideClickListener(){this.outsideClickListener||(this.outsideClickListener=e=>{this.visible&&this.container&&!this.container.contains(e.target)&&!this.isTargetClicked(e)?(this.confirmation.onHide&&this.confirmation.onHide(),this.visible=!1):this.alignOverlay()},document.addEventListener("click",this.outsideClickListener))},unbindOutsideClickListener(){this.outsideClickListener&&(document.removeEventListener("click",this.outsideClickListener),this.outsideClickListener=null)},bindScrollListener(){this.scrollHandler||(this.scrollHandler=new B(this.target,()=>{this.visible&&(this.visible=!1)})),this.scrollHandler.bindScrollListener()},unbindScrollListener(){this.scrollHandler&&this.scrollHandler.unbindScrollListener()},bindResizeListener(){this.resizeListener||(this.resizeListener=()=>{this.visible&&!p.isTouchDevice()&&(this.visible=!1)},window.addEventListener("resize",this.resizeListener))},unbindResizeListener(){this.resizeListener&&(window.removeEventListener("resize",this.resizeListener),this.resizeListener=null)},focus(){let e=this.container.querySelector("[autofocus]");e&&e.focus({preventScroll:!0})},isTargetClicked(e){return this.target&&(this.target===e.target||this.target.contains(e.target))},containerRef(e){this.container=e},onOverlayClick(e){H.emit("overlay-click",{originalEvent:e,target:this.target})},onOverlayKeydown(e){e.code==="Escape"&&(h.emit("close",this.closeListener),p.focus(this.target))}},computed:{containerClass(){return["p-confirm-popup p-component",{"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1}]},message(){return this.confirmation?this.confirmation.message:null},iconClass(){return["p-confirm-popup-icon",this.confirmation?this.confirmation.icon:null]},acceptLabel(){return this.confirmation?this.confirmation.acceptLabel||this.$primevue.config.locale.accept:null},rejectLabel(){return this.confirmation?this.confirmation.rejectLabel||this.$primevue.config.locale.reject:null},acceptIcon(){return this.confirmation?this.confirmation.acceptIcon:null},rejectIcon(){return this.confirmation?this.confirmation.rejectIcon:null},acceptClass(){return["p-confirm-popup-accept p-button-sm",this.confirmation?this.confirmation.acceptClass:null]},rejectClass(){return["p-confirm-popup-reject p-button-sm",this.confirmation?this.confirmation.rejectClass||"p-button-text":null]}},components:{CPButton:V,Portal:_},directives:{focustrap:x}};const W=["aria-modal"];function $(e,i,d,u,n,t){const g=E("CPButton"),r=E("Portal"),y=F("focustrap");return a(),b(r,null,{default:o(()=>[s(R,{name:"p-confirm-popup",onEnter:t.onEnter,onAfterEnter:t.onAfterEnter,onLeave:t.onLeave,onAfterLeave:t.onAfterLeave},{default:o(()=>[n.visible?K((a(),C("div",f({key:0,ref:t.containerRef,role:"alertdialog",class:t.containerClass,"aria-modal":n.visible,onClick:i[2]||(i[2]=(...l)=>t.onOverlayClick&&t.onOverlayClick(...l)),onKeydown:i[3]||(i[3]=(...l)=>t.onOverlayKeydown&&t.onOverlayKeydown(...l))},{...e.$attrs,...e.ptm("root")}),[e.$slots.message?(a(),b(S(e.$slots.message),{key:1,message:n.confirmation},null,8,["message"])):(a(),C("div",f({key:0,class:"p-confirm-popup-content"},e.ptm("content")),[w(e.$slots,"icon",{class:"p-confirm-popup-icon"},()=>[e.$slots.icon?(a(),b(S(e.$slots.icon),{key:0,class:"p-confirm-popup-icon"})):n.confirmation.icon?(a(),C("span",f({key:1,class:t.iconClass},e.ptm("icon")),null,16)):L("",!0)]),c("span",f({class:"p-confirm-popup-message"},e.ptm("message")),m(n.confirmation.message),17)],16)),c("div",f({class:"p-confirm-popup-footer"},e.ptm("footer")),[s(g,{label:t.rejectLabel,class:A(t.rejectClass),onClick:i[0]||(i[0]=l=>t.reject()),onKeydown:t.onRejectKeydown,autofocus:n.autoFocusReject,pt:e.ptm("rejectButton")},{icon:o(l=>[w(e.$slots,"rejecticon",{},()=>[c("span",f({class:[t.rejectIcon,l.class]},e.ptm("rejectButton").icon),null,16)])]),_:3},8,["label","class","onKeydown","autofocus","pt"]),s(g,{label:t.acceptLabel,class:A(t.acceptClass),onClick:i[1]||(i[1]=l=>t.accept()),onKeydown:t.onAcceptKeydown,autofocus:n.autoFocusAccept,pt:e.ptm("acceptButton")},{icon:o(l=>[w(e.$slots,"accepticon",{},()=>[c("span",f({class:[t.acceptIcon,l.class]},e.ptm("acceptButton").icon),null,16)])]),_:3},8,["label","class","onKeydown","autofocus","pt"])],16)],16,W)),[[y]]):L("",!0)]),_:3},8,["onEnter","onAfterEnter","onLeave","onAfterLeave"])]),_:3})}function G(e,i){i===void 0&&(i={});var d=i.insertAt;if(!(!e||typeof document>"u")){var u=document.head||document.getElementsByTagName("head")[0],n=document.createElement("style");n.type="text/css",d==="top"&&u.firstChild?u.insertBefore(n,u.firstChild):u.appendChild(n),n.styleSheet?n.styleSheet.cssText=e:n.appendChild(document.createTextNode(e))}}var J=`
.p-confirm-popup {
    position: absolute;
    margin-top: 10px;
    top: 0;
    left: 0;
}
.p-confirm-popup-flipped {
    margin-top: 0;
    margin-bottom: 10px;
}

/* Animation */
.p-confirm-popup-enter-from {
    opacity: 0;
    transform: scaleY(0.8);
}
.p-confirm-popup-leave-to {
    opacity: 0;
}
.p-confirm-popup-enter-active {
    transition: transform 0.12s cubic-bezier(0, 0, 0.2, 1), opacity 0.12s cubic-bezier(0, 0, 0.2, 1);
}
.p-confirm-popup-leave-active {
    transition: opacity 0.1s linear;
}
.p-confirm-popup:after,
.p-confirm-popup:before {
    bottom: 100%;
    left: calc(var(--overlayArrowLeft, 0) + 1.25rem);
    content: ' ';
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
}
.p-confirm-popup:after {
    border-width: 8px;
    margin-left: -8px;
}
.p-confirm-popup:before {
    border-width: 10px;
    margin-left: -10px;
}
.p-confirm-popup-flipped:after,
.p-confirm-popup-flipped:before {
    bottom: auto;
    top: 100%;
}
.p-confirm-popup.p-confirm-popup-flipped:after {
    border-bottom-color: transparent;
}
.p-confirm-popup.p-confirm-popup-flipped:before {
    border-bottom-color: transparent;
}
.p-confirm-popup .p-confirm-popup-content {
    display: flex;
    align-items: center;
}
`;G(J);O.render=$;const Q={components:{ConfirmPopup:O},data(){return{search:"",headers:[],children:[],alert_text:null,loading:!0}},computed:{header(){return this.headers=[{key:"id",title:this.$t("index")},{key:"name",title:this.$t("child_name")},{key:"birth_date",title:this.$t("birth_date")},{key:"actions",title:this.$t("actions")}]}},methods:{getChildren(){z.get("/api/child").then(e=>{this.children=e.data.children,console.log(e.data.children),this.loading=!1})},fomate(e){return T(e).format("DD-MM-yy ")},editItem(e){this.$router.push({name:"EditChildren",params:{id:e}})},deleteItem(e){console.log(e),z.delete(`/api/child/${e}/delete`).then(i=>{i.data.status==200&&(this.alert_text="children deleted successfully ",this.children=i.data.children)})},showItem(e){this.$router.push({name:"ShowChildren",params:{id:e}})},create(){this.$router.push({name:"CreateChildren"})}},async mounted(){this.$route.params.alert&&(this.alert_text="done "),this.getChildren()}};function X(e,i,d,u,n,t){const g=E("v-data-table");return a(),C("div",null,[n.alert_text!=null?(a(),b(D,{key:0,type:"success",variant:"tonal",border:"start",elevation:"2",closable:"","close-label":e.$t("close"),text:n.alert_text,class:"mb-8"},null,8,["close-label","text"])):L("",!0),s(N,{text:"Create",color:"green",height:"45",class:"mb-5 mt-5",onClick:t.create},{default:o(()=>[v(m(e.$t("create_button")),1)]),_:1},8,["onClick"]),s(Z,null,{default:o(()=>[s(U,null,{default:o(()=>[v(m(e.$t("children"))+" ",1),s(q),s(M,{modelValue:n.search,"onUpdate:modelValue":i[0]||(i[0]=r=>n.search=r),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1}),s(g,{headers:t.header,items:n.children,search:n.search},{top:o(()=>[n.loading?(a(),b(Y,{key:0,slot:"progress",style:{color:"#135c65"},indeterminate:""})):L("",!0)]),item:o(({item:r})=>[c("tr",null,[c("td",null,m(r.columns.id),1),c("td",null,m(r.columns.name),1),c("td",null,m(t.fomate(r.columns.birth_date)),1),c("td",null,[s(j,{small:"",color:"primary",class:"mr-2",onClick:y=>t.showItem(r.columns.id)},{default:o(()=>[v("mdi-eye")]),_:2},1032,["onClick"]),s(j,{small:"",color:"primary",class:"mr-2",onClick:y=>t.editItem(r.columns.id)},{default:o(()=>[v("mdi-pencil")]),_:2},1032,["onClick"]),s(j,{small:"",color:"error",onClick:y=>t.deleteItem(r.columns.id)},{default:o(()=>[v("mdi-delete")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items","search"])]),_:1})])}const te=P(Q,[["render",X]]);export{te as default};
