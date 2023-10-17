import{aP as E,s as A,Z as m,I as s,K as O,j as z,k as g,Q as S,o as a,f as d,x as f,q as h,T as H,w as B,e as v,m as r,r as b,g as y,p as C,h as u,t as F,Y as k}from"./main-0ea29110.js";import{F as K}from"./focustrap.esm-4bbdf7e1.js";import{O as R}from"./overlayeventbus.esm-94e7e145.js";import{s as P}from"./portal.esm-e0ec2510.js";var p=E(),I={name:"ConfirmPopup",extends:A,inheritAttrs:!1,props:{group:String},data(){return{visible:!1,confirmation:null,autoFocusAccept:null,autoFocusReject:null}},target:null,outsideClickListener:null,scrollHandler:null,resizeListener:null,container:null,confirmListener:null,closeListener:null,mounted(){this.confirmListener=e=>{e&&e.group===this.group&&(this.confirmation=e,this.target=e.target,this.confirmation.onShow&&this.confirmation.onShow(),this.visible=!0)},this.closeListener=()=>{this.visible=!1,this.confirmation=null},p.on("confirm",this.confirmListener),p.on("close",this.closeListener)},beforeUnmount(){p.off("confirm",this.confirmListener),p.off("close",this.closeListener),this.unbindOutsideClickListener(),this.scrollHandler&&(this.scrollHandler.destroy(),this.scrollHandler=null),this.unbindResizeListener(),this.container&&(m.clear(this.container),this.container=null),this.target=null,this.confirmation=null},methods:{accept(){this.confirmation.accept&&this.confirmation.accept(),this.visible=!1},reject(){this.confirmation.reject&&this.confirmation.reject(),this.visible=!1},onHide(){this.confirmation.onHide&&this.confirmation.onHide(),this.visible=!1},onAcceptKeydown(e){(e.code==="Space"||e.code==="Enter")&&(this.accept(),s.focus(this.target),e.preventDefault())},onRejectKeydown(e){(e.code==="Space"||e.code==="Enter")&&(this.reject(),s.focus(this.target),e.preventDefault())},onEnter(e){this.autoFocusAccept=this.confirmation.defaultFocus===void 0||this.confirmation.defaultFocus==="accept",this.autoFocusReject=this.confirmation.defaultFocus==="reject",this.bindOutsideClickListener(),this.bindScrollListener(),this.bindResizeListener(),m.set("overlay",e,this.$primevue.config.zIndex.overlay)},onAfterEnter(){this.focus()},onLeave(){this.autoFocusAccept=null,this.autoFocusReject=null,this.unbindOutsideClickListener(),this.unbindScrollListener(),this.unbindResizeListener()},onAfterLeave(e){m.clear(e)},alignOverlay(){s.absolutePosition(this.container,this.target);const e=s.getOffset(this.container),n=s.getOffset(this.target);let l=0;e.left<n.left&&(l=n.left-e.left),this.container.style.setProperty("--overlayArrowLeft",`${l}px`),e.top<n.top&&s.addClass(this.container,"p-confirm-popup-flipped")},bindOutsideClickListener(){this.outsideClickListener||(this.outsideClickListener=e=>{this.visible&&this.container&&!this.container.contains(e.target)&&!this.isTargetClicked(e)?(this.confirmation.onHide&&this.confirmation.onHide(),this.visible=!1):this.alignOverlay()},document.addEventListener("click",this.outsideClickListener))},unbindOutsideClickListener(){this.outsideClickListener&&(document.removeEventListener("click",this.outsideClickListener),this.outsideClickListener=null)},bindScrollListener(){this.scrollHandler||(this.scrollHandler=new O(this.target,()=>{this.visible&&(this.visible=!1)})),this.scrollHandler.bindScrollListener()},unbindScrollListener(){this.scrollHandler&&this.scrollHandler.unbindScrollListener()},bindResizeListener(){this.resizeListener||(this.resizeListener=()=>{this.visible&&!s.isTouchDevice()&&(this.visible=!1)},window.addEventListener("resize",this.resizeListener))},unbindResizeListener(){this.resizeListener&&(window.removeEventListener("resize",this.resizeListener),this.resizeListener=null)},focus(){let e=this.container.querySelector("[autofocus]");e&&e.focus({preventScroll:!0})},isTargetClicked(e){return this.target&&(this.target===e.target||this.target.contains(e.target))},containerRef(e){this.container=e},onOverlayClick(e){R.emit("overlay-click",{originalEvent:e,target:this.target})},onOverlayKeydown(e){e.code==="Escape"&&(p.emit("close",this.closeListener),s.focus(this.target))}},computed:{containerClass(){return["p-confirm-popup p-component",{"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1}]},message(){return this.confirmation?this.confirmation.message:null},iconClass(){return["p-confirm-popup-icon",this.confirmation?this.confirmation.icon:null]},acceptLabel(){return this.confirmation?this.confirmation.acceptLabel||this.$primevue.config.locale.accept:null},rejectLabel(){return this.confirmation?this.confirmation.rejectLabel||this.$primevue.config.locale.reject:null},acceptIcon(){return this.confirmation?this.confirmation.acceptIcon:null},rejectIcon(){return this.confirmation?this.confirmation.rejectIcon:null},acceptClass(){return["p-confirm-popup-accept p-button-sm",this.confirmation?this.confirmation.acceptClass:null]},rejectClass(){return["p-confirm-popup-reject p-button-sm",this.confirmation?this.confirmation.rejectClass||"p-button-text":null]}},components:{CPButton:z,Portal:P},directives:{focustrap:K}};const T=["aria-modal"];function D(e,n,l,c,i,t){const L=g("CPButton"),j=g("Portal"),w=S("focustrap");return a(),d(j,null,{default:f(()=>[h(H,{name:"p-confirm-popup",onEnter:t.onEnter,onAfterEnter:t.onAfterEnter,onLeave:t.onLeave,onAfterLeave:t.onAfterLeave},{default:f(()=>[i.visible?B((a(),v("div",r({key:0,ref:t.containerRef,role:"alertdialog",class:t.containerClass,"aria-modal":i.visible,onClick:n[2]||(n[2]=(...o)=>t.onOverlayClick&&t.onOverlayClick(...o)),onKeydown:n[3]||(n[3]=(...o)=>t.onOverlayKeydown&&t.onOverlayKeydown(...o))},{...e.$attrs,...e.ptm("root")}),[e.$slots.message?(a(),d(y(e.$slots.message),{key:1,message:i.confirmation},null,8,["message"])):(a(),v("div",r({key:0,class:"p-confirm-popup-content"},e.ptm("content")),[b(e.$slots,"icon",{class:"p-confirm-popup-icon"},()=>[e.$slots.icon?(a(),d(y(e.$slots.icon),{key:0,class:"p-confirm-popup-icon"})):i.confirmation.icon?(a(),v("span",r({key:1,class:t.iconClass},e.ptm("icon")),null,16)):C("",!0)]),u("span",r({class:"p-confirm-popup-message"},e.ptm("message")),F(i.confirmation.message),17)],16)),u("div",r({class:"p-confirm-popup-footer"},e.ptm("footer")),[h(L,{label:t.rejectLabel,class:k(t.rejectClass),onClick:n[0]||(n[0]=o=>t.reject()),onKeydown:t.onRejectKeydown,autofocus:i.autoFocusReject,pt:e.ptm("rejectButton")},{icon:f(o=>[b(e.$slots,"rejecticon",{},()=>[u("span",r({class:[t.rejectIcon,o.class]},e.ptm("rejectButton").icon),null,16)])]),_:3},8,["label","class","onKeydown","autofocus","pt"]),h(L,{label:t.acceptLabel,class:k(t.acceptClass),onClick:n[1]||(n[1]=o=>t.accept()),onKeydown:t.onAcceptKeydown,autofocus:i.autoFocusAccept,pt:e.ptm("acceptButton")},{icon:f(o=>[b(e.$slots,"accepticon",{},()=>[u("span",r({class:[t.acceptIcon,o.class]},e.ptm("acceptButton").icon),null,16)])]),_:3},8,["label","class","onKeydown","autofocus","pt"])],16)],16,T)),[[w]]):C("",!0)]),_:3},8,["onEnter","onAfterEnter","onLeave","onAfterLeave"])]),_:3})}function N(e,n){n===void 0&&(n={});var l=n.insertAt;if(!(!e||typeof document>"u")){var c=document.head||document.getElementsByTagName("head")[0],i=document.createElement("style");i.type="text/css",l==="top"&&c.firstChild?c.insertBefore(i,c.firstChild):c.appendChild(i),i.styleSheet?i.styleSheet.cssText=e:i.appendChild(document.createTextNode(e))}}var V=`
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
`;N(V);I.render=D;export{I as s};
