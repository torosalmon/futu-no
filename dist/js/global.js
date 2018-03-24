/*!
 * *****************************************************************************
 * [futu-no JavaScript] - http://trs.mn/blog/futu-no/
 * @Author:  trs
 * @License: MIT License
 *
 * [sweet-scroll] v3.0.0 - https://github.com/tsuyoshiwada/sweet-scroll
 * @Author:  tsuyoshiwada
 * @License: MIT License
 * *****************************************************************************
!*/
var header_change_trigger_y_1=160,ux_1,theme_color_1,header_1,search_form_1,drawer_1,share_1,$meta_theme_color_1=document.querySelectorAll('meta[name="theme-color"]'),$body_1=document.getElementsByTagName("body"),$header_1=document.getElementsByClassName("js--header"),$search_form_button_1=document.getElementsByClassName("js--search-form-button"),$drawer_button_1=document.getElementsByClassName("js--drawer-button"),$share_button_1=document.getElementsByClassName("js--share-button"),$overlay_1=document.getElementsByClassName("js--overlay");document.addEventListener("DOMContentLoaded",function(){ux_1=new UX_1,theme_color_1=new THEME_COLOR_1,header_1=new HEADER_1,search_form_1=new SEARCH_FORM_1,drawer_1=new DRAWER_1,share_1=new SHARE_1},{once:!0,passive:!1,capture:!0});var UX_1=function(){function e(){null!=document.getElementsByClassName("js--scroll")[0]&&this.smooth_scroll()}return e.prototype.smooth_scroll=function(){new SweetScroll({trigger:".js--scroll",header:".js--header",duration:900,delay:0,easing:"easeOutExpo",offset:0,verticalScroll:!0,horizontalScroll:!1,stopScroll:!0,beforeScroll:null,afterScroll:null,cancelScroll:null})},e}(),THEME_COLOR_1=function(){function e(){this.main_color=getComputedStyle($body_1[0]).borderTopColor,this.sub_color=getComputedStyle($body_1[0]).borderBottomColor,this.current_color=this.main_color,$meta_theme_color_1[0].setAttribute("content",this.current_color)}return e.prototype.change=function(){var e=$header_1;$body_1[0].classList.contains("state--show-drawer")||$body_1[0].classList.contains("state--show-search-form")?($meta_theme_color_1[0].setAttribute("content",this.sub_color),e[0].style.borderTopColor=this.sub_color,this.current_color=this.sub_color):($meta_theme_color_1[0].setAttribute("content",this.main_color),e[0].style.borderTopColor=this.main_color,this.current_color=this.main_color)},e}(),HEADER_1=function(){function e(){window.addEventListener("scroll",this.change,{once:!1,passive:!0,capture:!0}),document.addEventListener("touchmove",this.change,{once:!1,passive:!0,capture:!0})}return e.prototype.change=function(){header_change_trigger_y_1<window.pageYOffset?$body_1[0].classList.add("state--show-scroll-header"):$body_1[0].classList.remove("state--show-scroll-header")},e}(),SEARCH_FORM_1=function(){function e(){for(var e=0;e<$search_form_button_1.length;e+=1)$search_form_button_1[e].addEventListener("click",this.change,{once:!1,passive:!1,capture:!1})}return e.prototype.change=function(){$body_1[0].classList.contains("state--show-search-form")?$body_1[0].classList.remove("state--show-search-form"):($body_1[0].classList.contains("state--show-drawer")&&($body_1[0].classList.remove("state--show-drawer"),$body_1[0].classList.remove("state--show-overlay"),$overlay_1[0].removeEventListener("click",drawer_1.change,!1)),$body_1[0].classList.contains("state--show-share")&&($body_1[0].classList.remove("state--show-share"),$body_1[0].classList.remove("state--show-overlay"),$overlay_1[0].removeEventListener("click",share_1.change,!1),share_1.background_scroll(!1)),$body_1[0].classList.add("state--show-search-form")),theme_color_1.change()},e}(),DRAWER_1=function(){function e(){for(var e=0;e<$drawer_button_1.length;e+=1)$drawer_button_1[e].addEventListener("click",this.change,{once:!1,passive:!1,capture:!1})}return e.prototype.change=function(){$body_1[0].classList.contains("state--show-drawer")?($body_1[0].classList.remove("state--show-drawer"),$body_1[0].classList.remove("state--show-overlay"),$overlay_1[0].removeEventListener("click",drawer_1.change,!1)):($body_1[0].classList.contains("state--show-share")&&($body_1[0].classList.remove("state--show-share"),$overlay_1[0].removeEventListener("click",share_1.change,!1),share_1.background_scroll(!1)),$body_1[0].classList.add("state--show-drawer"),$body_1[0].classList.add("state--show-overlay"),$overlay_1[0].addEventListener("click",drawer_1.change,{once:!0,passive:!1,capture:!1})),theme_color_1.change()},e}(),SHARE_1=function(){function e(){for(var e=0;e<$share_button_1.length;e+=1)$share_button_1[e].addEventListener("click",this.change,{once:!1,passive:!1,capture:!1})}return e.prototype.change=function(){$body_1[0].classList.contains("state--show-share")?($body_1[0].classList.remove("state--show-share"),$body_1[0].classList.remove("state--show-overlay"),$overlay_1[0].removeEventListener("click",drawer_1.change,!1),share_1.background_scroll(!1)):($body_1[0].classList.contains("state--show-drawer")&&($body_1[0].classList.remove("state--show-drawer"),$overlay_1[0].removeEventListener("click",drawer_1.change,!1)),$body_1[0].classList.add("state--show-share"),$body_1[0].classList.add("state--show-overlay"),$overlay_1[0].addEventListener("click",share_1.change,{once:!0,passive:!1,capture:!1}),share_1.background_scroll(!0))},e.prototype.background_scroll=function(e){e?this.timer=setInterval(function(){window.pageYOffset===document.body.scrollHeight-window.innerHeight?window.scrollTo(0,0):window.scrollBy(0,1)},30):clearInterval(this.timer)},e}();