<?php
/**
 * Created by PhpStorm.
 * User: phu
 * Date: 5/23/17
 * Time: 22:05
 */



echo '<pre>';print_r($_FILES);


$path = $_SERVER['DOCUMENT_ROOT'] . '/resize-image/uploads/';

$name = $_FILES["img"]["name"];
if ( file_exists($path . $name) ) {
    $name = date('Ymdhis') . '_' . $name;
}

//upload
move_uploaded_file($_FILES["img"]["tmp_name"], $path . $name);
echo '<br>upload ok';

//resizeaaa

function createThumbs( $pathToFolder, $fname, $pathToThumbs, $thumbWidth )
{
    $info = pathinfo($pathToFolder . $fname);
    $ext = strtolower($info['extension']);

    switch ($ext) {
        case 'jpg':
            $img = imagecreatefromjpeg( "{$pathToFolder}{$fname}" );
            $width = imagesx( $img );
            $height = imagesy( $img );

            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
            break;
        case 'png':
            $img = imagecreatefrompng( "{$pathToFolder}{$fname}" );
            $width = imagesx( $img );
            $height = imagesy( $img );

            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );
            break;
        case 'gif':
            $img = imagecreatefromgif( "{$pathToFolder}{$fname}" );
            $width = imagesx( $img );
            $height = imagesy( $img );

            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagegif( $tmp_img, "{$pathToThumbs}{$fname}" );
            break;
    }
}
createThumbs($path, $name, $path . '300/', 300);

echo '<pre>resize ok';
//print_r($img);
echo '</pre>';


echo '<br><a href="index.html">form</a>';