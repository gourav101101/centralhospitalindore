<?php
foreach (['arrival-concept','family-editorial','recovery-concept'] as $name) {
    $image = imagecreatefrompng(__DIR__.'/../public/images/atelier/'.$name.'.png');
    imagewebp($image, __DIR__.'/../public/images/atelier/'.$name.'.webp', 86);
    imagedestroy($image);
}
