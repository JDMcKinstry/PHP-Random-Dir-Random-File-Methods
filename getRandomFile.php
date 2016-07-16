<?php
	/**	getRandomFile()
	 *	EZ solution for getting a random file.
	 *	@author JD McKinstry <jdmckinstry@gmail.com>
	 *
	 *	@param STRING $path Can be whole or partial path. Adjust document root inclusion as needed per your server and use.
	 *	@param STRING|ARRAY DEFAULT:NULL $type Will attempt to math and only look at files having given file path. To include more than one type, use an array.
	 *	@param BOOL|STRING DEFAULT:TRUE If bool, determines whether to return file contents or file name. If STRING == 'path', will return full file path.
	 *
	 *	@return STRING Can return String of filename, or full path + filename, or file contents. Default NULL
	 *	*/
	function getRandomFile($path, $type=NULL, $contents=TRUE) {
		if (strpos($path, $_SERVER['DOCUMENT_ROOT']) === FALSE) $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
		if (is_dir($path)) {
			if ($dh = opendir($path)) {
				$arr = [];
				while (false !== ($file = readdir($dh))) {
					//	not a directory
					if (!is_dir("$path/$file") && !preg_match('/^\.{1,2}$/', $file)) {
						//	fits file type
						if(is_null($type)) $arr[] = $file;
						elseif (is_string($type) && preg_match("/\.($type)$/", $file)) $arr[] = $file;
						elseif (is_array($type)) {
							$type = implode('|', $type);
							if (preg_match("/\.($type)$/", $file)) $arr[] = $file;
						}
					}
				}
				closedir($dh);
				if (!empty($arr)) {
					shuffle($arr);
					$file = $arr[mt_rand(0, count($arr)-1)];
					return empty($contents) ? $file : ($contents == 'path' ? "$path/$file" : file_get_contents($file));
				}
			}
		}
		return NULL;
	}
?>
