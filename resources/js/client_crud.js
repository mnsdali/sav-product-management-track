import $ from 'jquery';
import swal from 'sweetalert2';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

  const crud_actions = '<td>'
  +'<a class="add icon" title="Add" data-toggle="tooltip"><i class="fa-solid fa-plus fa-beat"></i></a>'
  +'<a class="edit icon" title="Edit" data-toggle="tooltip"><i class="fa-light fa-pen" aria-hidden="true"></i></a>'
  +'<a class="delete icon" title="Delete" data-toggle="tooltip"><i class="fa fa-trash" aria-hidden="true"></i></a>'
  +'<a class="detail" title="Detail" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>'
  +'</td>';

$(function(){

    if ($("#newClientAdded") != null){
        Toast.fire({
            title: 'Félicitations!',
            text: 'Le client a été ajouté avec succés!',
            icon: 'success'
        });
    }
    $(document).on("mouseenter", ".prod_ref", function(event) {
        let ref = $(this).closest("td").text();
        var produit;
        if (sessionStorage.getItem(ref) === null){
            $.ajax({
                type: "POST",
                url: "/produit/show",
                data: {'ref': ref},
                success: result => {
                    produit = result;
                    sessionStorage.setItem(ref, JSON.stringify(produit));
                }
            });
        }else{
            produit = sessionStorage.getItem(ref);
        }

        if(produit){
            let parsedData = JSON.parse(produit);
            const $hoverDiv = $(".hover-div");
            const offsetX = 10; // Adjust as needed
            const offsetY = 10; // Adjust as needed

            // Calculate position
            const posX = event.pageX + offsetX;
            const posY = event.pageY - $hoverDiv.outerHeight() - offsetY;

            // Position the hover div
            $hoverDiv.css({ top: posY, left: posX }).fadeIn();

            $hoverDiv.html(`
                <h4> Details de produit: </h4>
                <p><b>Reference:</b> ${parsedData[0]['reference']} </p>
                <p><b>Label:</b> ${parsedData[0]['label']} </p>
                <p><b>Description:</b> ${parsedData[0]['description']} </p>
                <p><b>Type de gaz:</b> ${parsedData[0]['typeGaz']} </p>
            `)
        }


    }).on("mouseleave",".prod_ref",  function() {
        $(".hover-div").fadeOut();
    });

    $(document).on("mouseenter", ".rev_id", function(event) {
        let rev_id =  $(this).closest("td").text();
        var rev;
        if (sessionStorage.getItem('rev_'+rev_id) === null){
            $.ajax({
                type: "POST",
                url: "/revendeur/show",
                data: {'rev_id':rev_id},
                success: result => {
                    rev = result;

                    sessionStorage.setItem('rev_'+rev_id, JSON.stringify(rev));
                }
            });
        }else{
            rev = sessionStorage.getItem('rev_'+rev_id);

        }

        if(rev){
            let parsedData = JSON.parse(rev);
            const $hoverDiv = $(".hover-div");
            const offsetX = 10; // Adjust as needed
            const offsetY = 10; // Adjust as needed

            // Calculate position
            const posX = event.pageX + offsetX;
            const posY = event.pageY - $hoverDiv.outerHeight() - offsetY;

            // Position the hover div
            $hoverDiv.css({ top: posY, left: posX }).fadeIn();

            $hoverDiv.html(`
                <h4> Details de revendeur: </h4>
                <p><b>id:</b> ${parsedData[0]['id']} </p>
                <p><b>nom complet:</b> ${parsedData[0]['prenom']} ${parsedData[0]['nom']}</p>
                <p><b>num telephone:</b> ${parsedData[0]['num_telephone']} </p>
                <p><b>inscrit le:</b> ${parsedData[0]['created_at'].substr(0,10)} ${parsedData[0]['created_at'].substr(11,8)}  </p>
            `)
        }


    }).on("mouseleave", ".rev_id", function() {
        $(".hover-div").fadeOut();
    });


    $(document).on("click", ".close", function(){
        $('#client-modal').css("display", "none");
    });

    $(document).on("click", ".view", function(){
        let id = $(this).parents("tr").find("td:first-child").text();
        let nom = $(this).parents("tr").find("td:nth-child(2)").text();
        let prenom = $(this).parents("tr").find("td:nth-child(3)").text();

        $.ajax({
            type: "POST",
            url: "/client/show-articles",
            data: {'id': id},
            success: articles => {
                Toast.fire({
                    text: 'Affichage des produits de client!',
                    icon: 'info'
                });

                let modalContent = `
                    <h2>Liste des articles achetés par <b>${prenom} ${nom}</b></h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Numéro Serie</th>
                                <th>Référence</th>
                                <th>Revendeur</th>
                                <th>Date Achat</th>
                            </tr>
                        </thead>
                        <tbody>
                `;


                for(const article of articles ){
                    let date = article['created_at'].substr(0,10) + article['created_at'].substr(11,8);
                    modalContent += `
                    <tr>
                        <td>${article['serie_number']}</td>
                        <td class="prod_ref">${article['prod_ref']}</td>
                        <td class="rev_id">${article['rev_id']}</td>
                        <td>${date} </td>
                    </tr>`;
                }

                modalContent += '</tbody> </table>';

                $('#modal-body').html(modalContent);
                $('#client-modal').css("display", "block");

            }
        });
    });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        let idx = 0;
        input.each(function(){
			if(!$(this).val() && idx!=4 ){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
            idx++;
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
            let data;

            data = {
                'id': $('#0').val(),
                'nom': $('#1').val(),
                'prenom': $('#2').val(),
                'num_telephone1': $('#3').val(),
                'num_telephone2': $('#4').val(),
            };




            $.ajax({
                type: "POST",
                url: "/client/update",
                data: JSON.stringify(data),
                success: result => {
                    let idx=0;
                    input.each(function(){
                        if(idx==0){
                            $(this).parent("td").html('<b>'+$(this).val()+'</b>').id = idx;
                        }else{
                            $(this).parent("td").html($(this).val());
                        }
                        idx++;
                    });
                    $(this).parents("tr").find(".add, .edit").toggle();
                    $(".add-new").removeAttr("disabled");
                    Toast.fire({
                        title: 'Succés!',
                        text: 'La table des clients est mise à jour!',
                        icon: 'success'
                    });
                }
            });


		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        let idx = 0; // bech naarafou l'index mte3 awel cell fel tableau
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
            if (idx==0 || idx==5 || idx==6){
			    $(this).html('<input type="text" class="form-control" id="'+idx+'" name="'+idx+'" value="' + $(this).text() + '" disabled>');
            }else{
                $(this).html('<input type="text" class="form-control" id="'+idx+'"name="'+idx+'" value="' + $(this).text() + '">');
            }
            idx++;
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(e){
        e.preventDefault();
        let self = this; // Store the reference to the outer 'this'

        swal.fire({
            title: "Êtes vous sûr?",
            text: "Cette action est irréversible!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: 'Annuler',
            confirmButtonText: 'Confirmer',
        }).then(function(result) {
            if (result.isConfirmed) {

                var input = $(self).parents("tr").find('input[type="text"]');
                if (input.length != 0){

                    $(self).parents("tr").remove(); // Use 'self' here
                        $(".add-new").removeAttr("disabled");

                        Toast.fire({
                            icon: 'info',
                            text: "Votre action d'ajout est annulée!",
                          });
                }else{
                $.ajax({
                    type: "POST",
                    url: "/client/delete",
                    data: JSON.stringify({'id': $(self).closest('tr').find('td:first-child').text()}),

                    success: result => {
                        $(self).parents("tr").remove(); // Use 'self' here
                        $(".add-new").removeAttr("disabled");

                        Toast.fire({
                            icon: 'success',
                            title: 'Succés!',
                            text: 'La table des clients est mise à jour!',
                          })
                    }
                });
                }
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Votre base de données est sécurisée'
                  })

            }
        });
    });
});
