import pafy
import os
import uuid
import sys
import json

url = str(sys.argv[1])
durationtime =int(str(sys.argv[2]))

video = pafy.new(url)
bestaudio = video.getbestaudio()
filename = str(uuid.uuid4())

serverurl = "http://54.200.147.86/you-mp3-parser/"
downloadingfile = "M4P/" + filename + "." + bestaudio.extension
convertedfile = "M4P/"+filename+".mp3"

time = int(video.length)
status  = "ERROR"
downloadlink = ""
coder =40

if(5 <= time and time <= durationtime):
	bestaudio.download(filepath=downloadingfile,quiet=True)

	#os.system("C:/ffmpeg/bin/ffmpeg -v 5 -y -i "+downloadingfile+" -acodec libmp3lame -ac 2 -ab 192k  "+convertedfile)
	#os.remove(downloadingfile)
	downloadlink = serverurl+"Dmp.php?i="+filename+".mp3"
	status = "SUCCESS"
	coder = 100
l1 = {	
		'title': str(video.title) ,
		'author':str(video.author),
		'videoid': str(video.videoid),
		'duration': str(video.duration),
		'length': str(video.length),
		'rating': str(video.rating),
		'views': str(video.viewcount),
		'thumbnail': str(video.thumb),
		'keywords': str(video.keywords),
		'downloadurl': downloadlink,
		'responsestate': status,
		'code' : coder,
		'durl' : downloadingfile,
		'murl' : convertedfile
	}

jsonstr = json.dumps(l1)
print (jsonstr)