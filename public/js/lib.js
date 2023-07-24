const CONTROLLER_EL = document.getElementById('controller');
const CFG = {
    wwwroot: CONTROLLER_EL.getAttribute('wwwroot')
}

const ALERT = {
    WARNING: 0,
    SUCCESS: 1,
    STR_MAP: {
        0: 'warning',
        1: 'success'
    },
    CLASS_MAP: {
        0: 'danger',
        1: 'success'
    },

    append_notice: function append_notice(msg, alerttype){
        let alertcontainer = document.getElementById('alerts');
    
        if(!alertcontainer){
            alert(this.STR_MAP[alerttype]+' | "'+msg+'"');
            return;
        }
    
        let notice = document.createElement('div');
        notice.innerHTML = msg;
        notice.classList.add('alert');
        notice.classList.add('alert-'+this.CLASS_MAP[alerttype])
        notice.setAttribute('role', 'alert');
    
        alertcontainer.appendChild(notice);
    }
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function ajaxRequest(callback, method, params = null){
    fetch(CFG.wwwroot+'/service.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            method: method,
            params: params
        })
    }).then(callback, callback);
}

class location_handler{
    constructor(){
        this.checkLocationEnabled();
    }

    static getCoords(){
        return getCookie('location');
    }

    checkLocationEnabled(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.showPosition, this.showError);
        } else {
            append_notice('Geolocation not supported on this browser. Please try a different browser.', ALERT.WARNING);
        }
    }

    showPosition(position) {
        if(!position){
            console.error('Location missing');
            return;
        }

        let coords = {
            latitude:position.coords.latitude,
            longitude:position.coords.longitude,
        };

        // console.log(coords); //! debug
        document.cookie = "location="+JSON.stringify(coords);
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

new location_handler();