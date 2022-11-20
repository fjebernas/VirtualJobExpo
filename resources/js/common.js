
function hideLoader() {
    setTimeout(() => {
        $('#loader').fadeOut(500);
    }, 200);
}

function showToastIfNotificationDataExists() {
    const notifMsg = $('#toast-data-holder').attr('data-msg').trim();
    const notifType = $('#toast-data-holder').attr('data-type').trim();

    if (notifMsg.length != "") {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: notifType,
            title: notifMsg,
            showConfirmButton: false,
            timer: 2500
        })
    }
}

hideLoader();
showToastIfNotificationDataExists();