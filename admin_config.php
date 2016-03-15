<?php
add_action('admin_menu', 'r7_plugin_create_menu');

define("LABEL_DEFAULT", 'ENTRETENIMENTO');
define("BACKGROUND_COLOR", '#e2e2e2');

function r7_plugin_create_menu() {
    add_menu_admin();
    add_action('admin_init', 'r7_barra_plugin_settings');
}

function add_menu_admin() {
    $parent_slug = 'options-general.php';
    $page_title  = 'R7 Barra';
    $menu_title  = 'R7 Barra';
    $capability  = 'manage_options';
    $menu_slug   = 'r7-barra';
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, 'r7_barra_plugin_settings_page');
}

function r7_barra_plugin_settings() {
    register_setting( 'r7-barra-settings-group', 'r7_referer' );
    register_setting( 'r7-barra-settings-group', 'label_partner' );
    register_setting( 'r7-barra-settings-group', 'background_color' );
    register_setting( 'r7-barra-settings-group', 'sub_menu' );
    register_setting( 'r7-barra-settings-group', 'show_banner' );
}

function r7_barra_plugin_settings_page() {
    $is_r7_referer = get_option('r7_referer')?'checked=checked':'';
    $label_partner = esc_attr( get_option('label_partner') );
    $label_partner = empty($label_partner)? LABEL_DEFAULT: $label_partner;
    $background_color = esc_attr( get_option('background_color') );
    $background_color = empty($background_color)? BACKGROUND_COLOR: $background_color;
    $show_sub_menu = get_option('sub_menu')?'checked=checked':'';
    $show_banner = get_option('show_banner')?'checked=checked':'';

    ?>
    <div class="wrap">
        <h2>R7 Barra</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'r7-barra-settings-group' ); ?>
            <?php do_settings_sections( 'r7-barra-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Exibir barra apenas quando a origem for do R7</th>
                    <td><input type="checkbox" <?php echo $is_r7_referer; ?>name="r7_referer" value="true" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"> Rótulo do parceiro </th>
                    <td><input type="text" name="label_partner" value="<?php echo $label_partner; ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Cor de fundo</th>
                    <td><input type="text" name="background_color" value="<?php echo $background_color; ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Exibir submenu</th>
                    <td><input type="checkbox" <?php echo $show_sub_menu?> name="sub_menu"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Exibir banner</th>
                    <td><input type="checkbox" <?php echo $show_banner;?> name="show_banner"/></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>