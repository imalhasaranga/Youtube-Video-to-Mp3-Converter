<?php
$files = glob('M4P/*');

foreach($files as $file){ // iterate files
  if(is_file($file)){

	if(substr($file,strrpos($file, ".") ,strlen($file)) != ".html"){
		unlink($file);
	}
  }
   
}


?>