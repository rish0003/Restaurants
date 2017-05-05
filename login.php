<form method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr> 
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" type="file" id="userfile"> 
</td>
<td width="80"></td>
<td colspan='2'><input name="upload"  type='submit''>
</tr>
</table>
</form>

<?php

$host='localhost';
$user ='root';
$pass ='root';
$db = 'wp_eatery';

$conn = new mysqli($host,$user,$pass,$db);


if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
    
$fileName = $_FILES['userfile']['name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$tmpName  = $_FILES['userfile']['tmp_name'];


$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    
    $fileName = addslashes($fileName);
}
include 'library/config.php';
include 'library/opendb.php';

$sql = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

  $result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo 'connect';
}

include 'library/closedb.php';

echo "<br>File $fileName uploaded<br>";
} 
?>