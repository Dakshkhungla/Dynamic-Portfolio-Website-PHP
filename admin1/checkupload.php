<?php
function Upload($file, $dir)
{
    $target_file = $dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Extract file extension

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return "error";
    } else {
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
            return "error";
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return "success";
            } else {
                return "error";
            }
        }
    }
}
