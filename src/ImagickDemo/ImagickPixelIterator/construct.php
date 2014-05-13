<?php


namespace ImagickDemo\ImagickPixelIterator;


class construct extends \ImagickDemo\Imagick\ImagickExample  {

    function renderDescription() {
        return "";
    }

    function renderImage() {
        $imagick = new \Imagick(realpath($this->imagePath));
        //$imageIterator = $imagick->getPixelIterator();

        $imageIterator = new \ImagickPixelIterator($imagick);

        foreach ($imageIterator as $row => $pixels) { /* Loop trough pixel rows */
            foreach ($pixels as $column => $pixel) { /* Loop through the pixels in the row (columns) */
                /** @var $pixel \ImagickPixel */
                if ($column % 2) {
                    $pixel->setColor("rgba(0, 0, 0, 0)"); /* Paint every second pixel black*/
                }
            }
            $imageIterator->syncIterator(); /* Sync the iterator, this is important to do on each iteration */
        }

        header("Content-Type: image/jpg");
        echo $imagick;

    }
}