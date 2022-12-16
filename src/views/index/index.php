<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title ?></title>
    </head>
    <body>
        <img src="<?php echo $resized_image; ?>"/>
        <img src="<?php echo $cropped_image; ?>"/>
        <hr>
        <ol>
            <li><a href="/cat-323262_1920.jpg/resize/width/320/height/240">Resize (320x240)</a></li>
            <li><a href="/cat-1045782_1920.jpg/crop/width/640/height/480">Crop (640x480)</a></li>
            <li><a href="/cat-1045782_1920.jpg/crop/width/640/height/480/x/350/y/180">Crop with offset (640x480+350+180)</a></li>
        </ol>
    </body>
</html>
