!function(){"use strict";var e="nhapholocphat",t=sharebutton_is_horizontal,n=4;if(!window[e+"Loaded"]){window[e+"Loaded"]=!0;var o={left:"auto",right:"5px",top:"auto",bottom:"3px",width:"168px",height:"42px"},i={start:-42,end:0,step:3,delay:25,prop:"bottom"},r={fb:{name:"Facebook",url:"https://www.facebook.com/sharer/sharer.php?u=%URL",prim:!0},gp:{name:"Google+",url:"https://plus.google.com/share?url=%URL",prim:!0},tw:{name:"Twitter",url:"https://twitter.com/intent/tweet?text=%MESSAGE&url=%URL",prim:!0}},a=[],c=function(e){var t=new Date,n=setInterval(function(){var o=(new Date-t)/e.duration;o>1&&(o=1),e.step(o),1==o&&clearInterval(n)},e.delay||20);return{stop:function(){clearInterval(n)}}},l=function(){var e=this.children[0];e.animate&&e.animate.stop&&e.animate.stop();var t=parseInt(e.style.bottom||0);e.animate=c({duration:100,step:function(n){e.style.bottom=Math.floor(n*(10-t))+"px"}})},d=function(){var e=this.children[0];e.animate&&e.animate.stop&&e.animate.stop();var t=parseInt(e.style.bottom||0);e.animate=c({duration:100,step:function(n){e.style.bottom=Math.floor((1-n)*t)+"px"}})},u=function(){document.createElement("script");window.addEventListener("resize",L);var o=W("div");U(o,document.body);for(var i in r)if(r[i].prim){var c=W("span");I(c,{display:"inline-block"}),R(c,o);var l=W("span");a.push(l),l.moveWay=0,l.posX=0,I(l,{display:"inline-block",position:"relative",margin:"3px",width:"36px",height:"36px",background:"#fff",borderRadius:"18px"}),R(l,c);var d=W("a");I(d,{display:"inline-block",margin:"2px",padding:0,width:"32px",height:"32px",verticalAlign:"bottom",background:"url(img/"+i+".png?"+n+")",border:"none"}),d.className=e+i+"Link",d.title=r[i].name,R(d,l),r[i].plus?(d.href="javascript:;",C(d,"click",E)):r[i].newTab?(d.href=v(r[i].url,r[i]),d.setAttribute("rel","nofollow"),d.target="_blank"):(d.href="javascript:;",w(g(o,e+i+"Link"),r[i]))}I(o,{position:"fixed",margin:0,padding:0,outline:"none",border:"none",zIndex:999999999,overflow:"visible",direction:"ltr"}),t?p(o):showVert(o),window[e+"SetHoriz"]=function(){p(o)},window[e+"SetVert"]=function(){showVert(o)};try{}catch(u){}},s=function(e){for(var t,n=document.documentElement,o=0,i=0;(t=e[++o])>-1;){if(n=n.childNodes[t],!n)return null;i++}return n};window[e+"GetNode"]=s;var p=function(e){I(e,o),m(e,i);for(var t=0;t<e.children.length;t++)e.children[t].onmouseenter=l,e.children[t].onmouseleave=d},h=function(){var e=window,t=document,n=t.documentElement,o=t.getElementsByTagName("body")[0],i=e.innerWidth||n.clientWidth||o.clientWidth,r=e.innerHeight||n.clientHeight||o.clientHeight;return{width:i,height:r}},m=function(e,t){var n=t.start;!function o(){n+=t.step,t.end>t.start&&n>=t.end||t.end<t.start&&n<=t.end?n=t.end:setTimeout(o,t.delay),e.style[t.prop]=n+"px"}()},f=function(){document.removeEventListener("keydown",k);var t=S(e+"PopupWr");t.style.display="none"},w=function(e,t){C(e,"click",function(){var e=v(t.url,t);x(e,t.win)})},v=function(t,n){var o=t.replace(/%URL/,b()).replace(/%HOST/,location.host).replace(/%MESSAGE/,encodeURIComponent(document.title)).replace(/%WE/,e).replace(/%FUNC/,n.func||"");return o},g=function(e,t){return e.getElementsByClassName(t)[0]},y=function(){return location.href},b=function(){return encodeURIComponent(y())},x=function(e,t){t||(t={});var n=t.w||650,o=t.h||500,i=window.screenX+(window.outerWidth-n)/2,r=window.screenY+(window.outerHeight-o)/2,a="width="+n+",height="+o+",left="+i+",top="+r+",status=no,resizable=yes,toolbar=no,menubar=no,scrollbars=yes",c=window.open(e,"sharePopup"+Math.random(),a);return c},k=function(e){27===e.keyCode&&f()},E=function(){document.addEventListener("keydown",k);var t=S(e+"PopupWr");t.style.display="block",S(e+"PopupSearch").focus(),L()},L=function(){S(e+"PopupCell").style.height=h().height+"px"},S=function(e){return document.getElementById(e)},C=function(e,t,n){e.addEventListener(t,n,!1)},I=function(e,t){for(var n in t)e.style[n]=t[n]},W=function(e){return document.createElement(e)},R=function(e,t){t.appendChild(e)},U=function(e,t){t.children&&t.children.length?t.insertBefore(e,t.children[0]):t.appendChild(e)};"complete"===document.readyState?u():C(document,"DOMContentLoaded",u);try{clearStyles()}catch(H){}}}();