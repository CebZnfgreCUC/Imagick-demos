<?php

namespace ImagickDemo\ImagickDraw;

class setClipRule extends ImagickDrawExample {

    function renderDescription() {
        return "";
    }

    function renderImage() {

        $draw = new \ImagickDraw();

        $strokeColor = new \ImagickPixel($this->strokeColor);
        $fillColor = new \ImagickPixel($this->fillColor);

        $draw->setStrokeColor($strokeColor);
        $draw->setFillColor($fillColor);

        $draw->setStrokeOpacity(1);
        $draw->setStrokeWidth(2);


//\Imagick::FILLRULE_EVENODD
//\Imagick::FILLRULE_NONZERO

        $clipPathName = 'testClipPath';

        $draw->pushClipPath($clipPathName);

        $draw->setClipRule(\Imagick::FILLRULE_EVENODD);

        $draw->rectangle(0, 0, 300, 500);
        $draw->rectangle(200, 0, 500, 500);

        $draw->popClipPath();

        $draw->setClipPath($clipPathName);


        $draw->rectangle(200, 200, 300, 300);

//Create an image object which the draw commands can be rendered into
        $imagick = new \Imagick();
        $imagick->newImage(500, 500, $this->backgroundColor);
        $imagick->setImageFormat("png");

//Render the draw commands in the ImagickDraw object 
//into the image.
        $imagick->drawImage($draw);

//Send the image to the browser
        header("Content-Type: image/png");
        echo $imagick->getImageBlob();

    }

}




 