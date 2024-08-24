import{N}from"./Navbar-EUi9Axbk.js";import{r as h,o as n,a as r,d as s,h as I,v as S,p as $,g as y,n as w,t as m,F as M,i as A,b as v,j as V,f as _,c as D,k as B,l as g}from"./app-uG_z1Jlj.js";import{_ as b}from"./_plugin-vue_export-helper-DlAUqK2U.js";const x=t=>($("data-v-09037ae1"),t=t(),y(),t),L={class:"search-container mb-4"},U={class:"input-group"},q=x(()=>s("span",{class:"input-group-text"},[s("i",{class:"bx bx-search"})],-1)),T=["href"],z=x(()=>s("i",{class:"bx bx-plus"},null,-1)),P=[z],j={name:"SearchBar"},F=Object.assign(j,{emits:["update:modelValue"],setup(t,{emit:i}){const c=i,a=h(""),l=()=>{c("update:modelValue",a.value)};return(d,u)=>(n(),r("div",L,[s("div",U,[q,I(s("input",{type:"text",class:"form-control search-input",placeholder:"Pesquisar contato","onUpdate:modelValue":u[0]||(u[0]=o=>a.value=o),onInput:l},null,544),[[S,a.value]])]),s("a",{href:d.route("contact.create"),class:"btn btn-primary ms-2 btn-add-contact",type:"button"},P,8,T)]))}}),E=b(F,[["__scopeId","data-v-09037ae1"]]),H=t=>($("data-v-5be52336"),t=t(),y(),t),O=["data-contact-name"],Z={key:1,class:"contact-icon"},G=H(()=>s("i",{class:"bx bx-user"},null,-1)),J=[G],K={class:"card-body"},Q={class:"card-title"},R={class:"card-text"},W={__name:"ContactCard",props:{contactName:{type:String,default:""},contactDetails:{type:String,default:"Detalhes não preenchido"},contactId:{type:[Number,String],default:null}},setup(t){const i=t,c=()=>{i.contactId&&(window.location.href=`/contact/${i.contactId}`)};function a(o){return/[a-zA-Z]/.test(o)}function l(o){const e=o.split(" ");return e.length===1?e[0].charAt(0).toUpperCase():e[0].charAt(0).toUpperCase()+e[1].charAt(0).toUpperCase()}const d=h(document.body.getAttribute("data-bs-theme")==="dark"),u=o=>{let e=0;for(let f=0;f<o.length;f++)e=o.charCodeAt(f)+((e<<5)-e);const p=Math.abs(e)%360,C=d.value?20+Math.abs(e)%20:60+Math.abs(e)%20,k=d.value?30+Math.abs(e)%10:70+Math.abs(e)%20;return`hsl(${p}, ${C}%, ${k}%)`};return(o,e)=>(n(),r("div",{class:"card contact-card",onClick:c},[a(t.contactName)?(n(),r("div",{key:0,class:"contact-icon",style:w({backgroundColor:u(t.contactName)}),"data-contact-name":t.contactName},[s("span",null,m(l(t.contactName)),1)],12,O)):(n(),r("div",Z,J)),s("div",K,[s("h5",Q,m(t.contactName||"Nome não preenchido"),1),s("p",R,m(t.contactDetails||"Detalhes não preenchidos"),1)])]))}},X=b(W,[["__scopeId","data-v-5be52336"]]),Y={class:"row row-cols-1 row-cols-md-2 row-cols-lg-3"},tt={__name:"ContactList",props:{contacts:{type:Array,default:()=>[]}},setup(t){return(i,c)=>(n(),r("div",Y,[(n(!0),r(M,null,A(t.contacts,a=>(n(),r("div",{class:"col",key:a.id},[v(X,{contactName:a.name,contactDetails:a.email?a.email:a.phone,contactId:a.id},null,8,["contactName","contactDetails","contactId"])]))),128))]))}},et={props:{message:{type:String,required:!0},icon:{type:String,default:"bx bx-info-circle"}},data(){return{visible:!0}},mounted(){setTimeout(()=>{this.visible=!1},5e3)}},at={key:0,class:"notification mb-2"},st={class:"alert alert-info",role:"alert"};function ot(t,i,c,a,l,d){return l.visible?(n(),r("div",at,[s("div",st,[s("i",{class:V(c.icon)},null,2),s("span",null,m(c.message),1)])])):_("",!0)}const ct=b(et,[["render",ot],["__scopeId","data-v-06f223cf"]]),nt={class:"container"},it={key:1,class:"alert alert-info"},rt=s("h4",null,"Bem-vindo!",-1),lt=s("p",null,"Parece que você ainda não tem contatos cadastrados.",-1),dt=[rt,lt],ut={key:2,class:"alert alert-info"},_t=s("p",null,'Você pode adicionar novos contatos clicando no botão "Adicionar Contato" ao lado do campo de busca ou acessando o menu e selecionando "Criar Contato".',-1),ht=[_t],vt={__name:"Home",props:{contacts:Array,successMessage:String},setup(t){const i=t,c=h(""),a=D(()=>c.value?i.contacts.filter(o=>o.name.toLowerCase().includes(c.value.toLowerCase())||o.email.toLowerCase().includes(c.value.toLowerCase())):i.contacts),l=h(""),d=h("bx bx-info-circle");function u(o,e="bx bx-info-circle"){l.value=o,d.value=e,setTimeout(()=>{l.value=""},5e3)}return B(()=>{i.successMessage&&u(i.successMessage,"bx bx-check-circle")}),(o,e)=>(n(),r("div",nt,[v(N),v(E,{modelValue:c.value,"onUpdate:modelValue":e[0]||(e[0]=p=>c.value=p)},null,8,["modelValue"]),t.successMessage?(n(),g(ct,{key:0,message:l.value,icon:d.value},null,8,["message","icon"])):_("",!0),a.value.length===0?(n(),r("div",it,dt)):_("",!0),a.value.length===0?(n(),r("div",ut,ht)):_("",!0),a.value.length>0?(n(),g(tt,{key:3,contacts:a.value},null,8,["contacts"])):_("",!0)]))}};export{vt as default};