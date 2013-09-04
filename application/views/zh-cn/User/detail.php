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

		<?php echo form_hidden2($res); ?>
		<table class="detail-view" id="yw0">
			<?php if (isset($res['user_id'])): ?>
				<tr class="odd"><th>id</th><td><?php echo $res['user_id']; ?></td></tr>
			<?php endif; ?>
			<tr class="even"><th>名称</th><td><?php echo $res['user_name']; ?>&nbsp;</td></tr>
			<tr class="even"><th>email</th><td><?php echo $res['user_email']; ?>&nbsp;</td></tr>
			<tr class="even"><th>手机</th><td><?php echo $res['user_phone']; ?>&nbsp;</td></tr>
			<tr class="even"><th>关注</th><td><?php echo say_name(ele('user_attention', $res), $arr_res['arr_attention']); ?>&nbsp;</td></tr>
			<?php if ($cmd === 'detail'): ?>
				<tr class="odd"><th>修改日期</th><td><?php echo date($ymd_format, $res['user_up_date']); ?></td></tr>
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