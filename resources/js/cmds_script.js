import DataTable from 'datatables.net-dt';
import $ from 'jquery';
import swal from 'sweetalert2';
import 'boxicons';
import addToCartImgUrl from '../img/panier/add-to-cart.svg';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const designationHTML = `
<div class="panier-btns">
    <div class="input-block mx-auto">
        <input class="input-box arr" type="text"  name="designationsNewProd[]" spellcheck="false" required />
        <span class="placeholder">designation</span>
    </div>
    <div class="input-block mx-auto">
                            <input class="input-box arr" type="number" name="quantitiesNewProd[]" spellcheck="false" value="0" oninput="this.value = parseInt(this.value) || 0;" min="0" />
                            <span class="placeholder">qte en stock</span>
    </div>
    <a class="add-var-btn" title="Ajouter une autre designation" data-toggle="tooltip" data-placement="top">
        <i class='bx bx-list-plus'></i>
    </a>
    <a class="del-var-btn" title="Supprimer variation" data-toggle="tooltip" data-placement="top" >
        <i class="bx bx-trash" aria-hidden="true"></i>
    </a>

</div>
`

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


let variations_table = new DataTable('#produits_table', {
    "pageLength": 5,
    lengthMenu: [0, 5, 10, 20]
});


  function isNumeric(value) {
    return /^-?\d+(\.\d+)?$/.test(value);
}


function updateTotal(){
    let subTotals = $('[id^="subTotal_"]');
    let total = 0;
    subTotals.each(function(){
        total += parseFloat($(this).text());
    }
    );
    $('#cartTotal').html(total.toFixed(2));
}

function changeSubTotal(subTotal_id, qte, prix){
    let subTotal = parseFloat(qte) * parseFloat(prix);
    $(subTotal_id).html('<b>'+subTotal.toFixed(2)+'</b>');

    updateTotal();
}

function removeFromCart(cart_id){
    $('#'+cart_id).remove();
    updateTotal();
}

