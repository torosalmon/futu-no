/*!
 * *****************************************************************************
 * [futu-no JavaScript]
 * @URL:     http://trs.mn/blog/futu-no/
 * @License: MIT License
 *
 * [sweet-scroll - v2.2.1]
 * @URL:     https://github.com/tsuyoshiwada/sweet-scroll
 * @author:  tsuyoshiwada
 * @License: MIT License
 * *****************************************************************************
!*/
var theme_color_control_1,header_control_1,drawer_control_1,search_form_control_1,share_control_1,html_support_1,$meta_theme_color_1=document.querySelectorAll('meta[name="theme-color"]'),$body_1=document.getElementsByTagName("body"),$header_1=document.getElementsByTagName("header"),$drawer_1=document.getElementsByClassName("drawer"),$drawer_button_1=document.getElementsByClassName("js-drawer-button"),$search_form_button_1=document.getElementsByClassName("js-search-form-button"),$share_button_1=document.getElementsByClassName("js-share-button"),header_change_trigger_y_1=160;document.addEventListener("DOMContentLoaded",function(){theme_color_control_1=new THEME_COLOR_CONTROL_1,header_control_1=new HEADER_CONTROL_1,drawer_control_1=new DRAWER_CONTROL_1,search_form_control_1=new SEARCH_FORM_CONTROL_1,share_control_1=new SHARE_CONTROL_1,(html_support_1=new HTML_SUPPORT_1).smooth_scroll(),null!=document.getElementsByTagName("video")[0]&&html_support_1.inline_playing_video(),window.addEventListener("scroll",header_control_1.change,{once:!1,passive:!0,capture:!0}),document.addEventListener("touchmove",header_control_1.change,{once:!1,passive:!0,capture:!0}),$drawer_button_1[0].addEventListener("click",drawer_control_1.change,{once:!1,passive:!1,capture:!1});for(e=0;e<$search_form_button_1.length;e+=1)$search_form_button_1[e].addEventListener("click",search_form_control_1.change,{once:!1,passive:!1,capture:!1});for(var e=0;e<$share_button_1.length;e+=1)$share_button_1[e].addEventListener("click",share_control_1.change,{once:!1,passive:!1,capture:!1})},{once:!0,passive:!1,capture:!0});var THEME_COLOR_CONTROL_1=function(){function e(){this.main_color=getComputedStyle($header_1[0]).borderTopColor,this.sub_color=getComputedStyle($drawer_1[0]).backgroundColor,this.current_color=this.main_color,$meta_theme_color_1[0].setAttribute("content",this.current_color)}return e.prototype.change=function(){$body_1[0].classList.contains("show-drawer")||$body_1[0].classList.contains("show-search-form")?($meta_theme_color_1[0].setAttribute("content",this.sub_color),$header_1[0].style.borderTopColor=this.sub_color,this.current_color=this.sub_color):($meta_theme_color_1[0].setAttribute("content",this.main_color),$header_1[0].style.borderTopColor=this.main_color,this.current_color=this.main_color)},e}(),HEADER_CONTROL_1=function(){function e(){this.change()}return e.prototype.change=function(){header_change_trigger_y_1<window.pageYOffset?$body_1[0].classList.add("show-scroll-header"):$body_1[0].classList.remove("show-scroll-header")},e}(),DRAWER_CONTROL_1=function(){function e(){}return e.prototype.change=function(){$body_1[0].classList.contains("show-drawer")?($body_1[0].classList.remove("show-drawer"),theme_color_control_1.change()):($body_1[0].classList.add("show-drawer"),$body_1[0].classList.remove("show-search-form"),theme_color_control_1.change())},e}(),SEARCH_FORM_CONTROL_1=function(){function e(){}return e.prototype.change=function(){$body_1[0].classList.contains("show-search-form")?($body_1[0].classList.remove("show-search-form"),theme_color_control_1.change()):($body_1[0].classList.add("show-search-form"),$body_1[0].classList.remove("show-drawer"),theme_color_control_1.change())},e}(),SHARE_CONTROL_1=function(){function e(){}return e.prototype.change=function(){$body_1[0].classList.contains("show-share-overlay")?($body_1[0].classList.remove("show-share-overlay"),share_control_1.background_scroll(!1)):($body_1[0].classList.add("show-share-overlay"),share_control_1.background_scroll(!0))},e.prototype.background_scroll=function(e){e?this.timer=setInterval(function(){window.pageYOffset===document.body.scrollHeight-window.innerHeight?window.scrollTo(0,0):window.scrollBy(0,1)},30):clearInterval(this.timer)},e}(),HTML_SUPPORT_1=function(){function e(){}return e.prototype.smooth_scroll=function(){new SweetScroll({trigger:".js-scroll",header:"header",duration:900,delay:0,easing:"easeOutExpo",offset:0,verticalScroll:!0,horizontalScroll:!1,stopScroll:!0,beforeScroll:null,afterScroll:null,cancelScroll:null})},e.prototype.inline_playing_video=function(){for(var e=document.getElementsByTagName("video"),o=0;o<e.length;o+=1)e[o].setAttribute("webkit-playsinline","webkit-playsinline")},e}();