<?php

namespace ImagickDemo\Imagick;


class transformImage extends ImagickExample  {

    function renderDescription() {
    }

    function renderImage() {
        $imagick = new \Imagick(realpath($this->imagePath));
        $newImage = $imagick->transformimage("400x600", "200x300");
        header("Content-Type: image/jpg");
        echo $newImage->getImageBlob();
    }
}