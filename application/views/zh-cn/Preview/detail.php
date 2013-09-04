<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<?php
	$script_name = $_SERVER['SCRIPT_NAME'];
	$ymd_format = ymd_format();
	?>

	<form name="mainform" method="post" action="">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>

		<table id="script-input" style="display:none">
			<?php if (isset($res['group_id'])): ?>
				<tr>
					<td>id<span class="">*</span></td>
					<td><input type="text" name="group_id" value="<?php echo ele('group_id', $res); ?>" size="30" maxlength="30" style="" readonly=""/></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td>名称<span class="">*</span></td>
				<td><input type="text" name="group_name" value="<?php echo ele('group_name', $res); ?>" size="30" maxlength="30" style="" /></td>
			</tr>
			<tr>
				<td>地区<span class=""></span></td>
				<td>
					<input type="hidden" name="group_attention[]" value="" />
					<?php
					foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('group_attention[]', $value, in_array($value, int_arr(ele('group_attention', $res)))), $disp;
					endforeach;
					?>
				</td>
			</tr>
		</table>
		<table class="detail-view" id="yw0">
			<?php if (isset($res['group'])): ?>
				<tr class="odd"><th>Group id</th><td><?php echo $res['group_id']; ?></td></tr>
			<?php endif; ?>
			<tr class="even"><th>名称</th><td><?php echo $res['group_name']; ?>&nbsp;</td></tr>
			<tr class="even"><th>关注</th><td><?php echo say_name($res['group_attention'], $arr_res['arr_attention']); ?>&nbsp;</td></tr>
			<?php if ($cmd === 'detail'): ?>
				<tr class="odd"><th>修改日期</th><td><?php echo date($ymd_format, $res['up_date']); ?></td></tr>
			<?php else: ?>
				<div>
					<?php if (isset($_POST['no_script'])): ?>
						返回修改请按左上方返回键
					<?php else: ?>
						<input type="reset" value="返回修改" onclick="history.go(-1);"/>
					<?php endif; ?>
					&nbsp;<input class="submit" type="submit" name="conf_cmd" value="确定"/>
				</div>
			<?php endif; ?>
		</table>
	</form>

</div>