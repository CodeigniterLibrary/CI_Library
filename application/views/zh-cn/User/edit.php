
<div id="container">


	<h1>Welcome to CodeIgniter!</h1>

	<form name="mainform" method="post" action="">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>
		<input type="hidden" name="user_name_is_unique" value="1" />
		<input type="hidden" name="user_email_is_unique" value="1" />
		<input type="hidden" name="user_phone_is_unique" value="1" />
		<div id="valid-msg">
			<?php echo validation_errors(); ?>
		</div>

		<table id="script-input">
			<?php if (isset($res['user_id'])): ?>
				<tr>
					<td>id<span class="">*</span></td>
					<td>&nbsp;<?php echo ele('user_id', $res); ?><input type="hidden" name="user_id" value="<?php echo ele('user_id', $res); ?>" /></td>
				</tr>
				<tr>
					<td>名称<span class="">*</span></td>
					<td>&nbsp;<?php echo ele('user_name', $res); ?><input type="hidden" name="user_name" value="<?php echo ele('user_name', $res); ?>" /></td>
				</tr>
				<tr>
					<td>email<span class="">*</span></td>
					<td>&nbsp;<?php echo ele('user_email', $res); ?><input type="hidden" name="user_email" value="<?php echo ele('user_email', $res); ?>" /></td>
				</tr>
			<?php else: ?>
				<tr>
					<td>名称<span class="">*</span></td>
					<td><input type="text" name="user_name" value="<?php echo ele('user_name', $res); ?>" size="30" maxlength="30" style="" /></td>
				</tr>
				<tr>
					<td>email<span class="">*</span></td>
					<td><input type="text" name="user_email" value="<?php echo ele('user_email', $res); ?>" size="30" maxlength="30" style="" /></td>
				</tr>
				<tr>
					<td>密码<span class="">*</span></td>
					<td><input type="password" name="user_pass" value="<?php echo ele('user_pass', $res); ?>" size="30" maxlength="30" style="" /></td>
				</tr>
				<tr>
					<td>确认密码<span class="">*</span></td>
					<td><input type="password" name="user_pass_conf" value="<?php echo ele('user_pass_conf', $res); ?>" size="30" maxlength="30" style="" /></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td>手机</td>
				<td><input type="text" name="user_phone" value="<?php echo ele('user_phone', $res); ?>" size="30" maxlength="30" style="" /></td>
			</tr>
			<tr>
				<td>爱好<span class=""></span></td>
				<td>
					<?php
					$user_attention = ele('user_attention', $res, array());
					foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('user_attention[]'
								, $value
								, in_array($value, $user_attention)
						), $disp;
					endforeach;
					?>
				</td>
			</tr>
		</table>
		<div>
			<input type="reset" value="撤消" />
			<input class="submit" type="submit" value="OK"/>
		</div>
	</form>

</div>
