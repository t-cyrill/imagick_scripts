<?php
const DOT_WIDTH = 48;
const DOT_HEIGHT = 48;

$pattern = __DIR__ . '/完成済ドット絵/*.png';
$source_dir = dirname($pattern);
$out_dir = dirname($source_dir);

$files = glob($pattern);
$data = [];
foreach ($files as $file) {
    $num_1 = substr(basename($file), 0, 2);

    if (!isset($data[$num_1])) {
        $data[$num_1] = [];
    }
    $data[$num_1][] = $file;
}

// Note: Figure image size
$width = max(array_map('count', $data)) * DOT_WIDTH;
$height = DOT_HEIGHT * 2;
// $height = count($data) * DOT_HEIGHT;

// Note:
foreach ($data as $row_num => $row) {
    $base = new Imagick();
    $base->newImage($width, $height, new ImagickPixel('transparent'));

    foreach ($row as $column_num => $file) {
        $image = new Imagick($file);
        $base->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $column_num * DOT_WIDTH, DOT_HEIGHT * 0);

        // 反転させたものを直下に配置する
        $image->flopImage();
        $base->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $column_num * DOT_WIDTH, DOT_HEIGHT * 1);
        $image->clear();
    }

    $base->setImageFormat('png');
    $base->writeImages($out_dir . "/${row_num}.png", true);
    $base->clear();
}
