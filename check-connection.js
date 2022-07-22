

onmessage = function () {
    fetch('upload.php')
        .then( response => response.text() )
        .then( text => {
            this.postMessage( text )
            //$('.slider').slick('removeSlick', 0)
        } )
    // fetch('https://loto.kavavdigital.com/wp-json/wp/v2/media')
    //     .then( response => response.json() )
    //     .then( json => {
    //         postMessage(JSON.stringify(json));
    //     })
};