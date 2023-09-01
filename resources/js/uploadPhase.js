document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var inputFiles = document.querySelectorAll('.input-file');

    inputFiles.forEach(function(input) {
      var label = input.nextElementSibling,
          labelVal = label.innerHTML;

      var notUpl = document.getElementById('inputNotUploaded');
      var check = document.getElementById('inputChecked');

      var button = document.getElementsByClassName('btn-upload');
      var imagePreview = document.getElementById('imagePreview');


      input.addEventListener('change', function(e) {
        var fileName = '';
        if (e.target.value) {
          fileName = e.target.value.split('\\').pop();
        }

        if (fileName){
            notUpl.style.display = "none";
            check.style.display = "block";
        }else{
            notUpl.style.display = "block";
            check.style.display = "none";
        }

        label.querySelector('.js-fileName').innerHTML = fileName || 'insérer image de num série';


        // Check if the selected file is an image (png or jpg)
        var file = e.target.files[0];
        if (file && file.type.includes('image')) {
            button[0].style.height = '30vh';
            button[0].style.width = '80%';
            var reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);


            imagePreview.style.display = 'block'; // Display the image preview

        } else {
            button[0].style.height = '6vh';
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }

      });
    });
  });
