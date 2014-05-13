<?php


namespace ImagickDemo\Imagick;


class tintImage extends \ImagickDemo\Example {

    /**
     * @var \ImagickDemo\Control\ControlCompositeXRXGXBXA
     */
    private $tintAndImageControl;

    /**
     * @var int|null|string
     */
    private $imagePath;
    
    function __construct(\ImagickDemo\Control\ControlCompositeXRXGXBXA $tintAndImageControl) {
        $this->tintAndImageControl = $tintAndImageControl;
    }
    
    function renderDescription() {
    }

    function renderImageURL() {
        return $this->tintAndImageControl->getURL();
    }

    /**
     * @return \ImagickDemo\Control
     */
    function getControl() {
        return $this->tintAndImageControl;
    }


    function renderImage() {

        $red = $this->tintAndImageControl->getR();
        $green = $this->tintAndImageControl->getG();
        $blue = $this->tintAndImageControl->getB();
        $alpha = $this->tintAndImageControl->getA();
        $alpha = $alpha / 100;
        
        
        $imagick = new \Imagick();
        $imagick->newPseudoImage(200, 200, 'gradient:');

        $tint = new \ImagickPixel("rgb($red, $green, $blue)");
        $imagick->tintImage($tint, $alpha);
        $imagick->setImageFormat('png');
        header("Content-Type: image/png");
        echo $imagick->getImageBlob();
    }
    

    function renderImageasdd() {
        //$tintControl = $this->tintAndImageControl->getTintControl();
        $red = 255;//$tintControl->getR();
        $green = 255;//$tintControl->getG();
        $blue = 0;//$tintControl->getB();
        $alpha = 200;//$tintControl->getA();
        
//        var_dump($red, $green, $blue, $alpha);
//        exit(0);

        $tinty = new \ImagickPixel('rgba(255, 0, 0, 1)');

        $imagick = new \Imagick();
        $imagick->newPseudoImage(200, 200, 'gradient:');
        //$imagick->sigmoidalcontrastimage(true, 14, 90);
        
        
        //$imagick = new \Imagick(realpath($this->imagePath));
        //$imagick->setImageType(\Imagick::IMGTYPE_GRAYSCALE);
        //$imagick->tintImage("rgb($red, $green, $blue)", $alpha);
        $imagick->tintImage($tinty, $alpha);

        $imagick->setimageformat('png');
        
        header("Content-Type: image/png");
        echo $imagick->getImageBlob();
    }
}