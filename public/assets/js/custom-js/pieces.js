
// console.log(variations);
// const noImageUrl = baseUrl + '/assets/images/noimage.jpg';
const pieceHTML = `
<div class="curr-piece card-body">
    <div class="row d-flex align-items-center">
        <div class="row col-7">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group custom-control-inline ">
                    <label class="form-label">Reference</label>
                    <input type="text" name="referencesNewPiece[]"
                        class="form-control  ref-piece-cls" placeholder="reference de la piéce...">
                        <div class="validity-msg"></div>

                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group custom-control-inline">
                    <label class="form-label">Designation</label>
                    <input type="text" name="designationsNewPiece[]"
                        class="form-control  ref-piece-cls" placeholder="designation de la piéce...">
                        <div class="validity-msg"></div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group custom-control-inline">
                    <label class="form-label">Indice d'arrivage</label>
                    <input type="text" name="indiceArrivageNewPiece[]"
                        class="form-control ref-piece-cls"
                        placeholder="indice d'arrivage de la piéce...">
                        <div class="validity-msg"></div>

                </div>
            </div>
        </div>


        <div class="col-4 h-25">

            <div class="card-header">
                <h3 class="card-title">Photo de la piéce<small>choisir une image pour représenter la
                        piéce</small></h3>
            </div>
            <div class="card-body">
                <input type="file" class="dropify-event dropify" name="photos[]"
                    data-default-file="${noImageUrl}"
                    value="${noImageUrl}">
                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
            </div>
        </div>

        <div class="col-sm-1 col-md-1 col-lg-1">
            <div class="form-group custom-control-inline">
                <a class="add-piece-btn-create" title="Créer une autre piéce" data-toggle="tooltip"
                    data-placement="top">
                    <i class="fe fe-plus-square"></i>
                </a>
                <a class="del-piece-btn-create" title="Supprimer la piéce" data-toggle="tooltip" data-placement="right" >
                                <i class="fe fe-trash-2" aria-hidden="true"></i>
                            </a>
            </div>
        </div>
        <div class="form-group custom-control-inline">
                        <label class="form-label">Quantité total en stock</label>
                        <input type="number" name="quantities[]" spellcheck="false" value="0"
                                            oninput="this.value = parseInt(this.value) || 0;" min="1"
                                            class="form-control  quantity-inp">
                        <div class="validity-msg"></div>

                    </div>
    </div>
</div>
`;

$(function () {

    // $('[data-toggle="tooltip"]').tooltip();

    $(document).on("click", ".add-piece-btn-create", function () {
        let body = $(this).closest('.curr-piece');
        body.append(pieceHTML);

        $('.add-piece-btn-create').tooltip();
        $('.del-piece-btn-create').tooltip(); // Reinitialize tooltips
            var drEvent = $('.dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
    });

    $(document).on("click", ".del-piece-btn-create", function () {
        let row = $(this).closest(".curr-piece");
        row.find('[data-toggle="tooltip"]').tooltip('hide').tooltip('dispose');
        row.remove();
    });


    // $(document).on("input", ".ref-piece-cls", function () {
    //     let content = $(this).parent('div');
    //     if ($(this).val().length ===0){
    //         content.find('.valid-feedback').removeClass('valid-feedback')
    //                 .addClass('invalid-feedback')
    //                 .text('ce champs est invalide');
    //         $(this).removeClass('is-valid').addClass('is-invalid');
    //     }else{
    //         content.find('.invalid-feedback')
    //         .removeClass('invalid-feedback')
    //         .addClass('valid-feedback')
    //         .text('ce champs est valide');
    //         $(this).removeClass('is-invalid').addClass('is-valid');
    //     }
    // });

    // $(document).on('change','.prod-for-piece',function() {
    //     var ref = $(this).val().trim();
    //     $('.vars-for-piece').empty();
    //     for (var variation of variations) {

    //         if (variation['prod_ref'] == ref) {
    //             console.log(ref);
    //             $('.vars-for-piece').append('<option value="' + variation['designation'] +
    //                 '">' + variation['designation'] + '</option>');
    //         }
    //     }

    //     $('.vars-for-piece').multiselect('rebuild');


    // });


});
