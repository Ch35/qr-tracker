export const ALERT_WARNING = 0;
export const ALERT_SUCCESS = 1;
export const ALERT_STR_MAP = {
    [ALERT_WARNING]: 'warning',
    [ALERT_SUCCESS]: 'success'
}
export const ALERT_CLASS_MAP = {
    [ALERT_WARNING]: 'danger',
    [ALERT_SUCCESS]: 'success'
}

export function append_notice(msg, alerttype){
    console.log('Appending notice'); //! debug

    let alertcontainer = document.getElementById('alerts');

    if(!alertcontainer){
        alert(ALERT_STR_MAP[alerttype]+' | "'+msg+'"');
        return;
    }

    let notice = document.createElement('div');
    notice.innerHTML = msg;
    notice.classList.add('alert');
    notice.classList.add('alert-'+ALERT_CLASS_MAP[alerttype])
    notice.setAttribute('role', 'alert');

    alertcontainer.appendChild(notice);
}

class location{
    constructor(){
        this.checkLocationEnabled();
    }

    checkLocationEnabled(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.showPosition, this.showError);
        } else {
            append_notice('Geolocation not supported on this browser. Please try a different browser.', ALERT_WARNING);
        }
    }

    showPosition(position) {
        console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);
        // TODO: SEND LOCATION VIA AJAX
    }

    showError(error) {
        console.error(error);
        let msg = '';
        const alertType = ALERT_WARNING;
    
        switch (error.code) {
            case error.PERMISSION_DENIED:
                msg = 'User denied the request for Geolocation. Please manually enable this by following '+
                    '<a target="_blank" href="https://support.google.com/chrome/answer/142065?hl=en&co=GENIE.Platform%3DDesktop">this guide</a> and refreshing the page.';
                break;
            case error.POSITION_UNAVAILABLE:
                msg = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                msg = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                msg = "An unknown error occurred.";
                break;
        }

        // We need to log the location each access - so restrict futher access
        document.getElementById('content').remove();

        append_notice(msg, alertType);
    }
}

export var Location = new location;