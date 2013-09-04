<div id="body">

</div>

<p class="footer"></p>


<?php $js_path = "http://{$this->config->config['js']}"; ?>
<div id="skins" style="display:none">
	<ul id="skins-list">
		<li><a class="button" href="javascript:;">default</a></li>
		<li><a class="button" href="javascript:;">aero</a></li>
		<li><a class="button" href="javascript:;">chrome</a></li>
		<li><a class="button" href="javascript:;">opera</a></li>
		<li><a class="button" href="javascript:;">simple</a></li>
		<li><a class="button" href="javascript:;">idialog</a></li>
		<li><a class="button" href="javascript:;">twitter</a></li>
		<li><a class="button" href="javascript:;">blue</a></li>
		<li><a class="button" href="javascript:;">black</a></li>
		<li><a class="button" href="javascript:;">green</a></li>
	</ul>
	<div id="skins-dialog-content">
		<p style="text-align:center">备注：带阴影的效果的皮肤不被IE6支持。可使用渐进增强方式 <a href="javascript:;" onclick="document.getElementById('skins-ie6').style.display = 'block';
				return false">解决[+]</a></p>
		<pre id="skins-ie6" class="sh_javascript" style="display:none">&lt;!--[if gte IE 7]&gt;&lt;!--&gt;
    &lt;link href="<?php echo $js_path; ?>/aero.css" rel="stylesheet" /&gt;
&lt;!--&lt;![endif]--&gt;
&lt;!--[if lt IE 7]&gt;
    &lt;link href="<?php echo $js_path; ?>/default.css" rel="stylesheet" /&gt;
&lt;![endif]--&gt;</pre>
	</div>
</div>

</body>

<script src="<?php echo $js_path; ?>/jquery-1.6.4.min.js" type="text/javascript">
</script>
<script src="<?php echo $js_path; ?>/jquery.artDialog.js" type="text/javascript">
</script>
<script src="<?php echo $js_path; ?>/common.js" type="text/javascript">
</script>

</html>


