<?php 



function uploadImage($image){
    $extention=strtolower($image->extention());
    $fileName=time().rand(4,10000).".".$extention;
    $image->move("uploads",$fileName);
    return $fileName;
}



?>