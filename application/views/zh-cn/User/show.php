
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<?php
	$script_name = $_SERVER['SCRIPT_NAME'];
	$query_string = explode('&chkopt[0]', $_SERVER['QUERY_STRING'])[0];
	$ymd_format = ymd_format();
	?>
	<form name="mainform" method="" action="<?php echo $script_name; ?>/User">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>

		<table id="script-input">
			<tr>
				<td width="120"><span class="blue">id</span></td>
				<td><input type="text" name="user_id" value="<?php echo seek_value('user_id'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">名称</span></td>
				<td><input type="text" name="user_name" value="<?php echo seek_value('user_name'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">email</span></td>
				<td><input type="text" name="user_email" value="<?php echo seek_value('user_email'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">手机</span></td>
				<td><input type="text" name="user_phone" value="<?php echo seek_value('user_phone'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">爱好</span></td>
				<td>
					<?php
					echo form_dropdown('search'
							, $arr_res['arr_search']
							, seek_value('search', 'in'));
					?>

					<?php
					$seek_attention = seek_value('user_attention', array());
					foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('user_attention[]', $value, in_array($value, $seek_attention)), $disp;
					endforeach;
					?>
				</td>
			</tr>
		</table>

		<input class="button" type="submit" name="show_cmd" value=" OK "/>
		<?php if (isset($res[0])): ?>
			<input class="submit" type="submit" name="del_cmd" value="删除"/>
		<?php endif; ?>
		<a class="button" href="<?php echo $script_name; ?>/User/add?<?php echo $query_string; ?>" target="">新增</a>

		<?php if (isset($res[0]) === FALSE): ?>
			<?php if (isset($res)): ?>
				<br/>没有数据
			<?php else: ?>
				<br/>请输入条件
			<?php endif; ?>
		<?php else: ?>
			<table>
				<tr id="header">
					<th>&nbsp;</th>
					<th><a class="sort-link<?php $sort = say_sort('user_id'); ?>" href="<?php echo $sort_url; ?>&sort=user_id<?php echo $sort; ?>">id</a></th>
					<th>名称</th>
					<th>email</th>
					<th>手机</th>
					<th>关注</th>
					<th><a class="sort-link<?php $sort = say_sort('user_up_date'); ?>" href="<?php echo $sort_url; ?>&sort=user_up_date<?php echo $sort; ?>">修改日期</a></th>
					<th>&nbsp;</th>
				</tr>
				<?php foreach ($res as $k => $v): ?>

					<tr>
						<td>
							<input type="checkbox" name="chkopt[]" value="<?php echo $v['user_id']; ?>" >
						</td>
						<td><?php echo $v['user_id']; ?></td>
						<td><?php echo $v['user_name']; ?>&nbsp;</td>
						<td><?php echo $v['user_email']; ?>&nbsp;</td>
						<td><?php echo $v['user_phone']; ?>&nbsp;</td>
						<td><?php echo say_name($v['user_attention'], $arr_res['arr_attention']); ?>&nbsp;</td>
						<td><?php echo date($ymd_format, $v['user_up_date']); ?></td>
						<td>
							<a class="button" href="<?php echo $script_name; ?>/user/edit?<?php echo $query_string; ?>&chkopt[0]=<?php echo $v['user_id']; ?>">修改</a>
							<a class="button" href="<?php echo $script_name; ?>/user/detail?<?php echo $query_string; ?>&chkopt[0]=<?php echo $v['user_id']; ?>" target="_blank">详细</a>
						</td>
					</tr>

				<?php endforeach; ?>
			</table>
			<?php echo $this->pagination->create_links(); ?>
		<?php endif; ?>

	</form>

</div>

<script type="text/javascript">
//<![CDATA[
	window.onload = function() {
		(function($) {
			
			(function(d) {
				d['okValue'] = '确定';
				d['cancelValue'] = '取消';
				d['title'] = '小组详细内容';
				// [more..]
			})($.dialog.defaults);
			
			$("a[href^='<?php echo $script_name; ?>/user/detail?']").click(wBox);
			
		})(jQuery);
	};
//]]>
</script>