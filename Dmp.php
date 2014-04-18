<?php

//filedw.php

if($_GET["i"]){

$v = $_GET["i"];

$file_name = $v;
$file_url = 'M4P/' . $file_name;


	if(file_exists($file_url)){
	  header('Content-Description: File Transfer');
	  header('Content-Type: application/octet-stream');
	  header('Content-Disposition: attachment; filename='.basename($file_url));
	  header('Content-Transfer-Encoding: binary');
	  header('Expires: 0');
	  header('Cache-Control: must-revalidate');
	  header('Pragma: public');
	  header('Content-Length: ' . filesize($file_url));
	  ob_clean();
	  flush();
	  if (readfile($file_url)) 
	  {
		//unlink($file_url);
	  }
	}else{
		echo "ERROR : either file does not exist or it has been downloaded";
	}
}

?>