<?php
const DEST_WIDTH = 150;
const DEST_HEIGHT = 150;

const SRC_X = 200;
const SRC_Y = 80;

// NOTE: 出力先
$dest_dir = __DIR__ . "/dest";
$pattern = __DIR__ . '/reimu_face_*.png';

is_dir($dest_dir) || mkdir($dest_dir, 0777, true);

// NOTE: 出力用画像
$base = create_image(DEST_WIDTH * count($files), DEST_HEIGHT);

$num = 0;
$files = glob($pattern);
foreach ($files as $file) {
    // NOTE: 画像をクロップする
    $image = crop_image($file);

    $base->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $num * DEST_WIDTH, 0);

    $image->clear();
    $num++;
}

$base->writeImages($dest_dir . "/dest.png", true);
$base->clear();

exit;

// NOTE: functions

function create_image($width, $height) {
    $base = new Imagick();
    $base->newImage($width, $height, new ImagickPixel('transparent'));
    $base->setImageFormat('png');

    return $base;
}

function crop_image($file) {
    $image = new Imagick($file);
    $image->cropImage(DEST_WIDTH, DEST_HEIGHT, SRC_X, SRC_Y);
    return $image;
}
