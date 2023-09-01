// import '../*';

console.log(pieces);



function createPiecesOptions(pieces){
    let piecesSelect = ''

    for (let piece of pieces){
        piecesSelect += `<option value="${piece['ref']}"> ${piece['ref']} - ${piece['designation']}</option>`
    }


    return piecesSelect;

}

function createProduitsOptions(produits){
    let piecesSelect = ''

    for (let produit of produits){
        piecesSelect += `<option value="${produit['reference']}"> ${produit['reference']} -
        ${produit['nom']}</option>`
    }


    return piecesSelect;

}

const produitOpts = createProduitsOptions(produits);





$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('.new-var-piece-select').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 400
    });

    

        // $(document).on("click", "#piece-modal-save-btn", function () {
        //     console.log('here1');
        //     let pieceRef = $('input[name="pieceModalRef"]').val();
        //     let pieceDes = $('input[name="pieceModalDesignation"]').val();
        //     let pieceIndArr = $('input[name="pieceModalIndiceArrivage"]').val();
        //     let piecePhoto = $('input[name="pieceModalPhoto"]')[0].files[0];
        //     console.log('here2');
        //     let formData = new FormData();
        //     formData.append('reference', pieceRef);
        //     formData.append('designation', pieceDes);
        //     formData.append('indice_arrivage', pieceIndArr);
        //     formData.append('photo', piecePhoto);
        //     console.log('here3');
        //     console.log(pieceRef, pieceDes, pieceIndArr, piecePhoto);
        //     console.log('here4');
        //     $.ajax({
        //         type: "POST",
        //         url: "/variations/save-piece-modal",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function (response) {

        //             console.log(pieces);
        //             pieces.push(response.piece);
        //             let pieceSelect = createPiecesOptions(pieces);
        //             $('.new-var-piece-select').html(pieceSelect);
        //             $('.new-var-piece-select').multiselect('rebuild');
        //             // console.log($('.new-vars:last-child').find('.new-var-piece-select').html());
        //             let pieceRef = $('input[name="pieceModalRef"]');
        //             let pieceDes = $('input[name="pieceModalDesignation"]');
        //             let pieceIndArr = $('input[name="pieceModalIndiceArrivage"]');
        //             let piecePhotoInput = $('input[name="pieceModalPhoto"]');

        //             // Clear the input values
        //             pieceRef.val('');
        //             pieceDes.val('');
        //             pieceIndArr.val('');

        //             // Reset the file input
        //             piecePhotoInput.val(null);
        //             $('#create-piece-modal').modal('hide');
        //             console.log('here after ajax success');

        //         }
        //     });
        // });



    $(document).on("input", ".designation", function () {
        let content = $(this).parent('div');
        if ($(this).val().length ===0){
            content.find('.validity-msg').removeClass('valid-feedback')
                    .addClass('invalid-feedback')
                    .text('ce champs est invalide');
            $(this).removeClass('is-valid').addClass('is-invalid');
        }else{
            content.find('.validity-msg')
            .removeClass('invalid-feedback')
            .addClass('valid-feedback')
            .text('ce champs est valide');
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
