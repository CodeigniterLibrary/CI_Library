
function getEvent() { //获取event事件, 兼容ie和ff的写法
	if (document.all) {
		return window.event;
	} else {
		func = getEvent.caller;
		while (func !== null) {
			var arg0 = func.arguments[0];
			if (arg0) {
				if ((arg0.constructor === Event || arg0.constructor === MouseEvent)
						|| (typeof(arg0) === "object" && arg0.preventDefault && arg0.stopPropagation)) {
					return arg0;
				}
			}
			func = func.caller;
		}
		return null;
	}
}

function add_listener(el, event, fn, bCapture) { //bind事件, 兼容ie和ff的写法
	var isCapture = bCapture ? bCapture : false;
	try {
		el.addEventListener(event, fn, isCapture);
	} catch (e) {
		try {
			el.attachEvent('on' + event, fn);
		} catch (e) {
			el['on' + event] = fn;
		}
	}
}

function get_options_val(select) { // 取得select控件的值
	return select.options[select.sekectedIndex].value;
}

function prepend(child, parent) {// 较低版ie不兼容
	parent.insertBefore(child, parent.childNodes[0]);
}

function append(child, parent) {
	parent.appendChild(child);
}

function remove(child) {
	child.parentNode.removeChild(child);
}

function my_strlen(str) {
	var len = 0;
	var i_ = str.length;
	for (var i = 0; i < i_; i++) {
		if (str.charCodeAt(i) > 255) {
			len += 3;
		} else {
			len++;
		}
	}
	return len;
}

var wBox;
var wImg;
(function($) {

	//  根据链接的弹出窗口事件.
	wBox = function() {
		$.get(this.href + '&ajax=1', function(data) {
			$.dialog({
				content: data,
				follow: this,
				lock: true
			});
		});
		return false;
	};

	wImg = function() {
		$.dialog({
//			follow: this,
			content: '<img src="' + this.href + '" />'
		});
		return false;
	};

})(jQuery);


function del_conf() {
	var chkopt = document.getElementsByName('chkopt[]');
	var chk_len = chkopt.length;
	var itemSel = 0;
	for (var i = 0; i < chk_len; i++) {
		if (chkopt[i].checked) {
			itemSel++;
		}
	}

	if (itemSel == 0) {
		alert("请选择要删除的对象");
		return false;
	} else {
		return confirm("确定要删除");
	}
}

if (typeof(document.mainform.del_cmd) === 'object') {
	document.mainform.del_cmd.onclick = del_conf;
}

if (document.getElementById('valid-msg') !== null) {
	document.getElementById('valid-msg').onclick = function() {
		this.style.display = 'none';
	};
}


function var_dump_obj(obj) {
	var arr = [];
	var i = 0;

	for (k in obj) {
		arr[i] = k + ' : ' + obj[k] + '\n';
		i++;
	}

	alert(arr);
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
	//+ http://kevin.vanzonneveld.net  htmlspecialchars(ele.value, "ENT_QUOTES");
	//+ Mirek Slugen: Kevin van Zonneveld: Nathan: Arno: Brett Zamir: Ratheous: Mailfaker: felix

	var optTemp = 0, i = 0, noquotes = false;
	if (typeof quote_style === 'undefined' || quote_style === null) {
		quote_style = 2;
	}
	string = string.toString();
	if (double_encode !== false) { // Put this first to avoid double-encoding
		string = string.replace(/&/g, '&amp;');
	}
	string = string.replace(/</g, '&lt;').replace(/>/g, '&gt;');

	var OPTS = {
		'ENT_NOQUOTES': 0,
		'ENT_HTML_QUOTE_SINGLE': 1,
		'ENT_HTML_QUOTE_DOUBLE': 2,
		'ENT_COMPAT': 2,
		'ENT_QUOTES': 3,
		'ENT_IGNORE': 4
	};
	if (quote_style === 0) {
		noquotes = true;
	}
	if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
		quote_style = [].concat(quote_style);
		for (i = 0; i < quote_style.length; i++) {
			// Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
			if (OPTS[quote_style[i]] === 0) {
				noquotes = true;
			} else if (OPTS[quote_style[i]]) {
				optTemp = optTemp | OPTS[quote_style[i]];
			}
		}
		quote_style = optTemp;
	}
	if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
		string = string.replace(/'/g, '&#039;');
	}
	if (!noquotes) {
		string = string.replace(/"/g, '&quot;');
	}

	return string;
}

