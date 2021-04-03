<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*
* Add menu page
*/
function gdpr_compliance_options_page(  ) { 
	add_menu_page( 
		'GDPR Compliance Rock Content',
		'GDPR', 
		'manage_options', 
		'gdpr-compliance-options', 
		'gdpr_options_page',
        'dashicons-bell', 
		5 
    );    
}
add_action( 'admin_menu', 'gdpr_compliance_options_page' );

/* 
* CDPR field settings 
*/
function gdpr_settings_init(){	
	register_setting('gdpr_settings', 'gdpr_display');
	register_setting('gdpr_settings', 'gdpr_position');
	register_setting('gdpr_settings', 'gdpr_color_theme');
	register_setting('gdpr_settings', 'gdpr_label_button');
	register_setting('gdpr_settings', 'gdpr_textarea_message');
}
add_action( 'admin_init', 'gdpr_settings_init' );


/* 
* Render options page
*/
function gdpr_options_page(){ ?>
	<div class="wrap">	
		<h1> <?php echo __( 'GDPR Compliance Rock Content', 'gdpr-compliance'); ?> </h1>
		<hr>
		<form action="options.php" method="POST">

			<?php settings_fields('gdpr_settings'); do_settings_sections('gdpr_settings'); ?>

			<table class="form-table">
				<!-- Display -->
				<tr valign="top">
					<th scope="row"> <?php echo __('Habilite ou desabilite', 'gdpr-compliance') ?> </th>
					<td>
						<?php $options = get_option( 'gdpr_display' ); ?>
						<label for="show-gdpr"> 
							<input type='radio' required name='gdpr_display' id="show-gdpr"  value='mostrar' <?php checked( 'mostrar', get_option( 'gdpr_display' ) ); ?> >
							<?php echo __('Mostrar', ' gdpr-compliance'); ?>
						</label> 
						<br>
						<label for="hide-gdpr"> 
							<input type='radio' required name='gdpr_display' id="hide-gdpr"  value='ocultar' <?php checked( 'ocultar', get_option( 'gdpr_display' ) ); ?> >
							<?php echo __('Esconder', ' gdpr-compliance'); ?>
						</label> 
					</td>
				</tr>

				<!--Position -->
			 	<tr valign="top">
					<th scope="row"> <?php echo __('Escolher a posição', 'gdpr-compliance') ?> </th>
					<td>
						<?php $options = get_option( 'gdpr_position' ); ?>	    
						<label for="top"> 
							<input type='radio' required id="top" name='gdpr_position' value='top' <?php checked( 'top', get_option( 'gdpr_position' ) ); ?> >
							<?php echo __('Parte de cima', ' gdpr-compliance'); ?>
						</label> 
						<br>
						<label for="bottom"> 
							<input type='radio' required id="bottom" name='gdpr_position' value='bottom' <?php checked( 'bottom', get_option( 'gdpr_position' ) ); ?> >
							<?php echo __('Parte inferior', ' gdpr-compliance'); ?>
						</label> 
					</td>
				</tr>

				<!-- Color theme -->
				<tr valign="top">
					<th scope="row"> <?php echo __('Tema de cores', 'gdpr-compliance') ?> </th>
					<td>
						<?php $options = get_option( 'gdpr_color_theme' ); ?>
						<label for="theme-ocean" class="gdpr_theme-color-label"> 
							<input type='radio' required id="theme-ocean" name='gdpr_color_theme' value='ocean' <?php checked( 'ocean', get_option( 'gdpr_color_theme' ) ); ?> >
							<p class=""><?php echo __('Ocean', ' gdpr-compliance'); ?></p>
							<div class="gdpr_theme gdpr_theme--ocean">
								<span></span><span></span><span></span><span></span><span></span>
							</div>
						</label> 

						<label for="theme-light" class="gdpr_theme-color-label"> 
							<input type='radio' required id="theme-light" name='gdpr_color_theme' value='light' <?php checked( 'light', get_option( 'gdpr_color_theme' ) ); ?> >
							<p> <?php echo __('Light', ' gdpr-compliance'); ?> </p>
							<div class="gdpr_theme gdpr_theme--light">
								<span></span><span></span><span></span><span></span><span></span>
							</div>
						</label> 

						<label for="theme-forest" class="gdpr_theme-color-label"> 
							<input type='radio' required id="theme-forest" name='gdpr_color_theme' value='forest' <?php checked( 'forest', get_option( 'gdpr_color_theme' ) ); ?> >
							<p> <?php echo __('Forest', ' gdpr-compliance'); ?> </p>
							<div class="gdpr_theme gdpr_theme--forest">
								<span></span><span></span><span></span><span></span><span></span>
							</div>
						</label>					
					</td>
				</tr>

				<!-- Label button -->
				<tr valign="top">
					<th scope="row"> <?php echo __('Label do botão', 'gdpr-compliance'); ?> </th>
					<td>
						<?php $options = get_option( 'gdpr_label_button' ); ?>	
    					<input type='text' name='gdpr_label_button' size="40" value="<?php echo esc_attr(get_option('gdpr_label_button')); ?>" placeholder="Aceito"> 
					</td>
				</tr> 

				<!-- Message -->
				<tr valign="top">
					<th scope="row"> <?php echo __('Caixa de consentimento', 'gdpr-compliance'); ?> </th>
					<td>
						<?php $options = get_option('gdpr_textarea_message');
						$args = array (
							'media_buttons' => false,
							'textarea_rows' => '5'
						);
						wp_editor( $options, 'gdpr_textarea_message', $args );	?>
					</td>

				</tr> 

			</table>
			
			<?php submit_button(); ?>	

		</form>
	</div>
	<?php	
}