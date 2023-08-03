const coords = location_handler.getCoords();
const logoutBtn = document.getElementById('logout');
const submitBtn = document.getElementById('submitBtn');
const form = document.getElementById('form');

// Log scan
if(!coords){
    ALERT.append_notice('Unable to get location. Try logging out and scanning again.', ALERT.WARNING);
} else{
    ajaxRequest(response => {
        console.log(response);
    
    }, 'qr_form', {
        location: coords
    });
}

logoutBtn.addEventListener('click', (e) => {
    e.preventDefault();

    ajaxRequest(response => {
        window.location.href = window.location.href;
    }, 'logout');
});

submitBtn.addEventListener('click', (e) => {
    e.preventDefault();

    if(!coords){
        ALERT.append_notice('Unable to get location. Try logging out and scanning again.', ALERT.WARNING);
        return;
    }

    ajaxRequest((response) => {
        if(response.storename){
            ALERT.append_notice('Updated store name.', ALERT.SUCCESS);
        }

    }, 'qr_form', {
        location: coords,
        storename: form.elements.namedItem("storename").value,
    });
});