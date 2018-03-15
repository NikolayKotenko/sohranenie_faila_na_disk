<html>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<body>
<h1>Basic File Upload</h1>
<form method="post" action="upload.php" enctype="multipart/form-data">
    <label for="inputfile">Upload File</label>
    <input name="upload[]" type="file" multiple="multiple" />
    <input type="submit" value="Click To Upload">
</form>
</body>
</html>