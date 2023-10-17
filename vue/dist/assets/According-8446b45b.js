import{_ as n,C as a,o as d,e as l,h as t,t as e,r as p,Y as _,B as x}from"./main-0ea29110.js";const h={data(){return{isopen:!1,currentDate:new Date}},props:{name:String,age:Number,id:Number,report_date:String,report_text:String},methods:{},computed:{report_date_mod(){return this.report_date?a(this.report_date).format("DD/MM/YYYY"):"there is no reports"}}},g={class:"p-2 rounded mt-2 max-w-full min-w-min"},m={class:"bg-[#F8F8F8] shadow p-4 font-bold rounded flex justify-between"},u={class:"flex"},f=t("div",null,[t("svg",{class:"my-auto",width:"36px",height:"36px",fill:"#000000",version:"1.1",id:"Capa_1",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",viewBox:"0 0 424.239 424.239","xml:space":"preserve"},[t("g",{id:"SVGRepo_bgCarrier","stroke-width":"0"}),t("g",{id:"SVGRepo_tracerCarrier","stroke-linecap":"round","stroke-linejoin":"round"}),t("g",{id:"SVGRepo_iconCarrier"},[t("g",null,[t("circle",{cx:"129.287",cy:"261.896",r:"14.974"}),t("circle",{cx:"294.952",cy:"261.896",r:"14.974"}),t("path",{d:"M129.287,213.875c-8.179,0-15.869,3.185-21.653,8.969c-3.125,3.124-3.125,8.189,0,11.314c3.125,3.125,8.19,3.124,11.313,0 c2.762-2.762,6.434-4.283,10.34-4.283c3.906,0,7.578,1.521,10.34,4.283c1.562,1.562,3.609,2.344,5.657,2.343 c2.047,0,4.095-0.781,5.657-2.343c3.125-3.124,3.125-8.189,0-11.314C145.156,217.061,137.466,213.875,129.287,213.875z"}),t("path",{d:"M273.298,222.844c-3.125,3.124-3.125,8.189,0,11.314c3.124,3.125,8.189,3.124,11.313,0c5.701-5.702,14.979-5.701,20.68,0 c1.562,1.562,3.609,2.343,5.657,2.343s4.095-0.781,5.657-2.343c3.125-3.124,3.125-8.189,0-11.314 C304.667,210.906,285.239,210.905,273.298,222.844z"}),t("path",{d:"M227.527,325.475c-4.116,4.115-9.587,6.382-15.408,6.382c-5.82,0-11.292-2.266-15.407-6.382 c-3.124-3.124-8.189-3.124-11.313,0c-3.125,3.124-3.125,8.189,0,11.314c7.137,7.138,16.627,11.068,26.721,11.068 c10.094,0,19.584-3.931,26.721-11.068c3.125-3.124,3.125-8.189,0-11.314C235.716,322.351,230.651,322.351,227.527,325.475z"}),t("path",{d:"M400.881,254.178c0-21.731-15.71-39.851-36.366-43.63V76.715c0-17.362-8.637-33.458-23.104-43.057 c-13.588-9.015-30.458-11.061-45.711-5.686l-50.226-17.048C206.88-2.177,166.255-3.521,127.992,7.036 C77.9,20.857,49.182,50.083,44.749,91.627c-3.923,5.174-7.04,10.985-9.158,17.255l-3.896,11.531 c-2.091,6.191,0.214,12.697,5.738,16.189c5.522,3.492,12.389,2.786,17.086-1.759c1.604-1.553,3.358-2.861,5.204-3.955v79.661 c-20.656,3.779-36.366,21.898-36.366,43.63c0,22.601,16.991,41.296,38.868,44.014c5.494,30.336,19.931,58.319,42.006,80.712 c28.821,29.236,67.135,45.336,107.888,45.336c0.005,0,0.01,0,0.015,0c40.701-0.004,78.965-15.856,107.745-44.635 c22.481-22.481,37.073-50.749,42.386-81.445C384.02,295.329,400.881,276.691,400.881,254.178z M332.565,46.991 c10.137,6.725,15.95,17.559,15.95,29.724v104.689c-24.831-3.859-43.897-25.383-43.897-51.279l-0.662-87.96 C313.725,39.59,323.912,41.25,332.565,46.991z M49.195,118.604l1.555-4.601c4.073-12.055,13.118-21.842,24.815-26.85 c11.696-5.008,25.021-4.8,36.556,0.573c24.226,11.283,53.513,5.183,71.219-14.833l1.982-2.241 c2.928-3.309,2.618-8.365-0.691-11.292c-3.311-2.927-8.366-2.618-11.293,0.691l-1.982,2.241 c-13.048,14.75-34.629,19.244-52.48,10.93c-15.653-7.291-33.736-7.574-49.609-0.777c-1.445,0.619-2.85,1.31-4.233,2.033 c9.299-24.791,31.805-42.249,67.215-52.019c35.161-9.702,72.535-8.451,108.084,3.615l47.623,16.165l0.624,41.337 c-21.205,28.831-52.131,48.348-87.373,55.059c-36.086,6.871-72.901-0.4-103.663-20.474 C82.512,108.354,63.562,108.773,49.195,118.604z M39.357,254.178c0-12.863,8.609-23.747,20.366-27.21v43.362 c0,3.746,0.135,7.471,0.398,11.172C48.162,278.169,39.357,267.186,39.357,254.178z M308.566,368.29 c-25.758,25.758-60.005,39.945-96.433,39.949c-0.006,0-0.007,0-0.014,0c-36.433,0-70.705-14.409-96.494-40.568 c-25.731-26.102-39.902-60.672-39.902-97.342V127.116c4.531,0.338,9.027,1.804,13.075,4.445 c34.246,22.347,75.228,30.442,115.4,22.792c32.609-6.21,61.903-22.263,84.419-45.938v21.709c0,34.731,26.217,63.437,59.897,67.41 v74.308C348.515,308.276,334.328,342.529,308.566,368.29z M364.206,281.476c0.198-3.194,0.309-6.405,0.309-9.633v-44.875 c11.757,3.463,20.366,14.347,20.366,27.21C384.881,267.153,376.121,278.114,364.206,281.476z"})])])])],-1),v={class:""},w={class:"text-xs text-right p-2 font-medium"},C={class:"text-xs text-[#148A98] text-left rtl:text-right"},k=x('<svg class="mx-auto" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="none" stroke="#148A98" stroke-width="2" d="M9,4 L4,9 L9,14 M18,19 L18,9 L5,9" transform="matrix(1 0 0 -1 0 23)"></path></g></svg><p class="text-xs text-[#148A98]">متابعة التفاصيل</p>',2),M=[k],S={class:"flex justify-center items-center space-x-3"},b={class:"text-center"},z=t("p",{class:"text-center text-[#148A98]"},"تقرير بتاريخ",-1),V={class:"flex justify-center items-center space-x-3 mt-6"},y=t("p",{class:"text-center text-[#148A98]"},"التقرير",-1);function A(o,r,c,B,s,i){return d(),l("div",g,[t("div",m,[t("div",u,[f,t("div",v,[t("p",w,e(c.name),1),t("p",C," العمر : "+e(c.age)+" شهر ",1)])]),t("button",{onClick:r[0]||(r[0]=G=>s.isopen=!s.isopen)},M)]),t("div",{class:_(["mt-4 border-2 p-2 rounded text-right",s.isopen?"d-block":"hidden"])},[t("div",S,[t("p",b,e(i.report_date_mod),1),z]),t("div",V,[t("p",null,e(c.report_text??"there is no reports"),1),y]),p(o.$slots,"default")],2)])}const j=n(h,[["render",A]]);export{j as A};
