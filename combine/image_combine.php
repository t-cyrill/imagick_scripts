<?php
const DOT_WIDTH = 48;
const DOT_HEIGHT = 48;

$pattern = __DIR__ . '/ドット絵_name_changed/*.png';
$source_dir = dirname($pattern);

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
$height = DOT_HEIGHT;
// $height = count($data) * DOT_HEIGHT;

// Note:
foreach ($data as $row_num => $row) {
    $base = new Imagick();
    $base->newImage($width, $height, new ImagickPixel('transparent'));

    foreach ($row as $column_num => $file) {
        $image = new Imagick($file);
        // $base->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $column_num * DOT_WIDTH, $row_num * DOT_HEIGHT);
        $base->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $column_num * DOT_WIDTH, 0);
        $image->clear();
    }

    $base->setImageFormat('png');
    $base->writeImages(dirname($source_dir) . "/${row_num}.png", true);
    $base->clear();
}
