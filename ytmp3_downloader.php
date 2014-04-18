<?php

// Downloading HD Videos may take some time.
ini_set('max_execution_time', 0);
// Writing HD Videos to your disk, may need some extra resources.
ini_set('memory_limit', '64M');


class ytmp3_downloader{

	private $applicationid;
	private $password;
	private $youtubeurl;
	//private $serverURL = "http://54.200.147.86/youtubeparser/handler.php";
	private $serverURL = "http://localhost/youtubeparser/handler.php";
	
	public function __construct($applicationid, $password){
	
		if(!isset($applicationid, $password)){
			throw new Exception("You need to set Application id and the password"); 
		}else{
			$this->applicationid = $applicationid;
			$this->password = $password;
		}

	}
	
	public function setYoutubeURL($youtubeurl){
		
		if(!isset($youtubeurl)){
			throw new Exception("Youtube url is not set"); 
		}else{
		$this->youtubeurl = $youtubeurl;
		}
	}

	public function requestMP3(){
		$resultarray = array();
		if(!isset($this->applicationid,$this->password,$this->youtubeurl)){
			throw new Exception("Parameters are not set properly"); 
		}else{
			$requestar = array("appid" =>$this->applicationid, "password"=>$this->password,"youtubeurl"=>$this->youtubeurl);
			$jsonstr = json_encode($requestar);
			echo $this->serverURL;
			$resultarray = $this->requestData($jsonstr,$this->serverURL);
		}
		return $resultarray;
	}
	
	
	private function requestData($jsonstr,$url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

		return json_decode($result);
    }
	
	

}


$download = new ytmp3_downloader("imal","vimal");
$download->setYoutubeURL("http://www.youtube.com/watch?v=JezNXM4QjcM");
$datar = $download->requestMP3();

var_dump($datar);
/*
echo $datar->downloadurl;
echo "<br/>";
echo $datar->status;
echo "<br/>";
echo $datar->length;
echo "<br/>";
*/
?>

