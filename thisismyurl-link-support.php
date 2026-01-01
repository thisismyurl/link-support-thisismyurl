<?php
/**
 * Author:              Christopher Ross
 * Author URI:          https://thisismyurl.com/?source=thisismyurl-link-support
 * Plugin Name:         Globally manage link behavior, including nofollow and target attributes.
 * Plugin URI:          https://thisismyurl.com/thisismyurl-link-support/?source=thisismyurl-link-support
 * Donate link:         https://thisismyurl.com/donate/?source=thisismyurl-link-support
 * 
 * Description:         Safely enable LINK uploads and convert them to WebP format.
 * Tags:                link, uploads, media library
 * 
 * Version:             1.260101
 * Requires at least:   6.0
 * Requires PHP:        7.4
 * 
 * Update URI:          https://github.com/thisismyurl/thisismyurl-link-support
 * GitHub Plugin URI:   https://github.com/thisismyurl/thisismyurl-link-support
 * Primary Branch:      main
 * Text Domain:         thisismyurl-link-support
 * 
 * License:             GPL2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * 
 * @package TIMU_LINK_Support
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Version-aware Core Loader
 */
function timu_link_support_load_core() {
    $core_path = plugin_dir_path( __FILE__ ) . 'core/class-timu-core.php';
    if ( ! class_exists( 'TIMU_Core_v1' ) ) {
        require_once $core_path;
    }
}
timu_link_support_load_core();

class TIMU_Link_Support extends TIMU_Core_v1 {

    /**
     * Constructor: Initializes Core and Link specific hooks.
     * Routes to 'tools.php' via the parent constructor.
     */
    public function __construct() {
        parent::__construct( 
            'thisismyurl-link-support', 
            plugin_dir_url( __FILE__ ), 
            'timu_ls_settings_group', 
            '', 
            'tools.php' // Routes all Core links to Tools
        );

        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_filter( 'the_content', array( $this, 'modify_external_links' ), 99 );

        register_activation_hook( __FILE__, array( $this, 'activate_plugin_defaults' ) );
    }

    /**
     * Sets Master Switch, New Tab, and Nofollow to '1' by default[cite: 23].
     */
    public function activate_plugin_defaults() {
        $option_name = $this->plugin_slug . '_options';
        if ( false === get_option( $option_name ) ) {
            update_option( $option_name, array(
                'enabled'  => 1,
                'new_tab'  => 1,
                'nofollow' => 1,
            ) );
        }
    }

    /**
     * Adds the menu page under Tools[cite: 11, 16].
     */
    public function add_admin_menu() {
        add_management_page(
            __( 'Link Support', 'thisismyurl-link-support' ),
            __( 'Link Support', 'thisismyurl-link-support' ),
            'manage_options',
            $this->plugin_slug,
            array( $this, 'render_ui' )
        );
    }

    /**
     * Renders the Settings Interface utilizing the TIMU Card system[cite: 9, 24].
     */
    public function render_ui() {
        if ( ! current_user_can( 'manage_options' ) ) return;

        $options = $this->get_plugin_option();
        $sidebar_extra = '<p>' . esc_html__( 'This plugin modifies links dynamically during page render, keeping your database clean.', 'thisismyurl-link-support' ) . '</p>';
        ?>
        <div class="wrap timu-admin-wrap">
            <?php $this->render_core_header(); ?>
            
            <form method="post" action="options.php">
                <?php settings_fields( $this->options_group ); ?>
                
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-2">
                        <div id="post-body-content">
                            
                            <div class="timu-card">
                                <div class="timu-card-header"><?php esc_html_e( 'Link Control Settings', 'thisismyurl-link-support' ); ?></div>
                                <div class="timu-card-body">
                                    <table class="form-table">
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Master Switch', 'thisismyurl-link-support' ); ?></th>
                                            <td>
                                                <label class="timu-switch">
                                                    <input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[enabled]" value="1" <?php checked( 1, $options['enabled'] ?? 0 ); ?> />
                                                    <span class="timu-slider"></span>
                                                </label>
                                                <p class="description"><?php esc_html_e( 'Activate link filtering.', 'thisismyurl-link-support' ); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Force New Tab', 'thisismyurl-link-support' ); ?></th>
                                            <td>
                                                <label class="timu-switch">
                                                    <input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[new_tab]" value="1" <?php checked( 1, $options['new_tab'] ?? 0 ); ?> />
                                                    <span class="timu-slider"></span>
                                                </label>
                                                <p class="description"><?php esc_html_e( 'Open external links in a new window.', 'thisismyurl-link-support' ); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'SEO Nofollow', 'thisismyurl-link-support' ); ?></th>
                                            <td>
                                                <label class="timu-switch">
                                                    <input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[nofollow]" value="1" <?php checked( 1, $options['nofollow'] ?? 0 ); ?> />
                                                    <span class="timu-slider"></span>
                                                </label>
                                                <p class="description"><?php esc_html_e( "Protect link equity with 'nofollow'.", 'thisismyurl-link-support' ); ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <?php $this->render_registration_field(); ?>
                            <?php submit_button( __( 'Update Link Settings', 'thisismyurl-link-support' ), 'primary large' ); ?>
                        </div>

                        <?php $this->render_core_sidebar( $sidebar_extra ); ?>
                    </div>
                </div>
            </form>
            <?php $this->render_core_footer(); ?>
        </div>
        <?php
    }

    /**
     * [cite_start]Modifies content dynamically via the_content[cite: 3, 11, 13, 18].
     */
    public function modify_external_links( $content ) {
        $options = $this->get_plugin_option();
        if ( empty( $options['enabled'] ) ) {
            return $content;
        }

        return preg_replace_callback( '/<a\s[^>]*href=["\']([^"\']*)["\'][^>]*>/i', function( $matches ) use ( $options ) {
            $link_html = $matches[0];
            $url       = $matches[1];
            $site_url  = get_site_url();

            // Only process external links starting with http [cite: 3]
            if ( strpos( $url, $site_url ) === false && strpos( $url, 'http' ) === 0 ) {
                if ( ! empty( $options['new_tab'] ) && false === strpos( $link_html, 'target=' ) ) {
                    $link_html = str_replace( '<a ', '<a target="_blank" ', $link_html );
                }
                if ( ! empty( $options['nofollow'] ) && false === strpos( $link_html, 'rel=' ) ) {
                    $link_html = str_replace( '<a ', '<a rel="nofollow noopener noreferrer" ', $link_html );
                }
            }
            return $link_html;
        }, $content );
    }
}

new TIMU_Link_Support();