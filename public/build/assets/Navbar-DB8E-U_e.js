import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{o as l,a as _,d as a,k as b,e as v,t as h,r as u,z as p,A as g,l as m,B as x,b as n,F as k,p as y,g as N}from"./app-CzsdO3HD.js";const M={props:{href:{type:String,required:!0},icon:{type:String,required:!0},text:{type:String,required:!0}},computed:{iconClass(){return`bx ${this.icon}`}}},C={class:"nav-item"},S=["href"];function I(o,t,e,c,d,s){return l(),_("li",C,[a("a",{class:"nav-link",href:e.href},[a("i",{class:b(s.iconClass)},null,2),v(" "+h(e.text),1)],8,S)])}const r=f(M,[["render",I],["__scopeId","data-v-4a193b7d"]]),B={__name:"DarkModeToggle",setup(o){const t=u("bx-moon"),e=u("Modo Escuro");p(()=>{g(),c()});function c(){const s=document.body.classList.contains("dark-mode");t.value=s?"bx-sun":"bx-moon",e.value=s?"Modo Claro":"Modo Escuro"}function d(){x(),c()}return(s,P)=>(l(),m(r,{onClick:d,href:"#",text:e.value,icon:t.value},null,8,["text","icon"]))}},i=o=>(y("data-v-04572397"),o=o(),N(),o),D={class:"navbar bg-body-tertiary fixed-top"},$={class:"container"},L=i(()=>a("i",{class:"bx bx-arrow-back"},null,-1)),w=[L],T=["href"],q=i(()=>a("button",{class:"navbar-toggler",type:"button","data-bs-toggle":"offcanvas","data-bs-target":"#offcanvasNavbar","aria-controls":"offcanvasNavbar","aria-label":"Toggle navigation"},[a("span",{class:"navbar-toggler-icon"})],-1)),z={class:"offcanvas offcanvas-end",tabindex:"-1",id:"offcanvasNavbar","aria-labelledby":"offcanvasNavbarLabel"},E=i(()=>a("div",{class:"offcanvas-header"},[a("h5",{class:"offcanvas-title",id:"offcanvasNavbarLabel"},"Menu"),a("button",{type:"button",class:"btn-close","data-bs-dismiss":"offcanvas","aria-label":"Close"})],-1)),V={class:"offcanvas-body"},A={class:"navbar-nav"},F=i(()=>a("div",{class:"content-spacer"},null,-1)),H={__name:"Navbar",setup(o){function t(){window.history.back()}return(e,c)=>(l(),_(k,null,[a("nav",D,[a("div",$,[a("button",{class:"navbar-toggler d-md-none",type:"button",onClick:t},w),a("a",{class:"navbar-brand d-none d-md-block",href:e.route("home")},"AgendaSync",8,T),q,a("div",z,[E,a("div",V,[a("ul",A,[n(r,{href:e.route("home"),text:"Home",icon:"bx-home"},null,8,["href"]),n(r,{href:e.route("contact.create"),text:"Criar Contato",icon:"bx-folder-plus"},null,8,["href"]),n(r,{href:e.route("user.index"),text:"Perfil",icon:"bx-user"},null,8,["href"]),n(B),n(r,{href:e.route("user.logout"),text:"Sair | Logout",icon:"bx-log-out-circle"},null,8,["href"])])])])])]),F],64))}},G=f(H,[["__scopeId","data-v-04572397"]]);export{G as N};