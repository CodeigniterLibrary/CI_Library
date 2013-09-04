<script>
//<![CDATA[

function my_strlen(str) {
	var len = 0;
	var i_ = str.length;
	for (var i=0; i<i_; i++) {
		if (str.charCodeAt(i)>255) {len+=3;} else {len++;}
	}
	return len;
}

function my_foucs() {
	var $pd = parent.document;

	var max = 0;
	var len = 0;
	var title_foucs = 0;

	for (var i=0; i<i_; i++) {
		len = my_strlen($pd.getElementsByName('img_title['+i+']')[0].value);
		if (max < len) {
			max = len;
			title_foucs = i;
		}
	}
	$pd.getElementsByName('img_title['+title_foucs+']')[0].focus();
}

var $pd = parent.document;
/* 把父窗口显示消息的层打开 */
$pd.getElementById("message").style.display = "block";

/* 把本窗口获取的消息写上去 */
$pd.getElementById("message").innerHTML = "<?php echo $error; ?>";

/* 并且设置为10秒后自动关闭父窗口的消息显示 */
setTimeout("$pd.getElementById('message').style.display = 'none'", 10000);

var i_ = "<?php echo count($this->input->post('img_title')); ?>";

if (i_ !== "0") {
	setTimeout("my_foucs()", 1500);
}

//]]>
</script>