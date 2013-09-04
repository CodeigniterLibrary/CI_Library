<?php
namespace doitphp\libraries;
use doitphp\core as core;

/**
 * CSV操作类
 *
 * CSV文件的读取及生成
 * @author tommy <streen003@gmail.com>
 * @copyright Copyright (c) 2010 Tommycode Studio
 * @link http://www.doitphp.com
 * @license New BSD License.{@link http://www.opensource.org/licenses/bsd-license.php}
 * @version $Id: csv.class.php 1.0 2011-12-24 18:08:57Z tommy $
 * @package libraries
 * @since 1.0
 */

(defined('BASEPATH')) OR exit();

class csv extends core\Base {
	
	private static $_csv_conf = ['delim' => ",", 
			'newline' => "\n", 
			'enclosure' => '"',];
	/**
	 * 将CSV文件转化为数组
	 *
	 * @access public
	 * @param string $fileName csv文件名(路径)
	 * @param string $delimiter 单元分割符(逗号或制表符)
	 * @return array
	 */
	public static function readCsv($fileName, $csv_conf = []) {

		//参数分析
		if ( ! ($fileName && file_exists($fileName))) {
			return false;
		};

		setlocale(LC_ALL, 'en_US.UTF-8');
		
		// 'delim' => ",", 
		// 'newline' => "\n", 
		// 'enclosure' => '"',
		extract(array_merge(self::$_csv_conf, $csv_conf));
		
		//读取csv文件内容
		$handle	   = fopen($fileName, 'r');
		$outputArray  = array();
		$row		  = 0;
		while ($data = fgetcsv($handle, 1000, $delim)) {
			$num = count($data);
			for ($i = 0; $i < $num; $i ++) {
				$outputArray[$row][$i] = $data[$i];
			}
			++$row;
		}
		fclose($handle);

		return $outputArray;
	}
	
	/**
	 * 将CSV文件转化为数组
	 *
	 * @access public
	 * @param string $fileName csv文件名(路径)
	 * @param string $delimiter 单元分割符(逗号或制表符)
	 * @return array 0为键 1为值
	 */
	public static function readCsvKV($fileName, $csv_conf = []) {

		//参数分析
		if ( ! ($fileName && file_exists($fileName))) {
			return false;
		};

		setlocale(LC_ALL, 'en_US.UTF-8');
		
		// 'delim' => ",", 
		// 'newline' => "\n", 
		// 'enclosure' => '"',
		extract(array_merge(self::$_csv_conf, $csv_conf));
		
		//读取csv文件内容
		$handle	   = fopen($fileName, 'r');
		$outputArray  = array();
		$row		  = 0;
		while ($data = fgetcsv($handle, 1000, $delim)) {
			if (count($data) > 1) {
				$outputArray[$data[0]] = $data[1];
			} else {
				// $outputArray[$data[0]] = '';
			}
			++$row;
		}
		fclose($handle);

		return $outputArray;
	}

	/**
	 * 生成csv文件
	 *
	 * @access public
	 * @param string $fileName 所要生成的文件名
	 * @param array $data csv数据内容, 注:本参数为二维数组
	 * @return void
	 */
	public static function makeCsv($fileName, $data, $csv_conf = []) {

		//参数分析
		if (!$fileName || !$data || !is_array($data)) {
			return false;
		}
		if (stripos($fileName, '.csv') === false) {
			$fileName .= '.csv';
		}
		
		// 'delim' => ",", 
		// 'newline' => "\n", 
		// 'enclosure' => '"',
		extract(array_merge(self::$_csv_conf, $csv_conf));

		//分析$data内容
		$content = '';
		foreach ($data as $lines) {
			if ($lines && is_array($lines)) {
				foreach ($lines as $key=>$value) {
					if (is_string($value)) {
						if (strpos($value, $enclosure) !== FALSE) {
							$lines[$key] = $enclosure . str_replace($enclosure, $enclosure.$enclosure, $value) . $enclosure;
						} else {
							$lines[$key] = "$enclosure$value$enclosure";
						}
					}
				}
				$content .= implode($delim, $lines) . $newline;
			}
		}

		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Expires:0');
		header('Pragma:public');
		header("Cache-Control: public");
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=" . $fileName);

		echo $content;
	}
	
	public static function takeCsvKV($data_, $csv_conf = []) {
		
		$data = [];
		foreach ($data_ as $k => $v)
		{
			$data[] = [$k, $v];
		}
		
		// 'delim' => ",", 
		// 'newline' => "\n", 
		// 'enclosure' => '"',
		extract(array_merge(self::$_csv_conf, $csv_conf));

		//分析$data内容
		$content = '';
		foreach ($data as $lines) {
			if ($lines && is_array($lines)) {
				foreach ($lines as $key=>$value) {
					if (is_string($value)) {
						if (strpos($value, $enclosure) !== FALSE) {
							$lines[$key] = $enclosure . str_replace($enclosure, $enclosure.$enclosure, $value) . $enclosure;
						} else {
							$lines[$key] = "$enclosure$value$enclosure";
						}
					}
				}
				$content .= implode($delim, $lines) . $newline;
			}
		}

		return $content;
	}
}

/* application/third_partly/doitphp/libraries/csv.php */