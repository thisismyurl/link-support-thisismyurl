<form method="post" action="options.php">
    <?php settings_fields( $this->options_group ); ?>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                
                <div class="timu-card">
                    <div class="timu-card-header"><?php esc_html_e( 'External Link Settings', 'thisismyurl-link-support' ); ?></div>
                    <div class="timu-card-body">
                        <table class="form-table">
                            
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Force New Tab', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" id="timu-new-tab-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[new_tab]" value="1" <?php checked( 1, $options['new_tab'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                            <tr class="timu-conditional-new-tab">
                                <th scope="row"><?php esc_html_e( 'SEO & Accessibility', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[nofollow]" value="1" <?php checked( 1, $options['nofollow'] ?? 0 ); ?> /> <?php esc_html_e( 'Apply "nofollow"', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" id="timu-aria-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[aria_labels]" value="1" <?php checked( 1, $options['aria_labels'] ?? 0 ); ?> /> <?php esc_html_e( 'Apply ARIA labels', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[force_secure]" value="1" <?php checked( 1, $options['force_secure'] ?? 0 ); ?> /> <?php esc_html_e( 'Apply "noopener noreferrer"', 'thisismyurl-link-support' ); ?></label>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr/></td></tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Sponsored Domains', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <label class="timu-switch"><input type="checkbox" id="timu-sponsored-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[sponsored_enabled]" value="1" <?php checked( 1, $options['sponsored_enabled'] ?? 0 ); ?> /><span class="timu-slider"></span></label>
                                    <div id="timu-sponsored-details" style="margin-top:10px;"><textarea name="<?php echo esc_attr($this->plugin_slug); ?>_options[sponsored_domains]" rows="2" class="large-text code" placeholder="amazon.com"><?php echo esc_textarea( $options['sponsored_domains'] ?? '' ); ?></textarea></div>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr/></td></tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Visual Enhancements', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <label><input type="checkbox" id="timu-icon-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[external_icon]" value="1" <?php checked( 1, $options['external_icon'] ?? 0 ); ?> /> <?php esc_html_e( 'Show External Icon', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" id="timu-favicon-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[favicon_mode]" value="1" <?php checked( 1, $options['favicon_mode'] ?? 0 ); ?> /> <?php esc_html_e( 'Show Site Favicon', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" id="timu-download-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[download_attr]" value="1" <?php checked( 1, $options['download_attr'] ?? 0 ); ?> /> <?php esc_html_e( 'Enable Download Attributes', 'thisismyurl-link-support' ); ?></label>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr/></td></tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Exit Monitor', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" id="timu-exit-monitor-toggle" name="<?php echo esc_attr($this->plugin_slug); ?>_options[exit_monitor]" value="1" <?php checked( 1, $options['exit_monitor'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                            <tr class="timu-conditional-exit">
                                <th scope="row"><?php esc_html_e( 'Warning & Whitelist', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <input type="text" id="timu-exit-message-input" name="<?php echo esc_attr($this->plugin_slug); ?>_options[exit_message]" value="<?php echo esc_attr( $options['exit_message'] ?? '' ); ?>" class="regular-text" /><br><br>
                                    <textarea name="<?php echo esc_attr($this->plugin_slug); ?>_options[whitelist]" rows="2" class="large-text code" placeholder="partnerdomain.com"><?php echo esc_textarea( $options['whitelist'] ?? '' ); ?></textarea>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr/></td></tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Enable Link Masking', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[link_masking]" value="1" <?php checked( 1, $options['link_masking'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>

                        </table>
                    </div>
                </div>

                <div class="timu-card">
                    <div class="timu-card-header"><?php esc_html_e( 'User Generated Link Settings', 'thisismyurl-link-support' ); ?></div>
                    <div class="timu-card-body">
                        <table class="form-table">
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Jailbreak Prevention', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[jailbreak]" value="1" <?php checked( 1, $options['jailbreak'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'SEO UGC Attribute', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[ugc_enabled]" value="1" <?php checked( 1, $options['ugc_enabled'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="timu-card">
                    <div class="timu-card-header"><?php esc_html_e( 'Internal Link Settings', 'thisismyurl-link-support' ); ?></div>
                    <div class="timu-card-body">
                        <table class="form-table">
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Freshness Badges', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[internal_badges]" value="1" <?php checked( 1, $options['internal_badges'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Media & Language', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[media_indicators]" value="1" <?php checked( 1, $options['media_indicators'] ?? 0 ); ?> /> <?php esc_html_e( 'Show Media Icons', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[hreflang_tags]" value="1" <?php checked( 1, $options['hreflang_tags'] ?? 0 ); ?> /> <?php esc_html_e( 'Show Language Tags', 'thisismyurl-link-support' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Post-Type Data', 'thisismyurl-link-support' ); ?></th>
                                <td><label class="timu-switch"><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[post_type_data]" value="1" <?php checked( 1, $options['post_type_data'] ?? 0 ); ?> /><span class="timu-slider"></span></label></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="timu-card">
                    <div class="timu-card-header"><?php esc_html_e( 'Analytics & Tracking', 'thisismyurl-link-support' ); ?></div>
                    <div class="timu-card-body">
                        <table class="form-table">
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Heatmap & Events', 'thisismyurl-link-support' ); ?></th>
                                <td>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[heatmap_enabled]" value="1" <?php checked( 1, $options['heatmap_enabled'] ?? 0 ); ?> /> <?php esc_html_e( 'Enable Heatmap IDs', 'thisismyurl-link-support' ); ?></label><br>
                                    <label><input type="checkbox" name="<?php echo esc_attr($this->plugin_slug); ?>_options[tracking_enabled]" value="1" <?php checked( 1, $options['tracking_enabled'] ?? 0 ); ?> /> <?php esc_html_e( 'Enable Event Tracking', 'thisismyurl-link-support' ); ?></label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php $this->render_registration_field(); submit_button( __( 'Update Link Settings', 'thisismyurl-link-support' ), 'primary large' ); ?>
            </div>
            <?php $this->render_core_sidebar(); ?>
        </div>
    </div>
</form>