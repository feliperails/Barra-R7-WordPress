<?php
/**
* Plugin Name: Barra R7
* Description: Adiciona barra do portal R7 ao site
* Author: Bruno Borges <brbsilva@sp.r7.com>
* Author URI: www
* Version: 0.1
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
include_once "admin_config.php";

if (is_admin()) {
    return;
}

function is_from_r7() {
    $referer = $_SERVER['HTTP_REFERER'];
    if ( strpos($referer, 'r7.com') !== false ) {
        return true;
    }
    return false;
}

function footer_r7() {
    $label_partner = get_option('label_partner');
    $background_color = get_option('background_color');
    $js_detect = get_option('js_detect');

    if($js_detect): ?>
        <script>
            if(document.referrer && -1 != document.referrer.indexOf('r7.com')) {
                document.write('<script id="r7-footer-portal" src="http://barra.r7.com/footer/footer-portal/footer-portal.js" charset="UTF-8">\
                        {showPane:false, bgC:"<?php echo $background_color;?>", isPartner: "true", partnerLabel:"<?php echo $label_partner;?>"}\
                    <\/script>');
            }
        </script>
    <?php else: ?>
        <script id="r7-footer-portal" src="http://barra.r7.com/footer/footer-portal/footer-portal.js" charset="UTF-8">
            {showPane:false, bgC:"<?php echo $background_color;?>", isPartner: "true", partnerLabel:"<?php echo $label_partner;?>"}
        </script>
    <?php endif;
}

function header_r7() {
    $sub_menu = get_option('sub_menu');
    $banner = get_option('show_banner');

    $js_detect = get_option('js_detect');

    if($js_detect): ?>
        <script>
            if(document.referrer && -1 != document.referrer.indexOf('r7.com')) {
                document.write('<script type="text/javascript" id="r7barrautil" src="http://barra.r7.com/barra.js">\
                        {responsivo:true, banner: "<?php echo $banner;?>", submenu:"<?php echo $sub_menu;?>"}\
                    <\/script>');
            }
        </script>
    <?php else: ?>
        <script type="text/javascript" id="r7barrautil" src="http://barra.r7.com/barra.js">
            {responsivo:true, banner: "<?php echo $banner;?>", submenu:"<?php echo $sub_menu;?>"}
        </script>
    <?php endif;
}

$r7_show_banner_using_referer = get_option('r7_referer');
$js_detect = get_option('js_detect');

if ($r7_show_banner_using_referer && !$js_detect && !is_from_r7()) {
    return;
}

add_action( $js_detect ? 'wp_print_scripts' : 'wp_print_scripts', 'header_r7' );
add_action( 'wp_footer', 'footer_r7' );