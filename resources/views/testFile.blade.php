<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/store" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <button type="submit">save</button>
    </form>


</body>

</html>
