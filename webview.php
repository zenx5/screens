<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <style>
        body{
            margin: 0;
        }
        .slider, img{
            width:100vw !important;
            height: 100vh !important;
        }
    </style>
    <script>
        
    </script>
</head>
<body>
    <div class="slider">
        <?php for($i = 0; $i < $index; $i++ ): ?>
            <img src="store/slick<?=$i?>.jpg" />
        <?php endfor; ?>
    </div>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        let worker = new Worker('check-connection.js')

        worker.addEventListener("message", function(event){
            JSON.parse(event.data)
        });

        $(document).ready(function(){
            $('.slider').slick({
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                dots: false
            });

            $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
                if(currentSlide === 0) {
                    worker.postMessage("");
                }

            })
        });
        
        

        

    </script>
</body>
</html>