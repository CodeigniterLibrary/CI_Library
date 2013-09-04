
<div id="container">


	<h1>Welcome to CodeIgniter!</h1>

	<form name="mainform" method="post" action="">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>
		<input type="hidden" name="group_name_is_unique" value="1" />
		<div id="valid-msg">
			<?php echo validation_errors(); ?>
		</div>

		<table id="script-input">
			<?php if (isset($res['group_id'])): ?>
				<tr>
					<td>id<span class="">*</span></td>
					<td>&nbsp;<?php echo ele('group_id', $res); ?><input type="hidden" name="group_id" value="<?php echo ele('group_id', $res); ?>" /></td>
				</tr>
				<tr>
					<td>名称<span class="">*</span></td>
					<td>&nbsp;<?php echo ele('group_name', $res); ?><input type="hidden" name="group_name" value="<?php echo ele('group_name', $res); ?>" /></td>
				</tr>
			<?php else: ?>
				<tr>
					<td>名称<span class="">*</span></td>
					<td><input type="text" name="group_name" value="<?php echo ele('group_name', $res); ?>" size="30" maxlength="30" style="" /></td>
				</tr>
			<?php endif; ?>

			<tr>
				<td>地区<span class=""></span></td>
				<td>
					<?php
					$group_attention = ele('group_attention', $res, array());
					foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('group_attention[]'
								, $value
								, in_array($value, $group_attention)
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
