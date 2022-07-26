<?php 

require 'vendor/autoload.php';

$url_bank = "https://loto.kavavdigital.com/wp-json/wp/v2/media";

$total_images = count(glob('store/{*.jpg}',GLOB_BRACE)) | 0;

$add = [];
$remove = [];

try{
    $client = new \GuzzleHttp\Client();
    $request = new \GuzzleHttp\Psr7\Request('GET', "https://loto.kavavdigital.com/wp-json/wp/v2/media");
    $promise = $client->sendAsync($request)->then(function ($response) {
        $total_images = count(glob('store/{*.jpg}',GLOB_BRACE)) | 0;

        $response =  json_decode( $response->getBody() );

        $downloader = new \greeflas\tools\ImageDownloader([
            'class' => \greeflas\tools\validators\FakeValidator::class
        ]);
    
        $index = 0;
        foreach($response as $media) {
            $add[] = [
                "local" => "<img src='store/slick".$index.".jpg' />",
                "index" => $index,
                "origin" => $media->source_url
            ];
            $url = $media->source_url;
            $downloader->download($url, 'store', 'slick'.$index.'.jpg');
            $index += 1;
        }
    
        if( $total_images > $index ){
            for( $i = $index; $i <= $total_images-1; $i++ ) {
                unlink("store/slick".$i.".jpg");
            }
        }
        echo json_encode($response);
    });
    $promise->wait();


    // $response = $client->get('https://loto.kavavdigital.com/wp-json/wp/v2/media');
    // $response = $client->request('GET', $url_bank);
    // echo json_encode($response);
    return;

}
catch(err){
    $index = $total_images;
}


echo json_encode([
    "count" => $index, 
    "slickAdd" => $add
]);


//include 'webview.php';

