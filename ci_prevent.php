<?php 

$uploaded_file = $_FILES['file_name']['tmp_name'];
$command = "cat ".file_get_contents($uploaded_file);
$output = system($command);
<!-- form.html -->
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
Select image to upload:
   <input type="file" name="fileToUpload" id="fileToUpload">
   <input type="submit" value="Upload file" name="submit">
</form>

</body>
</html>
