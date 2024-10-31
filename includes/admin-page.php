<div class="wrap">
	<h2>Oktopost Tracking Code</h2>
	
	<?php if (!$this->is_valid_account_id()) : ?>
	<div class="error">
		<p>
			<b>Account Id is not formatted correctly.</b> Please use the instructions below 
			to fetch the correct information.
		</p>
	</div>
	<?php endif; ?>

	<p>
		Automatically append the 
		<a href="https://help.oktopost.com/en/articles/14-setting-up-conversion-tracking-and-lead-capture" target="_blank">Oktopsot tracking code</a> 
		to your WordPress template.
	</p>

	<form method="post" action="options.php">
		<?php settings_fields(self::SETTINGS_GROUP); ?>
    	<?php do_settings_sections(self::SETTINGS_GROUP); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="<?php echo self::OPT_ACCOUNT_ID; ?>">
							Oktopost Account Id
						</label>
					</th>
					<td>
						<input 
							name="<?php echo self::OPT_ACCOUNT_ID; ?>" 
							type="text" id="<?php echo self::OPT_ACCOUNT_ID; ?>" 
							value="<?php echo self::get_account_id(); ?>" 
							class="regular-text"
							maxlength="15">

						<p class="description">
							Found in your Oktopost account under 
							<a href="https://app.oktopost.com/my-profile/api" target="_blank">My Profile</a>
							&rarr; API.
						</p>
					</td>
				</tr>		
			</tbody>
		</table>

		<?php submit_button(); ?>
	</form>
</div>