<?php
require_once('src/class.filedownloader.php');


$File = new FileDownloader();

//Download file to root directory
echo $File->Download('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png','');

//Download file to Uploads directory
echo $File->Download('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png','Uploads');

//Download the file to the uploads folder and rename it: NewGoogle (Optional)
echo $File->Download('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png','Uploads','NewGoogle');

?>
