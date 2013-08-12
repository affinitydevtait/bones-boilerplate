<?
class WP_Tools {
	
	/**
	 * [WP_Tools description]
	 */
	public function WP_Tools() {
		
	}

	public function get_tab_content() {
		?>
		<form method="post" action="options.php"> 
		<? settings_fields( 'anm_tools_options' ); ?>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="blogname">Developer Tools</label></th>
				<td>
					<fieldset>
					<label title='Enabled'><input type='radio' name='developer_mode' value='true' <? echo (get_option('developer_mode') == "true") ? "checked='checked'" : ""; ?> /> <span>Enabled</span></label><br />
					<label title='Disabled'><input type='radio' name='developer_mode' value='false' <? echo (get_option('developer_mode') == "true") ? "" : "checked='checked'"; ?> /> <span>Disabled</span></label><br />

					<input name="developer_IP" type="text" id="developer_IP" value="<?php echo get_option('developer_IP','178.239.109.249'); ?>" class="regular-text" />
					<p class="description">This will be restricted to the above IPs to prevent debugging in production environment.</p>

					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blogdescription">Permission Check</label></th>
				<td><input type="button" name="button" id="button" class="button button-primary" value="Run" disabled="disabled" /> <em>To Do</em></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blogdescription">Sign Off Assistant</label></th>
				<td><input type="button" name="button" id="button" class="button button-primary" value="Run" disabled="disabled"  /> <em>To Do</em></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blogdescription">Generate Theme</label></th>
				<td>
					<input name="forip" type="text" id="forip" value="client" class="regular-text" />
					<input type="button" name="button" id="button" class="button button-primary" value="Run" disabled="disabled"  /> <em>To Do</em>
				</td>
			</tr>
		</table>
		<? submit_button(); ?>
		</form>
		<?
	}
}
?>