const submitBtn = document.getElementById('submitBtn');
const form = document.getElementById('form');

// TODO: send ajaxRequest to log scan

submitBtn.addEventListener('click', (e) => {
    e.preventDefault();

    let coords = location_handler.getCoords();

    if(!coords){
        ALERT.append_notice('Unable to get location. Try logging out and scanning again.', ALERT.WARNING);
        return;
    }

    // TODO: send ajaxRequest on submission

    // ajaxRequest((response) => {
    //     console.log(JSON.stringify(response));
    // }, 'qr_form', {
    //     location: 'latitude 120391203',
    //     storename: 'amogus store'
    // });
});


// fetch('http://localhost/grtracker/service.php', {
//     method: 'POST',
//     headers: {
//         'Accept': 'application/json',
//         'Content-Type': 'application/json'
//     },
//     body: JSON.stringify({
//         method: 'qr_form',
//         params: {location:"Latitude: -33.8248911<br>Longitude: 18.4855064",storename:"storename"}
//     })
// }).then(response => response.json()).then(response => console.log(JSON.stringify(response)));