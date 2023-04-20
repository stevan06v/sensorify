<?php

class ImageUploader{

    private $path;

    function __construct($dir){
        $this->path = $dir;
    }

    private function create_upload_dir(){
        if(!is_dir($this->path)){
            mkdir($this->path, 0777);
        }
    }

    # 0 0 for no compression
    function upload($x,$y)
    {
        $file_dest="";
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_error = $_FILES['file']['error'];
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                
                $this->create_upload_dir();

                $file_dest = $this->path . $file_name_new;

                move_uploaded_file($file_tmp_name, $file_dest);

                if ($x != 0 && $y != 0) {
                    $this->compress_image($file_dest, $file_actual_ext, $x, $y);
                }

                # returns destination for database saving-purposes
                return $file_dest;
            }else{
                throw new Exception("Error Processing Request", 1);
            }
        }
    }

    private function compress_image($dest, $file_extenetion, $x, $y)
    {
        $height = $y;
        $width = $x;
        if ($file_extenetion == "jpg" || $file_extenetion == "jpeg") {
            $image = imagecreatefromjpeg($dest);
            imagejpeg(imagescale($image, $width, $height), $dest);
        } else {
            $image = imagecreatefrompng($dest);
            imagepng(imagescale($image, $width, $height), $dest);
        }
    
    }
}


?>