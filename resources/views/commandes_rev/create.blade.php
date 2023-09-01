@extends('layouts.app')

@section('imports')
    @vite(['resources/css/cmds_style.css',
            'resources/js/cmds_script.js'])
@endsection

@section('sidebar')
    @include('layouts.dashboard_sidebar');
@endsection

@section('content')
    <div class="container-fluid p-5 text-center">
        <h1>Gestionnaire de Commande</h1>
        <p>pour le revendeur

        <span>
            <select name="revendeur" id="rev-opt">
                @foreach ($revendeurs as $revendeur)
                    <option value="{{$revendeur['']}}">{{$revendeur['']}}</option>
                @endforeach

            </select>
        </span> </p>

    </div>
    <div class="shop">

        <div class="listeProdHead">


            <div class="row collection">
                @php
                $index = 0;
                @endphp
                @foreach ($produits as $produit)
                <div class="col-lg-3 col-md-4 col-sm-6  p-3   text-center prod">

                    <div class="childTitle">
                        <h4> {{ $produit['label'] }} <h4>
                    </div>
                    <div class="chdTd"> <img src="" height="100" width="90" /> </div>
                    <small> {{ $produit['reference'] }} </small>
                    <small> {{ substr($produit['description'], 0, 10) }}... </small>
                    <button type="button" class="btn-add-cart "
                        onclick="addToCart('{{ $produit['reference'] }}', '{{$produit['label']}}', {{$produit['prix']}}, {{$index}})">
                        <img src="{{ Vite::asset('resources/img/panier/add-to-cart.svg') }}" alt="add-to-cart" />
                </button>
                    @php
                        $index++;
                    @endphp

                </div>
                @endforeach
            </div>

        </div>
        <div class="panier">
            <h3 class="page-header text-center">Panier</h3>

            <div class="col-table col-sm-offset-2">

                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th>Label</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </thead>
                    <form action="{{route('revendeur-commandes.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <tbody id="cartTable">

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" align="right"><b>Total</b></td>
                                <td ><b id="total"> 0.00</b> <small> DT </small></td>
                            </tr>
                        </tfoot>
                    </form>
                </table>
                <button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                    Back</button>
                <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                <button type="button" onclick="clearCart()" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>
                    Reinit Panier</button>
                    <button type="button" href="checkout.php" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                    Checkout</button>

            </div>


        </div>

    </div>
    <script>
        function changeSubTotal(prix, qte_id, index) {
            let qteElem = document.getElementById(qte_id);
            let subTotElem = document.getElementById("subTot_" + index);
            let subTotInp = document.getElementById("subTotInp_" + index);
            let totElem = document.getElementById("total");

            let newSubTot = (parseFloat(prix) * parseInt(qteElem.value)).toFixed(2);
            subTotElem.textContent = newSubTot;
            subTotInp.value = newSubTot;

            updateTotal();
        }

        function updateTotal() {
            let subTotElems = document.querySelectorAll('[id^="subTot_"]');
            let totElem = document.getElementById("total");

            let newTotal = 0;
            subTotElems.forEach(subTotElem => {
                newTotal += parseFloat(subTotElem.textContent);
            });

            totElem.textContent = newTotal.toFixed(2);
        }

        function removeFromCart(row_id, subTot_id, subTotInp_id) {
            let row = document.getElementById(row_id);
            let subTot = document.getElementById(subTot_id);
            let subTotInp = document.getElementById(subTotInp_id);

            let oldSubTot = parseFloat(subTot.textContent).toFixed(2);
            subTot.textContent = "0.00";
            subTotInp.value = "0.00";
            updateTotal();

            row.remove();
        }

        function clearCart() {
            let table = document.getElementById("cartTable");
            table.innerHTML = ``;
            updateTotal();
        }
        function addToCart(ref, label, prix, index) {
            let qteId = `qte_${index}`;
            let rowId = `tr_${index}`;
            let subTotId = `subTot_${index}`;
            let subTotInpId = `subTotInp_${index}`;

            let table = document.getElementById("cartTable");
            let row = document.getElementById(rowId);

            if (row == null) {
                let delBtn = `<button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart('${rowId}', '${subTotId}')">Delete</button>
                            <input type="hidden" name="refs[]" value="${ref}">`;
                let nom = label;
                let price = prix;
                let qte = `<input type="number" id="${qteId}" class="form-control" value="1" name="qtes[]" min="1"
                            onchange="changeSubTotal(${prix}, '${qteId}', ${index})" oninput="this.value = this.valueAsNumber || 1;"  >`;

                let subTot = `<span id="${subTotId}">${prix}</span>`;
                let subTotInput = `<input id="${subTotInpId}"type="hidden" name="subTots[]" value="${prix}">`

                let newRow = document.createElement('tr');
                newRow.id = rowId;
                newRow.innerHTML = `
                    <td>${delBtn}</td>
                    <td>${nom}</td>
                    <td>${price}</td>
                    <td>${qte}</td>
                    <td>${subTot} ${subTotInput}</td>
                `;

                table.insertBefore(newRow, table.firstChild);

                let totElem = document.getElementById("total");
                let oldTot = parseFloat(totElem.textContent).toFixed(2);
                oldTot = (parseFloat(oldTot) + parseFloat(prix)).toFixed(2);

                totElem.textContent = oldTot;
            } else {
                let qteElem = document.getElementById(qteId);
                let oldQte = parseInt(qteElem.value);
                qteElem.value = oldQte + 1;

                changeSubTotal(prix, qteId, index);
            }
        }
        </script>
@endsection
