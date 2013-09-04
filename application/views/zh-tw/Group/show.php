
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<?php
	$script_name = $_SERVER['SCRIPT_NAME'];
	$query_string = explode('&chkopt[0]', $_SERVER['QUERY_STRING'])[0];
	$ymd_format = ymd_format();
	?>
	<form name="mainform" method="" action="<?php echo $script_name; ?>/Group">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>

		<table id="script-input">
			<tr>
				<td width="120"><span class="blue">id</span></td>
				<td><input type="text" name="group_id" value="<?php echo seek_value('group_id'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">名稱</span></td>
				<td><input type="text" name="group_name" value="<?php echo seek_value('group_name'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">愛好</span></td>
				<td>
					<?php
					echo form_dropdown('search'
							, $arr_res['arr_search']
							, seek_value('search', 'in'));
					?>

					<?php
					$seek_attention = seek_value('group_attention', array());
					foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('group_attention[]', $value, in_array($value, $seek_attention)), $disp;
					endforeach;
					?>
				</td>
			</tr>
		</table>

		<input class="button" type="submit" name="show_cmd" value=" OK "/>
		<?php if (isset($res[0])): ?>
			<input class="submit" type="submit" name="del_cmd" value="刪除"/>
			<a class="button" href="<?php echo $script_name; ?>/group/csv?<?php echo $query_string; ?>">CSV</a>
		<?php endif; ?>
		<a class="button" href="<?php echo $script_name; ?>/Group/add?<?php echo $query_string; ?>" target="">新增</a>

		<?php if (isset($res[0]) === FALSE): ?>
			<?php if (isset($res)): ?>
				<br/>沒有數據
			<?php else: ?>
				<br/>請輸入條件
			<?php endif; ?>
		<?php else: ?>
			<table>
				<tr id="header">
					<th>&nbsp;</th>
					<th><a class="sort-link<?php $sort = say_sort('group_id'); ?>" href="<?php echo $sort_url; ?>&sort=group_id<?php echo $sort; ?>">id</a></th>
					<th>名稱</th>
					<th>關注</th>
					<th><a class="sort-link<?php $sort = say_sort('group_up_date'); ?>" href="<?php echo $sort_url; ?>&sort=group_up_date<?php echo $sort; ?>">修改日期</a></th>
					<th>&nbsp;</th>
				</tr>
				<?php foreach ($res as $k => $v): ?>

					<tr>
						<td>
							<input type="checkbox" name="chkopt[]" value="<?php echo $v['group_id']; ?>" >
						</td>
						<td><?php echo $v['group_id']; ?></td>
						<td><?php echo $v['group_name']; ?>&nbsp;</td>
						<td><?php echo say_name($v['group_attention'], $arr_res['arr_attention']); ?>&nbsp;</td>
						<td><?php echo date($ymd_format, $v['group_up_date']); ?></td>
						<td>
							<a class="button" href="<?php echo $script_name; ?>/group/edit?<?php echo $query_string; ?>&chkopt[0]=<?php echo $v['group_id']; ?>">修改</a>
							<a class="button" href="<?php echo $script_name; ?>/group/detail?<?php echo $query_string; ?>&chkopt[0]=<?php echo $v['group_id']; ?>" target="_blank">詳細</a>
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
				d['okValue'] = '確定';
				d['cancelValue'] = '取消';
				d['title'] = '小組詳細內容';
				// [more..]
			})($.dialog.defaults);
			
			$("a[href^='<?php echo $script_name; ?>/group/detail?']").click(wBox);
			
		})(jQuery);
	};
//]]>
</script>