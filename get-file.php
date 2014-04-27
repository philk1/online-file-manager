<?
$file = $_GET['name'];
$path = "/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/" . $file;
$finfo = new finfo(FILEINFO_MIME_TYPE); 
$type=$finfo->file($path);

if($type=="image/jpeg"){
  header('Content-type: image/jpeg');
}
if($type=="image/gif"){
  header('Content-type: image/gif');
}
if($type=="image/png"){
  header('Content-type: image/png');
}
if($type=="text/html"){
  header('Content-type: text/html');
}
if($type=="text/plain"){
  header('Content-type: text/plain');
}
echo file_get_contents($path);
?>
