<?php
header ("Content-Type:text/css");
$color = "#ff0000"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#" . $_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#ff0000";
}

?>

::-moz-selection,::selection,#newslater-popup button.mfp-close:hover, #newslater-popup button.mfp-close:focus,.btn-sidebar-menu-dropdown,
.search-box button.search-btn:hover,.header-right-link > ul > li > .header_search_toggle.desktop-view .search-btn:hover,
.product-slider .owl-prev:hover, .product-slider .owl-next:hover, #brand-logo .owl-prev:hover, #brand-logo .owl-next:hover,
.blog-item .blog-media .date,
{
    background-color: <?php echo $color; ?>;
}


a:hover,h2.main_title,#newslater-popup  button.mfp-close,.mobilemenu-content li:hover a,.cart-dropdown ul li a:hover,.header-link-dropdown .dropdown-title,
.account-link-dropdown a:hover, .account-link-dropdown a.active,.megamenu .level2 > a,.megamenu .sub-menu-level2 li.level3 > a:hover,
.banner-detail .banner-detail-inner .banner-title,.bread-crumb ul li a:hover,.bread-crumb ul li span,.category-bar ul li a.selected,
.price-box .price,.rating-summary-block .rating-result > span::before,.ser-feature-block .feature-box:hover .ser-title,.newsletter-inner .main_title,
.post-date,.sidebar-title h3,.listing-box ul li a:hover,.sidebar-item .cart-link button:hover,.nav-tabs > li > a.selected, .nav-tabs > li > a.selected:hover, .nav-tabs > li > a.selected:focus,
.comment-detail .user-name,.commun-table .table tbody tr td i.cart-remove-item,.checkout-step ul li,.checkout-step ul li span,
.checkout-step ul li.active,.new-account .link:hover,.footer a:hover,.footer-static-block li i.fa,.footer-static-block li a:hover span,
.payment ul li a:hover
{
    color: <?php echo $color; ?> !important;
}

.btn-black:hover,.btn-color,.btn-white:hover,.header-bottom,.header-right-link ul li.cart-icon > a span small.cart-notification,
.heading-part h2.main_title:after,.new-label,.product-item.sold-out::after,.sidebar-title h3:after,.checkout-step ul li .step .circle,
.checkout-step ul li .step .line,.checkout-step ul li.active .step .circle, .checkout-step ul li.active .step .line,
.account-sidebar ul li.active a, .account-sidebar ul li:hover a,.scroll-top #scrollup,.review_score
{
    background: <?php echo $color; ?>;
}

.header-top {
    border-top: 5px solid <?php echo $color; ?>;
}
.header-link-dropdown {
    border-top: 3px solid <?php echo $color; ?>;
}

.main-banner .owl-pagination .owl-page.active > span, .owl-pagination .owl-page:hover > span,.owl-pagination .owl-page.active > span, .owl-pagination .owl-page:hover > span {
    background: <?php echo $color; ?>;
    -moz-box-shadow: 0 0 0px 2px <?php echo $color; ?>;
    -webkit-box-shadow: 0 0 0px 2px <?php echo $color; ?>;
    box-shadow: 0 0 0px 2px <?php echo $color; ?>;
}

.account-sidebar ul li.active a::after, .account-sidebar ul li:hover a::after {
    border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $color; ?>;
}

ul.tagcloud li a:hover {
    border-color: <?php echo $color; ?>;
}

.half-row .half-div.color {
    background-color: <?php echo $color; ?>;
}
.timer-panel:hover .timer-panel-inner{
	background:<?php echo $color; ?>;
}
.form-subscribe.alt .btn-submit {
  background-color:<?php echo $color; ?>;
}

.checkout-step li.active + li .circle, .checkout-step li.active + li + li .circle, .checkout-step li.active + li + li + li .circle, .checkout-step li.active + li .line, .checkout-step li.active + li + li .line, .checkout-step li.active + li + li + li .line{
background: #222;
}
.checkout-step li.active + li span, .checkout-step li.active + li + li span, .checkout-step li.active + li + li + li span{
color: #222 !important;
}
