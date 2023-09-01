import $ from 'jquery';
import swal from 'sweetalert2';

const Toast = swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})
// There is no way to retrive client location this data via PHP, remember that PHP is executed in the server,
//  not in the client, so you need a client execution language like javascript.

const scanner = new Html5QrcodeScanner('reader', {
    // Scanner will be initialized in DOM inside element with id of 'reader'
    qrbox: {
        width: 250,
        height: 250,
    },  // Sets dimensions of scanning box (set relative to reader element width)
    fps: 20, // Frames per second to attempt a scan
});


scanner.render(success, error);
// Starts scanner

function success(result) {

    let qr_status = document.getElementById('qr_status');
    qr_status.innerHTML = `<div class="qr_detected">MATCH</div>`;

    if (!result.startsWith('SN') || result.length != 16 ){
        Toast.fire({
                title: 'Whoops!',
                text: "Code QR invalide! Veuillez reessayer!",
                icon: 'error'
        })
    }else{
        scanner.clear();
        // Clears scanning instance

        document.getElementById('reader').remove();
        // Removes reader element from DOM since no longer needed
        $('#serie_number').val(result);
        $('#result').append('<p> ' + result + '</p>');

        //show a message
        Toast.fire({
            title: 'Félicitations!',
            text: "Vous avez scanner un nouveau produit avec succés!",
            icon: 'success'
        });
    }
}

function error(err) {
    let qr_status = document.getElementById('qr_status');
    qr_status.innerHTML = `<div class="qr_not_detected">Scanning</div>`;
}



