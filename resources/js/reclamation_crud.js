import $ from 'jquery';
import swal from 'sweetalert2';
import 'boxicons';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getTimeAgoString(inputDateTimeString) {
    const inputDateTime = new Date(inputDateTimeString);
    const currentDate = new Date();
    const timeDifferenceMs = currentDate - inputDateTime;

    const secondsPassed = Math.floor(timeDifferenceMs / 1000);
    const minutesPassed = Math.floor(secondsPassed / 60);
    const hoursPassed = Math.floor(minutesPassed / 60);
    const daysPassed = Math.floor(hoursPassed / 24);
    const monthsPassed = Math.floor(daysPassed / 30.42); // Approximate average month length
    const yearsPassed = Math.floor(monthsPassed / 12);

    if (yearsPassed > 0) {
        return `${yearsPassed} ${yearsPassed === 1 ? 'an' : 'ans'}`;
    } else if (monthsPassed > 0) {
        return `${monthsPassed} ${monthsPassed === 1 ? 'mois' : 'mois'}`;
    } else if (daysPassed > 0) {
        return `${daysPassed} ${daysPassed === 1 ? 'jour' : 'jours'}`;
    } else if (hoursPassed > 0) {
        return `${hoursPassed} ${hoursPassed === 1 ? 'heure' : 'heures'}`;
    } else if (minutesPassed > 0) {
        return `${minutesPassed} ${minutesPassed === 1 ? 'minute' : 'minutes'}`;
    } else {
        return 'quelques secondes';
    }
}


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
});

$(function(){

    $(document).on("mouseenter", ".ic", function(){
        $(this).html('<i class="bx bxs-bookmark-alt-plus"></i>');
    });

    $(document).on("mouseleave", ".ic", function(){
        $(this).html('<i class="bx bx-bookmark-alt-plus"></i>');
    });

    $(document).on("click", ".bookmark", function(){
        let tmp = $(this).parents("div").find(".tech").val().split(' ');
        let tech = tmp[0];
        let dist = tmp[1];
        console.log(tech);
        console.log(dist);
        let rec_id = $(this).parents("div").parents('div').parents('div').find(".rec_id").text();
        $.ajax({
            type: "POST",
            url: "/reclamation/update",
            data: {'tech': tech, 'dist':dist, 'rec_id':rec_id},
            success: result  => {
                Toast.fire({
                    title: 'Succés!',
                    text: 'La réclamation est mise à jour!',
                    icon: 'success'
                });


            }
        });
    });

    $(document).on("click", ".sort", function(){
        let coords = $(this).parents("div").find(".coords").val();
        let techDiv =  $(this).parents("div").find(".technicien");
        $.ajax({
            type: "POST",
            url: "/reclamation/sort",
            data: {'coords': coords},
            success: distances  => {
                let content = '<select name="tech_email" id="tech_email">';
                for(const distance of distances){
                    content += `<option class="tech" value="${distance.email} ${distance.distance.toFixed(2)}">${distance.username} ${distance.distance.toFixed(2)}km - (+216) ${distance.num_tel1}</option>`;

                }
                content += '</select>';
                content += '<a class="bookmark" title="Enregistrer le technicien sélectionné" > <div class="ic"  data-bs-toggle="tooltip" data-bs-placement="top" > <i class="bx bx-bookmark-alt-plus"  ></i>  </div> </a>'
                techDiv.html(content);
            }
        });

    });

    $(".time").each(function() {
        const inputDateTimeString = $(this).text(); // Get the value from the element
        const timeAgoString = getTimeAgoString(inputDateTimeString);
        $(this).text(timeAgoString); // Update the content with the calculated time ago string
    });

    $(document).on("mouseenter", ".time", function(event) {
        let created_at = $(this).parents("div").find('.created_at').val();

        const $hoverDiv = $(".hover-div");
        const offsetX = 10; // Adjust as needed
        const offsetY = 10; // Adjust as needed

        // Calculate position
        const posX = event.pageX + offsetX;
        const posY = event.pageY - $hoverDiv.outerHeight() - offsetY;

        // Position the hover div
        $hoverDiv.css({ top: posY, left: posX }).fadeIn();
        $hoverDiv.text(created_at);

    }).on("mouseleave",".time",  function() {
        $(".hover-div").fadeOut();
    });



});

