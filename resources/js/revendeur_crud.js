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
  +'</td>';

$(document).ready(function(){


	// Append table with add row form on add new button click
    $(".add-new").on("click", function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td></td>'+
            '<td><input type="text" class="form-control" name="nom" id="nom"></td>' +
            '<td><input type="text" class="form-control" name="prenom" id="prenom"></td>' +
            '<td><input type="text" class="form-control" name="num_telephone" id="num_telephone"></td>' +
			 crud_actions ;
        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
            let data;
            if($("#0").length == 0) {
                data = {
                    'nom': $('#nom').val(),
                    'prenom': $('#prenom').val(),
                    'num_telephone': $('#num_telephone').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "/revendeur/add",
                    data: JSON.stringify(data),
                    success: result => {
                        $(this).parents("tr").html(
                            `
                            <td><b>${result['id']}</b></td>
                                <td>${$('#nom').val()}</td>
                                <td>${$('#prenom').val()}</td>
                                <td>${$('#num_telephone').val()}</td>
                                <td>
                                    <a class="add icon" title="Add" data-toggle="tooltip"><i class="fa-solid fa-plus fa-beat"></i></a>
                                    <a class="edit icon" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="delete icon" title="Delete" data-toggle="tooltip"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            `
                        );

                        Toast.fire({
                            title: 'Succés!',
                            text: 'La table des revendeurs est mise à jour!',
                            icon: 'success'
                        });
                        $(".add-new").removeAttr("disabled");
                    }
                });
            } else {
                data = {
                    'id': $('#0').val(),
                    'nom': $('#1').val(),
                    'prenom': $('#2').val(),
                    'num_telephone': $('#3').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/revendeur/edit",
                    data: JSON.stringify(data),
                    success: result => {
                        let idx=0;
                        input.each(function(){
                            if(idx==0){
                                $(this).parent("td").html('<b>'+$(this).val()+'</b>');
                            }else{
                                $(this).parent("td").html($(this).val());
                            }
                            idx++;
                        });
                        $(this).parents("tr").find(".add, .edit").toggle();
                        $(".add-new").removeAttr("disabled");
                        Toast.fire({
                            title: 'Succés!',
                            text: 'La table des revendeurs est mise à jour!',
                            icon: 'success'
                        });
                    }
                });
            }

		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        let idx = 0; // bech naarafou l'index mte3 awel cell fel tableau
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
            if (idx==0){
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
                    url: "/revendeur/delete",
                    data: JSON.stringify({'id': $(self).closest('tr').find('td:first-child').text()}),

                    success: result => {
                        $(self).parents("tr").remove(); // Use 'self' here
                        $(".add-new").removeAttr("disabled");

                        Toast.fire({
                            icon: 'success',
                            title: 'Succés!',
                            text: 'La table des revendeurs est mise à jour!',
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
