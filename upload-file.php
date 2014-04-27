<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>File Manager</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div id="demo">

      <div>
        <strong>Demo Functions</strong> (you neednt implement):
      </div>
      <a href="./delete.php" onclick="return confirm('Really delete all files?')">Delete All Files</a> |
      <a href="./load.php" onclick="return confirm('Really load sample files?')">Load Sample Files</a>
    </div>
    <div id="nav">

      <a href="index.php">View</a> | <a href="upload-file.php">Upload</a>
    </div>
<h1>File Manager &mdash; Upload Files</h1>
<form enctype="multipart/form-data" action="/~philk1/d18d91faa3ac7bf4/web/p2/upload-file.php" method="post">
<?
  if($_SERVER['REQUEST_METHOD']=='POST'){
  for($i=0;$i<5;$i++){
  $allowedExts = array("gif", "png", "jpeg", "plain", "html", "jpg","txt");
  $extension = end(explode(".", $_FILES["files"]["name"][$i]));
  if ((($_FILES["files"]["type"][$i] == "image/gif")
     || ($_FILES["files"]["type"][$i] == "image/jpeg")
     || ($_FILES["files"]["type"][$i] == "image/jpg")
     || ($_FILES["files"]["type"][$i] == "image/png")
     || ($_FILES["files"]["type"][$i] == "text/plain")
     || ($_FILES["files"]["type"][$i] == "text/html"))
     && ($_FILES["files"]["size"][$i] < 50000)
     && in_array($extension, $allowedExts)){
       if ($_FILES["files"]["error"][$i] > 0){
         echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
       }
       else{
	 if (file_exists("/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/" . $_FILES["files"]["name"][$i])){
	   echo $_FILES["files"]["name"][$i] . " already exists. <br>";
	 }
	 else if (move_uploaded_file($_FILES["files"]["tmp_name"][$i],"/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/" . $_FILES["files"]["name"][$i])){
	   echo "Successfully uploaded file: " . $_FILES["files"]["name"][$i] . "<br>";
	 }
	 else {
	   echo "IDK this is bad though.";
	 }

       }
  }
  else if($_FILES["files"]["name"][$i]==null){
    continue;
  }
  else{
    echo "Error uploading file " . $_FILES["files"]["name"][$i] . "<br>";
  }
  }
  }
?>

  <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
  <p><input type="file" name="files[]"/></p>

  <p><input type="file" name="files[]"/></p>
  <p><input type="file" name="files[]"/></p>
  <p><input type="file" name="files[]"/></p>
  <p><input type="file" name="files[]"/></p>
  <p><input type="submit" value="Upload" /></p>
</form>

  </body>
</html>
