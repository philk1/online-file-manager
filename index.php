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
<h1>File Manager &mdash; View Files</h1>
<form action="delete-file.php" method="post">
<table>
  <thead>
    <tr>

      <th></th>
      <th>
        Name
        <a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=name&amp;order=ascending">&darr;</a><a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=name&amp;order=descending">&uarr;</a>
      </th>
      <th>
        Size
        <a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=size&amp;order=ascending">&darr;</a><a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=size&amp;order=descending">&uarr;</a>
      </th>
      <th>

        Type
        <a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=type&amp;order=ascending">&darr;</a><a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=type&amp;order=descending">&uarr;</a>
      </th>
      <th>
        Modified
        <a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=modified&amp;order=ascending">&darr;</a><a href="/~philk1/d18d91faa3ac7bf4/web/p2/index.php?sort=modified&amp;order=descending">&uarr;</a>
      </th>
    </tr>
  </thead>
  <tbody>
    <?
	function convertBytes($bytes){
	  if($bytes > 1000){
	    return round($bytes / 1024 , 0) . " KB";
	  }
	  else{return $bytes . " B";}
	}

  $allFiles=array();
  $a = opendir("/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/");
  $finfo = new finfo(FILEINFO_MIME_TYPE);
while(($file = readdir($a))){
  if($file=="."){
    continue;
  }
  if($file==".."){
    continue;
    }
  $name = $file;
  $filePath = "/home/csee1/philk1/www-data/d18d91faa3ac7bf4/read-write/storage/" . $file;
  $date = date("M d Y g:i a", filemtime($filePath));
  $size = filesize($filePath);
  $type = $finfo->file($filePath);
  if($type=="text/html"){$type="HTML Document";}
  if($type=="text/plain"){$type="Plain Text Document";}
  if($type=="image/jpeg" || $type=="image/jpg"){$type="JPEG Image";}
  if($type=="image/png"){$type="PNG Image";}
  if($type=="image/gif"){$type="GIF Image";}
  $finalFile = array('name'=>$name,'size'=>$size,'type'=>$type, 'date'=>$date);
  array_push($allFiles,$finalFile);
}
if(count($allFiles)==0){
  echo "<tr><td>No files - please <a href='/~philk1/d18d91faa3ac7bf4/web/p2/upload-file.php'>upload</a> some</td></tr>";
}

if($_GET['sort']=="name" && $_GET['order']=="ascending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($a['name'],$b['name']); });
}
if($_GET['sort']=="name" && $_GET['order']=="descending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($b['name'],$a['name']); });
}
if($_GET['sort']=="size" && $_GET['order']=="ascending"){
  uasort($allFiles, function($a,$b){ return intval($a['size']) > intval($b['size']); });
}
if($_GET['sort']=="size" && $_GET['order']=="descending"){
  uasort($allFiles, function($a,$b){ return intval($a['size']) < intval($b['size']); });
}
if($_GET['sort']=="type" && $_GET['order']=="ascending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($a['type'],$b['type']); });
}
if($_GET['sort']=="type" && $_GET['order']=="descending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($b['type'],$a['type']); });
}
if($_GET['sort']=="modified" && $_GET['order']=="ascending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($a['date'],$b['date']); });
}
if($_GET['sort']=="modified" && $_GET['order']=="descending"){
  uasort($allFiles, function($a,$b){ return strcasecmp($b['date'],$a['date']); });
}

$str = "";
foreach($allFiles as $file){
  $readableSize = convertBytes($file['size']);
  $str.="<tr>";
  $str.="<td><input type='checkbox' name='files[]' value='${file['name']}' /></td>";
  $str.="<td><a href='get-file.php?name=${file['name']}'>${file['name']}</a></td>";
  $str.="<td class='number'>$readableSize</td>";
  $str.="<td>${file['type']}</td>";
  $str.="<td>${file['date']}</td>";
  $str.="</tr>";
  echo $str;
  $str="";
}

    ?>


  </tbody>
</table>
<br />
<input type="submit" value="Delete Selected Files" />
</form>

  </body>
</html>