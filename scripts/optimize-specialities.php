<?php
// Produce lightweight card images, preserving the generated originals.
$directory = __DIR__.'/../public/images/specialities';
foreach (glob($directory.'/*.png') as $source) {
    $destination = substr($source, 0, -4).'.webp';
    if (is_file($destination) && filemtime($destination) >= filemtime($source)) continue;
    $image = imagecreatefrompng($source);
    $scaled = imagescale($image, 960, -1, IMG_BICUBIC_FIXED);
    imagewebp($scaled, $destination, 82);
    imagedestroy($scaled);
    imagedestroy($image);
    echo basename($destination).' '.round(filesize($destination)/1024)." KB\n";
}