$(function(){

    $(document).on("click", ".create-var-btn-container", () => {
        $('#variation-modal').css("display", "block");
    });

    $(document).on("click", ".create-prod-btn-container", () => {
        $('#produit-modal').css("display", "block");
    });

    $(document).on("click", ".close", function(){
        $('#produit-modal').css("display", "none");
        $('#variation-modal').css("display", "none");
    });


    $(document).on("click", ".add-var-btn", function(){
        let body = $(this).parent('div').parent('div');
        body.append(designationHTML);
    });

    $(document).on("click", ".del-var-btn", function(){
        $(this).parent('div').remove();
    });

    $(document).on("select", "#ref-opt", function(){
        console.log($(this).val());

    });

    $(document).on("click", "#submit-prods", () => {



        let designationsInputs = $('input[name="designationsNewProd[]"]');



        let reference = $('input[name="reference"]');
        let label = $('input[name="label"]');
        let description = $('input[name="description"]');
        let prix = $('input[name="prix"]');
        let typeGaz = $('#type-gaz');

        let empty = false;
        designationsInputs.each(function(){
			if(!$(this).val() ){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});

        if (!reference.val()){
            reference.addClass("error");
			empty = true;
        }else{
            reference.removeClass("error");
        }

         if (!label.val() ){ label.addClass("error"); empty = true;}else{ label.removeClass("error"); }

         if ( !description.val()  ){ description.addClass("error");empty = true;}else{description.removeClass("error");}

         if (!prix.val()  ){prix.addClass("error");empty = true;} else{prix.removeClass("error");}

        if ( !isNumeric(prix.val())  ){prix.addClass("error");empty = true;} else{prix.removeClass("error");}

        if (typeGaz.val() == null){typeGaz.addClass("error");empty = true;}else{typeGaz.removeClass("error");}


        if (!empty){
            let designations = $('input[name="designationsNewProd[]"]').map(function() {
                return $(this).val();
            }).get();

            let quantities = $('input[name="quantitiesNewProd[]"]').map(function() {
                return  parseInt($(this).val());
            }).get();



            let data = {
                'designations': designations,
                'quantities': quantities,
                'reference': reference.val(),
                'label': label.val(),
                'description': description.val(),
                'prix': parseFloat(prix.val()),
                'typeGaz': typeGaz.val()
            }
            console.log(data);

            $.ajax({
                url: '/variations/add',
                type: 'POST',
                data: JSON.stringify(data),
                success: function(result){
                    Toast.fire({
                        iconHtml: "<i class='bx bxs-rocket'></i>",
                        title: 'Félicitations!',
                        text: result['message'],
                        icon: 'success'
                    });

                    $('#produit-modal').css("display", "none");
                    $('#variation-modal').css("display", "none");
                    let rowCount = $('#show-variations-table tr').length;
                    for ( let i =0; i<designations.length; i++){

                        let row =`
                        <tr >
                            <td scope="row" >${reference.val()}-${designations[i]}</td>
                            <td > <b>${reference.val()}</b> </td>
                            <td class="childTitle" >
                            ${label.val()}
                            </td>

                            <td > <small> ${description.val()} </small></td>
                            <td > ${prix.val()} </td>
                            <td ><button type="button" class="btn-add-cart">
                                    <img src="${addToCartImgUrl}" alt="add-to-cart" />
                                </button> </td>
                        </tr>
                        `;

                        variations_table.rows.add($(row)).draw();
                        rowCount++;
                    }
                    let opt = `<option value="${reference.val()}">${reference.val()}
                    ${label.val()} ${prix.val()}</option>`
                    $('#prods-select-group').append(opt);

                }
            });

        }


    })

    $(document).on("click", "#submit-vars", () => {

        let designationsInputs = $('input[name="designationsNewVar[]"]');

        let reference = $('select[name="reference"]');

        let empty = false;
        designationsInputs.each(function(){
			if(!$(this).val() ){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});

        if (!reference.val()){
            reference.addClass("error");
			empty = true;
        }else{
            reference.removeClass("error");
        }

        if (!empty){
            let designations = $('input[name="designationsNewVar[]"]').map(function() {
                return $(this).val();
            }).get();

            let quantities = $('input[name="quantitiesNewVar[]"]').map(function() {
                return  parseInt($(this).val());
            }).get();

            let data = {
                'designations': designations,
                'quantities': quantities,
                'reference': reference.val(),
            }

            $.ajax({
                url: '/variations/add-more',
                type: 'POST',
                data: JSON.stringify(data),
                success: function(result){
                    Toast.fire({
                        iconHtml: "<i class='bx bxs-rocket'></i>",
                        title: 'Félicitations!',
                        text: result['message'],
                        icon: 'success'
                    });

                    $('#produit-modal').css("display", "none");
                    $('#variation-modal').css("display", "none");
                    let rowCount = $('#show-variations-table tr').length;
                    for ( let i =0; i<designations.length; i++){

                        let row =`
                        <tr>
                            <td>${result['produit']['reference']}-${designations[i]}</td>
                            <td> <b>${result['produit']['reference']}</b> </td>
                            <td class="childTitle">
                            ${result['produit']['label']}
                            </td>

                            <td> <small> ${result['produit']['description']} </small></td>
                            <td> ${result['produit']['prix']} </td>
                            <td><button type="button" class="btn-add-cart "
                                    onclick="addToCart('${result['produit']['reference']}', '${result['produit']['label']}', ${result['produit']['prix']}, ${rowCount})">
                                    <img src="${addToCartImgUrl}" alt="add-to-cart" />
                                </button> </td>
                        </tr>
                        `;

                        variations_table.rows.add($(row)).draw();
                        rowCount++;
                    }
                }
            });
        }
    })

    $(document).on("click", ".btn-add-cart", (event) => {
        let currentRow = $(event.currentTarget).parent('td').parent('tr');
        let designation = currentRow.find("td:nth-child(1)").text();
        let reference = currentRow.find("td:nth-child(2)").text();
        let label = currentRow.find("td:nth-child(3)").text();
        let prix = currentRow.find("td:nth-child(5)").text();


        let subTotal_id = 'subTotal_'+reference+designation;
        let qte_id = 'qte_'+reference+designation;
        let cart_id = 'cart_'+designation;

        if ($('#' + cart_id).length === 0){
            let row =`
            <tr id="${cart_id}" class="bg-white border-b border-gray-700">
                <td class="px-4 py-4 font-b text-gray-900 whitespace-nowrap"><b>${designation}</b></td>
                <td class="px-4 py-4"><b>${reference}</b></td>
                <td class="px-4 py-4">${label}</td>
                <td class="px-4 py-4">${prix}</td>
                <td class="px-4 py-4 w-9" id="${qte_id}"><input type="number" class="form-control cartQte" value="1" min="1" name="cartQuantities[]"  ></td>
                <td class="px-4 py-4" id="${subTotal_id}"><b>${prix}</b></td>
                <td class="px-4 py-4"><button type="button" class="hover:text-red bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 removeFromCart" > <i class='bx bxs-trash'></i></button></td>
            </tr>
            `;
            $('#cart-table').append(row);
            updateTotal();
        }else {

            let inp = $('#'+qte_id).find('input');
            $(inp).val(parseInt(inp.val()) + 1);
            changeSubTotal('#'+subTotal_id, inp.val(), prix);
        }
    })

    $(document).on("click", ".reinit-btn", () => {
        $('#cart-table').html('');
        updateTotal();
    })

    $(document).on("input", ".cartQte", function(event) {
        let currentRow = $(event.currentTarget).closest('tr');
        let qte = $(event.currentTarget).val();
        let prix = currentRow.find("td:nth-child(4)").text();
        let subTotal_id = currentRow.find("td:nth-child(6)").attr('id');

        changeSubTotal('#'+subTotal_id, qte, prix);
    });

    $(document).on("click", ".removeFromCart", function(event) {
        let cart_id = $(this).parent("td").parent('tr').attr('id');
        removeFromCart(cart_id);
    });

    $(document).on("click", ".validate-cart-save-btn", function(event) {
        let revendeurSel =  $('select[name="revendeur"]');
        let cartRows = $('[id^="cart_"]');
        // let references = [];
        let designations = [];
        let quantities = [];
        let subTotalsValues = [];

        for (var i=0;i<cartRows.length ;++i){
            let currentRow = $(cartRows[i]);
            // let reference = currentRow.find("td:nth-child(2)").text();
            let designation = currentRow.find("td:nth-child(1)").text();
            let qte = currentRow.find("td:nth-child(5)").find('input').val();
            let subTotal = currentRow.find("td:nth-child(6)").text();

            // references.push(reference);
            designations.push(designation);
            quantities.push(qte);
            subTotalsValues.push(subTotal);
        };


        let revendeur = revendeurSel.val();

        // console.log(references);
        console.log(designations);
        console.log(quantities);
        console.log(subTotalsValues);
        console.log(revendeur);

        $.ajax({
            url: '/variations/checkout',
            type: 'POST',
            data: JSON.stringify({
                // 'references': references,
                'designations': designations,
                'quantities': quantities,
                'subTotalValues': subTotalsValues,
                'revendeur': revendeur
            }),
            success: function(result){
                Toast.fire({
                    iconHtml: "<i class='bx bxs-rocket'></i>",
                    title: 'Félicitations!',
                    text: result['message'],
                    icon: 'success'
                });
                $('#cart-table').html('');
                updateTotal();
            }
        });
    });


});
