

onmessage = function (event) {
    fetch('upload.php')
        .then( response => console.log(response.json()) )
        .then( data => {
            // if( JSON.stringify(data) != JSON.stringify(event.data) ) {
                // this.postMessage( data )
            // }
            //$('.slider').slick('removeSlick', 0)
        } )
    // fetch('https://loto.kavavdigital.com/wp-json/wp/v2/media')
    //     .then( response => response.json() )
    //     .then( json => {
    //         postMessage(JSON.stringify(json));
    //     })
};