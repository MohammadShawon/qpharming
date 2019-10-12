<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('SNAPPY_PDF_BIN'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => env('SNAPPY_IMG_BIN',base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64')),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
