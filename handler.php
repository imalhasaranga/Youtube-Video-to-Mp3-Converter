 <?php
 require_once "keyvalpair.php";
 

 $error = array("responsestate"=>"ERROR","code"=>32);
 
 $data = json_decode(file_get_contents('php://input'), true);
 
	if(isset($data)){
		if(isset($data["appid"],$data["password"],$data["youtubeurl"] )){
			
			if(array_key_exists($data["appid"], $keyval)){
				if($keyval[$data["appid"]] == $data["password"]){
						$x = $data["youtubeurl"];
						$y = "1200";
						if($data["appid"] == "" && $data["password"] == ""){
							$y = "20";
						}

						$now = new DateTime();
						$datafor = $now->format('Y-m-d H:i:s'); 
						$content = $datafor."      ".$x."---Time Duration :".$y;
						file_put_contents('log.txt',"$content\r\n",FILE_APPEND);
		
						$str = exec("mp3downloadlink.py "."'".$x."' "."".$y."", $output);
						if(array_key_exists('0', $output)){
				
							$downloaddata = json_decode($output[0],true);
							$durl = $downloaddata["durl"];
							$murl = $downloaddata["murl"];
							unset($downloaddata["durl"]);
							unset($downloaddata["murl"]);
							if($downloaddata["code"] == 100){
								$str = exec("C:/ffmpeg/bin/ffmpeg -v 5 -y -i ".$durl." -acodec libmp3lame -ac 2 -ab 192k  ".$murl);
								unlink($durl);
							}
							
							
							echo json_encode($downloaddata );
						}else{
							echo json_encode(array("responsestate"=>"ERROR","code"=>34));
						}
					}else{
						echo json_encode(array("responsestate"=>"ERROR","code"=>30));
					}
			}else{
				echo json_encode(array("responsestate"=>"ERROR","code"=>30));
			}

		}else{
			echo json_encode( $error);
		}
	}else{
		echo json_encode( $error);
	}
 
 ?>