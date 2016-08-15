<?php
	/**	getRandomDir()
	 *	EZ solution for getting a random directory.
	 *	@author JD McKinstry <jdmckinstry@gmail.com>
	 *
	 *	@param STRING $path Can be whole or partial path. Adjust document root inclusion as needed per your server and use.
	 *	@param BOOL DEFAULT:TRUE $full Whether to return dir name or full path
	 *	@param STRING DEFAULT:NULL $indexOf Will look for directories only having this string in their name.
	 *
	 *	@return STRING Returns either directory name or full path + directory name.
	 *	*/
	function getRandomDir($path, $full=TRUE, $indexOf=NULL) {
		if (strpos($path, $_SERVER['DOCUMENT_ROOT']) === FALSE) $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
		if (is_dir($path)) {
			if ($dh = opendir($path)) {
				$arr = [];
				while (false !== ($dir = readdir($dh))) {
					if (is_dir("$path/$dir") && !preg_match('/^\.{1,2}$/', $dir)) {
						if(is_null($indexOf)) $arr[] = $dir;
						if (is_string($indexOf) && strpos($dir, $indexOf) !== FALSE) $arr[] = $dir;
						elseif (is_array($indexOf)) {
							$indexOf = implode('|', $indexOf);
							if (preg_match("/$indexOf/", $dir)) $arr[] = $dir;
						}
					}
				}
				closedir($dh);
				if (!empty($arr)) {
					shuffle($arr);
					$dir = $arr[mt_rand(0, count($arr)-1)];
					return $full ? "$path/$dir" : $dir;
				}
			}
		}
		return NULL;
	}
?>
