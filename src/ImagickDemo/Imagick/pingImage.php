<?php

namespace ImagickDemo\Imagick;


class pingImage extends \ImagickDemo\Example {

    /**
     * @var \ImagickDemo\Control\ImageControl
     */
    private $control;
    
    function __construct(\ImagickDemo\Control\ImageControl $control) {
        $this->control = $control;
    }
    
    function renderImageURL() {
        return "";
    }
    
    function getControl() {
        return $this->control;
    }
    
    function renderImage() {
    }

    function renderDescription() {
        echo "This method can be used to query image width, height, size, and format without reading the whole image in to memory.";
        
        $image = new \Imagick();
        $image->pingImage(realpath($this->control->getImagePath()));
        echo "For file: ".basename($this->control->getImagePath())." <br/>";
        echo "Width is " . $image->getImageWidth() . "<br/>";
        echo "Height is " . $image->getImageHeight() . "<br/>";
    }
}