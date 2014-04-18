## Youtube video to Mp3 Converter

This is an REST API written by me to convert any Youtube video to Mp3 format, recently one of my clients wanted to add a Youtube video to Mp3 conversion facility to his wordpress music site for his users. but unfortunately because of close nature of Youtube downloading there wasn’t a good API so I had to write my own.

Below is how the API works, by keeping API key and the Password empty you should be able to convert videos that has a length between 5 to 20 seconds.

=

###Project is having few dependencies

1. Python
2. ffmpeg

Please make sure that you have installed these before using the code

=

###Usage 

After configuring host the script in an remote server then write a Rest Client according to below json signature

##Request 
```json
{
 "appid" :"APPID",
 "password" :"PASSWORD",
 "youtubeurl" :"YOUTUBE URL OR VIDEO ID"
}
```

##Response

```json
{	
  'title': "VIDEO TITLE" ,
  'author': "VIDEO AUTHOR",
  'videoid': "VIDEO ID",
  'duration': "VIDEO DURATION",
  'length': "VIDEO LENGTH",
  'rating': "VIDEO RATING",
  'views': "NUMBER OF VIEWS",
  'thumbnail': "THUMBNAIL URL",
  'keywords': "VIDEO KEYWORDS",
  'downloadurl': "MP3 DOWNLOAD LINK",
  'responsestate': "STATUS",
  'code' : "CODE"
}
```

##Error Codes 

when the “responsestate” parameter returns “ERROR” that indicate that something has gone wrong so by checking the value of “code” parameter we can identify the issue

32	 Some Parameters have not set Properly
30	 Credential Mismatch
34	 Internal Server error or Invalid URL
40	 Video Length is out of bounds (Default Length is 5 – 20sec)

##SUCCESS codes  

when the “responsestate” parameter returns “SUCCESS” that indicates that everything has happened perfectly also you can confirm it by checking the value of “code” parameter as well

100	 Conversion completed successfully


###Using PHP Wrapper 

This is a simple client that I wrote please change its requesting domain to yours 

```php
<?php 
require_once 'ytmp3_downloader.php'; 

$url = "http://www.youtube.com/watch?v=4Yj8BYezxCc"; 
$download = new ytmp3_downloader("",""); 
$download->setYoutubeURL($url);
$datar = $download->requestMP3();

echo json_encode($datar);

?>

```

Download Basic PHP Wrapper below in the post : http://imalhasaranga.com/2014/02/26/youtube-video-to-mp3-converter-api

####This project is an experiment by me, Please suggest me any changes you would like, also it will be great if you can report problems by directly contacting me through my email imaa95@gmail.com

