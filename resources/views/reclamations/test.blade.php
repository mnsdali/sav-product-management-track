<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite([ 'resources/js/app.js' ])
    <title>Document</title>
</head>
<body>


    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #reader {
            width: 600px;
        }
        #result {
            text-align: center;
            font-size: 1.5rem;
        }
    </style>

    <main>
        <div id="reader"></div>
        <div id="result"></div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var x = document.getElementById("demo");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showLocation(position){
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            $.ajax({
                type:'POST',
                url:'getLocation.php',
                data:'latitude='+latitude+'&longitude='+longitude,
                success:function(msg){
                    if(msg){
                    $("#location").html(msg);
                    }else{
                        $("#location").html('Not Available');
                    }
                }
            });
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
                case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
                case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
                case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
            }
        }


    </script>
    <script>
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

            document.getElementById('result').innerHTML = `
            <h2>Success!</h2>
            <p><a href="${result}">${result}</a></p>
            `;
            // Prints result as a link inside result element

            scanner.clear();
            // Clears scanning instance

            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed

        }

        function error(err) {
            console.error(err);
            // Prints any errors to the console
        }

    </script>
</body>
</html>
