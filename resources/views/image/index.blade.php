<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
    <style>
        input{
            display: block;
        }
    </style>
</head>
<body>
    <form action="uploadimage" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="image" id="image" accept="image/*">
        <input type="submit" value="Subir">
    </form>    
</body>
</html>