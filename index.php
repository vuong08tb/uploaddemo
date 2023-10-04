<?php
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));

    $extensions= array("jpeg","jpg","png", "gif");

    if(in_array($file_ext,$extensions)=== false){
        $errors[] = "extension not allowed, please choose a JPEG, GIF, JPG or PNG file.";
    }

    if($file_size > 2097152){
        $errors[] = 'File size must be exactly 2 MB';
    }

    if(empty($errors) == true){
        move_uploaded_file($file_tmp,"images/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}

?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" onchange="previewImage(this)" />
    <input type="submit" value="Upload"/>
</form>

<div id="preview">
    <img id="image_preview" src="" alt="" style="max-width: 200px; max-height: 200px;">
</div>

<script>
    function previewImage(input) {
        // Lấy dữ liệu của ảnh được chọn
        var image = input.files[0];

        // Hiển thị xem trước ảnh
        var reader = new FileReader();
        reader.onload = function() {
            var img = document.getElementById('image_preview');
            img.src = reader.result;
        };
        reader.readAsDataURL(image);
    }
</script>
</body>
</html>
