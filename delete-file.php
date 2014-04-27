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
    <h1>File Manager: Delete Files</h1>
    <p><?  
   for($i=0;$i<count($_POST['files']);$i++){
     echo "Deleted: ";
     echo $_POST['files'][$i] . "<br>";
     $path = "/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/" . $_POST['files'][$i]; 
     unlink($path);
   }
    
    ?></p>
  
  </body>
</html>


<?

?>