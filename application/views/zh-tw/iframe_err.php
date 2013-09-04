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
/* 把父窗口顯示消息的層打開 */
$pd.getElementById("message").style.display = "block";

/* 把本窗口獲取的消息寫上去 */
$pd.getElementById("message").innerHTML = "<?php echo $error; ?>";

/* 並且設置為10秒後自動關閉父窗口的消息顯示*/
setTimeout("$pd.getElementById('message').style.display = 'none'", 10000);

var i_ = "<?php echo count($this->input->post('img_title')); ?>";

if (i_ !== "0") {
	setTimeout("my_foucs()", 1500);
}

//]]>
</script>