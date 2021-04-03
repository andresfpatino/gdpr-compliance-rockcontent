<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// If have accepted the policy
if(isset($_REQUEST['gdpr-compliance'])) {
    // Calculate the expiration, in this case one year
    $expiration = time() + (60 * 60 * 24 * 365);
    // Create a cookie
    setcookie('GDPR_COMPLIANCE', 'true', $expiration);
}


function display_gdpr_compliance(){ ?>
   
   <?php if (!isset($_REQUEST['gdpr-compliance']) && !isset($_COOKIE['GDPR_COMPLIANCE'])): 

        $display = get_option( 'gdpr_display');
        $position = get_option( 'gdpr_position');
        $colorTheme = get_option( 'gdpr_color_theme');
        $labelButton = get_option( 'gdpr_label_button');
        $textarea = get_option( 'gdpr_textarea_message');

        if( $display == 'mostrar' ) : ?>            
            <div class="GDPR_compliance 
                        <?php if( $position == 'top' ) : ?> GDPR_compliance--position_top <?php else: ?> GDPR_compliance--position_bottom <?php endif; ?>
                        <?php if( $colorTheme == 'ocean' ) : ?> GDPR_compliance--theme_ocean <?php elseif( $colorTheme == 'light' ) : ?> GDPR_compliance--theme_light <?php elseif( $colorTheme == 'forest' ) : ?> GDPR_compliance--theme_forest <?php endif; ?> ">
                <div class="GDPR_compliance__wrap">
                    <?php include plugin_dir_path( __FILE__ ) . 'css/cookie.svg'; ?>
                    <p class="GDPR_compliance__message"> 
                        <?php if ($textarea) {
                            echo esc_html(get_option('gdpr_textarea_message')); 
                        } else {
                            echo __('We use cookies to provide our services and for analytics and marketing. To find out more about our use of cookies, please see our Privacy Policy. By continuing to browse our website, you agree to our use of cookies.', 'gdpr-compliance');
                        } ?> 
                    </p>
                    <a class="GDPR_compliance__button" href="?gdpr-compliance=true"> 
                        <?php if ($labelButton) {
                            echo esc_attr(get_option('gdpr_label_button')); 
                        } else {
                            echo __('Aceito', 'gdpr-compliance');
                        }?> 
                    </a>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; 

}

add_action( 'wp_footer', 'display_gdpr_compliance');
//add_shortcode( 'GDPR-compliance-message', 'gdpr_compliance_shortcode' );