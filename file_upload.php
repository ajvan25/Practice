<?php
function fileUpload($picture)
{

    if ($picture["error"] == 4) {
        $pictureName = "product.png";
        $message = "No picture has been chosen, but you can upload an image later :)";
    } else {
        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "Ok" : "Not an image";
    }

    if ($message == "Ok") {
        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION)); // taking the extension data from the image
        $pictureName = uniqid("") . "." . $ext; // changing the name of the picture to random string and numbers
        $destination = "pictures/{$pictureName}"; // where the file will be saved
        move_uploaded_file($picture["tmp_name"], $destination); // moving the file to the pictures folder
    }

    return [$pictureName, $message]; // returning an array with two values, the name of the picture and the message
}
