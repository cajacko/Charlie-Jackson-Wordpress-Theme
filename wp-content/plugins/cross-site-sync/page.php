<div class="wrap">
	<h2>Your Plugin Page Title</h2>
	
	<form method="post" action="options.php"> 
		<?php settings_fields( 'cross-site-sync-options' ); ?>
		<?php do_settings_sections( 'cross-site-sync-options' ); ?>

		<table class="form-table">
	        <tr valign="top">
		        <th scope="row">Secret</th>
		        <td><input type="text" name="cross_site_sync_secret" value="<?php echo esc_attr( get_option( 'cross_site_sync_secret' ) ); ?>" /></td>
	        </tr>
	         
	        <tr valign="top">
		        <th scope="row">Push or Pull</th>
		        <td>
			        <select name="cross_site_sync_push_or_pull">
				        <option value="push"<?php if( esc_attr( get_option( 'cross_site_sync_push_or_pull' ) ) == 'push' ): echo ' selected'; endif;?>>Push</option>
				        <option value="pull"<?php if( esc_attr( get_option( 'cross_site_sync_push_or_pull' ) ) == 'pull' ): echo ' selected'; endif;?>>Pull</option>
				    </select>
			    </td>
	        </tr>
	        
	        <tr valign="top">
		        <th scope="row">Website</th>
		        <td><input type="text" name="cross_site_sync_website_1" value="<?php echo esc_attr( get_option( 'cross_site_sync_website_1' ) ); ?>" /></td>
	        </tr>
	        
	        <?php if( esc_attr( get_option( 'cross_site_sync_push_or_pull' ) ) == 'push' ): ?>
	        
		        <tr valign="top">
			        <th scope="row">Which Category of Posts should be synced to: <?php echo esc_attr( get_option( 'cross_site_sync_website_1' ) ); ?></th>
			        <td> 
				        <?php 
					        $cat_array = array( 'name' => 'cross_site_sync_category', 'hide_empty' => 0 );

					        if( esc_attr( get_option( 'cross_site_sync_category' ) != '' ) ) {
						    	$cat_array['selected'] = esc_attr( get_option( 'cross_site_sync_category' ) );
						    }
						    
					        wp_dropdown_categories( $cat_array ); 
					    ?>    
				    </td>
		        </tr>
		        
		        <tr valign="top">
			        <th scope="row">Include the sync category in the posts on: <?php echo esc_attr( get_option( 'cross_site_sync_website_1' ) ); ?></th>
			        <td>
				        <select name="cross_site_sync_include_init_category">
					        <option value="yes"<?php if( esc_attr( get_option( 'cross_site_sync_include_init_category' ) ) == 'yes' ): echo ' selected'; endif;?>>Yes</option>
					        <option value="no"<?php if( esc_attr( get_option( 'cross_site_sync_include_init_category' ) ) == 'no' ): echo ' selected'; endif;?>>No</option>
					    </select>
				    </td>
		        </tr>
		        
		        <tr valign="top">
			        <th scope="row">Include all the categories in the posts on: <?php echo esc_attr( get_option('cross_site_sync_website_1') ); ?></th>
			        <td>
				        <select name="cross_site_sync_include_all_categories">
					        <option value="yes"<?php if( esc_attr( get_option( 'cross_site_sync_include_all_categories' ) ) == 'yes' ): echo ' selected'; endif;?>>Yes</option>
					        <option value="no"<?php if( esc_attr( get_option( 'cross_site_sync_include_all_categories' ) ) == 'no' ): echo ' selected'; endif;?>>No</option>
					    </select>
				    </td>
		        </tr>
		        
		    <?php else: ?>
		    
		    	<tr valign="top">
			        <th scope="row">Website 2</th>
			        <td><input type="text" name="cross_site_sync_website_2" value="<?php echo esc_attr( get_option( 'cross_site_sync_website_2' ) ); ?>" /></td>
		        </tr>
		        
		        <tr valign="top">
			        <th scope="row">Website 3</th>
			        <td><input type="text" name="cross_site_sync_website_3" value="<?php echo esc_attr( get_option( 'cross_site_sync_website_3' ) ); ?>" /></td>
		        </tr>
	        
	        <?php endif; ?>
	    </table>
		
		<?php submit_button(); ?>
	</form>
</div>