
<div id="container">


	<h1>Welcome to CodeIgniter!</h1>

	<form name="mainform" method="post" action="">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>
		<input type="hidden" name="is_login" value="1" />
		<div id="valid-msg">
			<?php echo validation_errors(); ?>
		</div>

		<table id="script-input">
			<tr>
				<td>名稱<span class="">*</span></td>
				<td><input type="text" name="user_name" value="<?php echo ele('user_name', $_POST); ?>" size="30" maxlength="30" style="" /></td>
			</tr>
			<tr>
				<td>密碼<span class="">*</span></td>
				<td><input type="password" name="user_pass" value="<?php echo ele('user_pass', $_POST); ?>"" size="30" maxlength="30" style="" /></td>
			</tr>
		</table>
		<div>
			<input type="reset" value="撤消" />
			<input class="submit" type="submit" value="OK"/>
		</div>
	</form>

</div>
