<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}" >
  <title>MAB Analytics | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/theme/mab/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/theme/mab/dist/css/mab-custom.css')}}" />
  <style type="text/css">
      /*!
 * fullPage 3.0.7
 * https://github.com/alvarotrigo/fullPage.js
 *
 * @license GPLv3 for open source use only
 * or Fullpage Commercial License for commercial use
 * http://alvarotrigo.com/fullPage/pricing/
 *
 * Copyright (C) 2018 http://alvarotrigo.com/fullPage - A project by Alvaro Trigo
 */
html.fp-enabled,
.fp-enabled body {
    margin: 0;
    padding: 0;
    overflow:hidden;

    /*Avoid flicker on slides transitions for mobile phones #336 */
    -webkit-tap-highlight-color: rgba(0,0,0,0);
}
.fp-section {
    position: relative;
    -webkit-box-sizing: border-box; /* Safari<=5 Android<=3 */
    -moz-box-sizing: border-box; /* <=28 */
    box-sizing: border-box;
}
.fp-slide {
    float: left;
}
.fp-slide, .fp-slidesContainer {
    height: 100%;
    display: block;
}
.fp-slides {
    z-index:1;
    height: 100%;
    overflow: hidden;
    position: relative;
    -webkit-transition: all 0.3s ease-out; /* Safari<=6 Android<=4.3 */
    transition: all 0.3s ease-out;
}
.fp-section.fp-table, .fp-slide.fp-table {
    display: table;
    table-layout:fixed;
    width: 100%;
}
.fp-tableCell {
    display: table-cell;
    vertical-align: middle;
    width: 100%;
    height: 100%;
}
.fp-slidesContainer {
    float: left;
    position: relative;
}
.fp-controlArrow {
    -webkit-user-select: none; /* webkit (safari, chrome) browsers */
    -moz-user-select: none; /* mozilla browsers */
    -khtml-user-select: none; /* webkit (konqueror) browsers */
    -ms-user-select: none; /* IE10+ */
    position: absolute;
    z-index: 4;
    top: 50%;
    cursor: pointer;
    width: 0;
    height: 0;
    border-style: solid;
    margin-top: -38px;
    -webkit-transform: translate3d(0,0,0);
    -ms-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}
.fp-controlArrow.fp-prev {
    left: 15px;
    width: 0;
    border-width: 38.5px 34px 38.5px 0;
    border-color: transparent #fff transparent transparent;
}
.fp-controlArrow.fp-next {
    right: 15px;
    border-width: 38.5px 0 38.5px 34px;
    border-color: transparent transparent transparent #fff;
}
.fp-scrollable {
    overflow: hidden;
    position: relative;
}
.fp-scroller{
    overflow: hidden;
}
.iScrollIndicator{
    border: 0 !important;
}
.fp-notransition {
    -webkit-transition: none !important;
    transition: none !important;
}
#fp-nav {
    position: fixed;
    z-index: 100;
    margin-top: -32px;
    top: 50%;
    opacity: 1;
    -webkit-transform: translate3d(0,0,0);
}
#fp-nav.fp-right {
    right: 17px;
}
#fp-nav.fp-left {
    left: 17px;
}
.fp-slidesNav{
    position: absolute;
    z-index: 4;
    opacity: 1;
    -webkit-transform: translate3d(0,0,0);
    -ms-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
    left: 0 !important;
    right: 0;
    margin: 0 auto !important;
}
.fp-slidesNav.fp-bottom {
    bottom: 17px;
}
.fp-slidesNav.fp-top {
    top: 17px;
}
#fp-nav ul,
.fp-slidesNav ul {
  margin: 0;
  padding: 0;
}
#fp-nav ul li,
.fp-slidesNav ul li {
    display: block;
    width: 14px;
    height: 13px;
    margin: 7px;
    position:relative;
}
.fp-slidesNav ul li {
    display: inline-block;
}
#fp-nav ul li a,
.fp-slidesNav ul li a {
    display: block;
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    cursor: pointer;
    text-decoration: none;
}
#fp-nav ul li a.active span,
.fp-slidesNav ul li a.active span,
#fp-nav ul li:hover a.active span,
.fp-slidesNav ul li:hover a.active span{
    height: 12px;
    width: 12px;
    margin: -6px 0 0 -6px;
    border-radius: 100%;
 }
