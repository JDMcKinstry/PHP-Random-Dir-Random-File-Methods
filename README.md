# PHP Random Dir Random File Methods
Simple and easy methods for getting a random file or directory.

---

## getRandomFile($path [, $type=NULL [, $contents=TRUE]])

#### Use as simple as:

	$this->getRandomFile('directoryName');
	//	would pull random contents of file from given directory
	
	$this->getRandomFile('directoryName', 'php');
	//	|OR|
	$this->getRandomFile('directoryName', ['php', 'htm']);
	//	one gets a random php file 
	//	OR gets random php OR htm file contents
	
	$this->getRandomFile('directoryName', NULL, FALSE);
	//	returns random file name
	
	$this->getRandomFile('directoryName', NULL, 'path');
	//	returns random full file path
	
---

## getRandomDir($path [, $full=TRUE [, $indexOf=NULL]])

#### Use as simple as:

	$this->getRandomDir('parentDirectoryName');
	//	returns random full directory path of dirs found in given directory
	
	$this->getRandomDir('parentDirectoryName', FALSE);
	//	returns random directory name
	
	$this->getRandomDir('parentDirectoryName', FALSE, 'dirNameContains');
	//	returns random directory name

---

## Full Use Example

### Use in Combo Like:

	$dir = $this->getRandomDir('dirName');
	$file = $this->getRandomFile($dir, 'mp3', FALSE);
	//	returns a random mp3 file name. 
	//	Could be used to load random song via ajax.
