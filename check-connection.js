

onmessage = function () {
    fetch('https://loto.kavavdigital.com/wp-json/wp/v2/media')
        .then( response => response.json() )
        .then( json => {
            postMessage(JSON.stringify(json));
        })
};