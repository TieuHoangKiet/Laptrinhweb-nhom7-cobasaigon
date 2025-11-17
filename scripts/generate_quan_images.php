<?php
$dir = __DIR__ . '/../public/images';
if (!file_exists($dir)) mkdir($dir, 0777, true);
for ($i = 1; $i <= 10; $i++) {
    $filename = $dir . "/quan-{$i}.png";
    $width = 600;
    $height = 600;
    $img = imagecreatetruecolor($width, $height);
    $bg = imagecolorallocate($img, 240, 240, 240);
    imagefilledrectangle($img, 0, 0, $width, $height, $bg);
    $textcol = imagecolorallocate($img, 30, 30, 30);
    $fontSize = 5; // built-in font
    $text = "quan-{$i}";
    $textWidth = imagefontwidth($fontSize) * strlen($text);
    $textHeight = imagefontheight($fontSize);
    $x = intval(($width - $textWidth) / 2);
    $y = intval(($height - $textHeight) / 2);
    imagestring($img, $fontSize, $x, $y, $text, $textcol);
    imagepng($img, $filename);
    imagedestroy($img);
    echo "Created: {$filename}\n";
}
echo "Done generating images.\n";