#fp-nav ul li a span,
.fp-slidesNav ul li a span {
    border-radius: 50%;
    position: absolute;
    z-index: 1;
    height: 4px;
    width: 4px;
    border: 0;
    background: #333;
    left: 50%;
    top: 50%;
    margin: -2px 0 0 -2px;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -o-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
}
#fp-nav ul li:hover a span,
.fp-slidesNav ul li:hover a span{
    width: 10px;
    height: 10px;
    margin: -5px 0px 0px -5px;
}
#fp-nav ul li .fp-tooltip {
    position: absolute;
    top: -2px;
    color: #fff;
    font-size: 14px;
    font-family: arial, helvetica, sans-serif;
    white-space: nowrap;
    max-width: 220px;
    overflow: hidden;
    display: block;
    opacity: 0;
    width: 0;
    cursor: pointer;
}
#fp-nav ul li:hover .fp-tooltip,
#fp-nav.fp-show-active a.active + .fp-tooltip {
    -webkit-transition: opacity 0.2s ease-in;
    transition: opacity 0.2s ease-in;
    width: auto;
    opacity: 1;
}
#fp-nav ul li .fp-tooltip.fp-right {
    right: 20px;
}
#fp-nav ul li .fp-tooltip.fp-left {
    left: 20px;
}
.fp-auto-height.fp-section,
.fp-auto-height .fp-slide,
.fp-auto-height .fp-tableCell{
    height: auto !important;
}

.fp-responsive .fp-auto-height-responsive.fp-section,
.fp-responsive .fp-auto-height-responsive .fp-slide,
.fp-responsive .fp-auto-height-responsive .fp-tableCell {
    height: auto !important;
}

/*Only display content to screen readers*/
.fp-sr-only{
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
.fixed_bar {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 9999;
    padding: 30px 50px 0 50px;
    background-image: linear-gradient(to top, rgba(255, 255, 255, 0) 4%, rgba(255, 255, 255, 1) 100%)
}
@media only screen and (max-width: 1400px) {
    .logo img {
        width: 100px;
    }
}
@media only screen and (max-width: 767px) {
   .card{
       top: 0px !important;
   } 
}
@media only screen and (max-width: 540px) {
   .card{
       top: 0px !important;
   }
   .logo img{
       width: 100px !important;
   }
}

.containerbg{
    background-size: 60% !important;
}
@media only screen and (max-width: 767px) {
    .containerbg{
        background-size: 50% !important;
    }   
}

.card{
    position:absolute;
    left:50%;
    top:50%;
    transform: translate(-50%,-50%);
    box-shadow: 0px 0px 0px 0px !important;
}


.logo img {
    width: 150px;
}
p.mb-1{
    text-align: left;
    padding-top: 10px;
}
.card .btn-primary{
    margin-top: 10px;
}
  </style>
</head>
<body class="fp-responsive fp-viewing-firstPage" style="background: #fff;">
    <section class="outer_section">
        <header class="fixed_bar">
            <div class="row">
                <div class="col-xs-5">
                    <a href="" class="logo">
                       
                    </a>
                </div>
                <div class="col-xs-7 right_menu">
                    
                </div>
            </div>
        </header>
        <div id="fullpage" class="fullpage-wrapper" style="height: 100vh">
            <div class="container-fluid">
            <div class="row containerbg" style="background-image: url({{asset('theme/mab/dist/img/grafity.png')}});background-position: 0% 100%;background-repeat: no-repeat;height: 100vh;background-size:100%">
                <!-- <div class="col-md-6 fullpagebg"  style="background-image: url({{asset('theme/mab/dist/img/lotus-sprite-compressed.png')}});background-position: 780px -175px"></div> -->
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
            </div>
            
        </div>
    </section>
    

<!-- jQuery -->
<script src="{{asset('/theme/mab/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/theme/mab/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/theme/mab/dist/js/adminlte.min.js')}}"></script>
<script>
    var length = 780;
    var inc = 1560
    
    imageanimate = setInterval(function(){
        length += 3080;
        if(length>23870){
            clearInterval(imageanimate);        
        }else{
            $('.fullpagebg').css("background-position", length+"px -175px");
        }
        
    }, 100);
    $(document).ready(function(){
        if(screen.width < 400){
            //$('div.card').css("margin-left", "0px").css("left", "0px").css('transform', 'translate(-50%,-85%)');
        }
    })    
</script>
</body>
</html>
