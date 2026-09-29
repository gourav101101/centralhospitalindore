<?php

// Keep the generated PNG masters and produce smaller images for the website.
foreach (['exterior-preview', 'reception-preview'] as $name) {
    $base = __DIR__.'/../public/images/hospital/'.$name;
    $image = imagecreatefrompng($base.'.png');
    if (!$image || !imagewebp($image, $base.'.webp', 86)) {
        throw new RuntimeException('Could not optimize '.$name);
    }
    echo $name.': '.imagesx($image).'x'.imagesy($image).PHP_EOL;
    imagedestroy($image);
}
