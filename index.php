<?php 

require 'vendor/autoload.php';

$url_bank = "https://loto.kavavdigital.com/wp-json/wp/v2/media";

$total_images = count(glob('store/{*.jpg}',GLOB_BRACE)) | 0; 

try{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $url_bank);
    $response =  json_decode( $response->getBody() );

    $downloader = new \greeflas\tools\ImageDownloader([
        'class' => \greeflas\tools\validators\FakeValidator::class
    ]);

    $index = 0;
    foreach($response as $media) {
        $url = $media->source_url;
        $downloader->download($url, 'store', 'slick'.$index.'.jpg');
        $index += 1;
    }

    if( $total_images > $index ){
        for( $i = $index; $i <= $total_images-1; $i++ ) {
            unlink("store/slick".$i.".jpg");
        }
    }

}
catch(err){
    $index = $total_images;
}


include 'webview.php';

