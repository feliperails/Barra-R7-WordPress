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

function isFromR7()
{
    $referer = $_SERVER['HTTP_REFERER'];
    if ( strpos($referer, 'r7.com') !== false ) {
        return true;
    }
    return false;
}

function footerR7()
{
    $label_partner = 'ENTRETENIMENTO';
    $background_color = '#e2e2e2';
    $is_partner = "true";

    ?>
    <script id="r7-footer-portal" src="http://barra.r7.com/footer/footer-portal/footer-portal.js" charset="UTF-8">
        {showPane:false, bgC:"<?php echo $background_color;?>", isPartner: <?php echo $is_partner?>, partnerLabel:"<?php echo $label_partner;?>"}
    </script>
    <?php
}

function headerR7()
{
    $submenu = "false";
    $banner = "false";

    ?>
    <script type="text/javascript" id="r7barrautil" src="http://barra.r7.com/barra.js">
        {responsivo:true, banner: <?php echo $banner;?>, submenu:<?php echo $submenu;?>}
    </script>
    <?php
}

if (is_admin()) {
    return;
}

if ($show_banner_using_referer && !isFromR7()) {
    return;
}

add_action( 'wp_print_scripts', 'headerR7' );
add_action( 'wp_footer', 'footerR7' );

?>
