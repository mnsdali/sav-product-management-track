@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @elseif (session('failure'))
        <div id="successAlert" class="alert alert-icon alert-warning alert-dismissible" role="alert">
            <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <h4 class="text-center">Catalogue de ventes au revendeurs</h4>
    <form id='commandeForm' action="{{ route('revendeur-commandes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5 mb-3">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <label class="form-label text-center">Selectionner un revendeur</label>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="form-group multiselect_div">
                    {{-- ref-opt --}}
                    <select id="revendeur-select" name="revendeur" class="multiselect multiselect-custom">
                        @foreach ($revendeurs as $revendeur)
                            <option value="{{ $revendeur->email }}"> {{ $revendeur->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if (session('failure'))
            <div class="commandes">
                <div class="curr-commande  card">
                    @for ($i = 0; $i < count($series); $i++)
                        <div class="row card-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                                <label class="form-label text-center">Selectionner un produit</label>
                                <div class="form-group multiselect_div">
                                    {{-- ref-opt --}}
                                    <select name="ref_series[]"
                                        class="multiselect multiselect-custom liste-produits-select designation"
                                        value="{{ $references[$i] }}_{{ $series[$i] }}" required>
                                        @foreach ($produits as $produit)
                                            @foreach ($variations as $variation)
                                                @if ($produit['reference'] == $variation['reference'])
                                                    @if ($variation['designation'] != $series[$i] && inarray($variation['designation'], $series))
                                                        <option
                                                            value="{{ $produit['reference'] . '_' . $variation['designation'] }}"
                                                            disabled>
                                                            {{ $produit['reference'] }}
                                                            {{ $variation['designation'] }} </option>
                                                    @else
                                                        <option
                                                            value="{{ $produit['reference'] . '_' . $variation['designation'] }}">
                                                            {{ $produit['reference'] }}
                                                            {{ $variation['designation'] }} </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 mx-auto">
                                <label class="form-label text-center">Préciser la quantité à donner au revendeur</label>
                                <input type="number" class="form-control cartQte" value="1" min="1"
                                    placeholder="quantité">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2 mx-auto form-group">
                                <div class="form-group custom-control-inline" style="margin-left: 10%; margin-top: 20%">
                                    <a class="add-to-cart-btn" title="Valider les détails" data-toggle="tooltip"
                                        data-placement="top">
                                        <i class="fe fe-check-square"></i>
                                    </a>
                                    <a class="add-new-prod-for-cart" title="Ajouter un autre produit" data-toggle="tooltip"
                                        data-placement="top">
                                        <i class="fe fe-copy"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div id="pdf-content">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <h4 class="text-center">Panier</h4>
                            <div class="card-body">
                                <div class="panier">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-vcenter table-striped" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Référence</th>
                                                    <th>Désignation</th>
                                                    <th>Prix</th>
                                                    <th>Quantité</th>
                                                    <th>Sous-total</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <hr>
                                                <tr>
                                                    <td colspan="4" class="text-right"><b>Total</b></td>
                                                    <td><b id="total">0.00</b> <small> DT </small></td>
                                                </tr>

                                            </tfoot>

                                            <tbody id="cart-table">
                                                @for ($i = 0; $i < count($series); $i++)
                                                    <tr id="{{ $references[$i] }}_{{ $series[$i] }}"
                                                        class="cart_row bg-white border-b border-gray-700">
                                                        <td><b>{{ $references[$i] }}</b> <input type="hidden"
                                                                name="references[]" value="{{ $references[$i] }}"></td>
                                                        <td><b>{{ $series[$i] }}</b> <input type="hidden"
                                                                name="series[]" value="{{ $series[$i] }}"></td>
                                                        <td class="prix">{{ $prices[$i] }}<input type="hidden"
                                                                name="prices[]" value="{{ $prices[$i] }}"></td>
                                                        <td class="qte">{{ $quantities[$i] }} <input type="hidden"
                                                                name="quantities[]" value="{{ $quantities[$i] }}"></td>
                                                        <td class="sout_total"><b>{{ $sous_totals[$i] }}</b><input
                                                                type="hidden" name="sous_totals[]"
                                                                value="{{ $sous_totals[$i] }}"></td>
                                                    </tr>
                                                @endfor
                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="commandes">
                <div class="curr-commande  card">
                    <div class="row card-body">
                        <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                            <label class="form-label text-center">Selectionner un produit</label>
                            <div class="form-group multiselect_div">
                                {{-- ref-opt --}}
                                <select name="ref_series[]"
                                    class="multiselect multiselect-custom liste-produits-select designation" required>
                                    @foreach ($produits as $produit)
                                        @foreach ($variations as $variation)
                                            @if ($produit['reference'] == $variation['reference'])
                                                <option
                                                    value="{{ $produit['reference'] . '_' . $variation['designation'] }}">
                                                    {{ $produit['reference'] }}
                                                    {{ $variation['designation'] }} </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mx-auto">
                            <label class="form-label text-center">Préciser la quantité à donner au revendeur</label>
                            <input type="number" class="form-control cartQte" value="1" min="1"
                                placeholder="quantité">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-2 mx-auto form-group">
                            <div class="form-group custom-control-inline" style="margin-left: 10%; margin-top: 20%">
                                <a class="add-to-cart-btn" title="Valider les détails" data-toggle="tooltip"
                                    data-placement="top">
                                    <i class="fe fe-check-square"></i>
                                </a>
                                <a class="add-new-prod-for-cart" title="Ajouter un autre produit" data-toggle="tooltip"
                                    data-placement="top">
                                    <i class="fe fe-copy"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pdf-content">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <h4 class="text-center">Panier</h4>
                            <div class="card-body">
                                <div class="panier">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-vcenter table-striped" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Référence</th>
                                                    <th>Désignation</th>
                                                    <th>Prix</th>
                                                    <th>Quantité</th>
                                                    <th>Sous-total</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <hr>
                                                <tr>
                                                    <td colspan="4" class="text-right"><b>Total</b></td>
                                                    <td><b id="total">0.00</b> <small> DT </small><input type="hidden" name="total" value="0.00"></td>
                                                </tr>

                                            </tfoot>

                                            <tbody id="cart-table">

                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <button type="submit" id="checkout-btn" class="btn btn-success checkout-btn" title="Enregistrer la commande"
                data-toggle="tooltip" data-placement="bottom">
                <i class="fe fe-check mr-2"></i>Valider
            </button>
        </div>

    </form>
    <script>
        var leftSidebarID = "left-sidebar-menu-panier";
    </script>
    <script>
        var produits = @json($produits);
        var variations = @json($variations);
    </script>

    {{-- <div class="shop">
        <table id="produits_table" class=" table display">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Prix </th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach ($produits as $produit)
                    <tr class="gradeA">
                        <td> <b>{{ $produit['reference'] }}</b> </td>
                        <td class="childTitle">
                            {{ $produit['label'] }}
                        </td>

                        <td> <small> {{ $produit['description'] }} </small></td>
                        <td> {{ $produit['prix'] }} </td>
                        <td><button type="button" class="btn-add-cart "
                                onclick="addToCart('{{ $produit['reference'] }}', '{{ $produit['label'] }}', {{ $produit['prix'] }}, {{ $index }})">
                                <img src="{{ Vite::asset('resources/img/panier/add-to-cart.svg') }}" alt="add-to-cart" />
                            </button> </td>
                        @php
                            $index++;
                        @endphp

                    </tr>
                @endforeach
            </tbody>
        </table>


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
                    <form action="{{ route('revendeur-commandes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <tbody id="cartTable">

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" align="right"><b>Total</b></td>
                                <td><b id="total"> 0.00</b> <small> DT </small></td>
                            </tr>
                        </tfoot>
                    </form>
                </table>
                <span class="panier-btns">
                    <button type="button" class="back-btn" title="Back" data-toggle="tooltip" data-placement="top">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button type="button" onclick="clearCart()" class="reinit-btn" title="Reinitiliser la commande"
                        data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <button type="button" href="checkout.php" class="checkout-btn" title="Enregistrer la commande"
                        data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                </span>
            </div>


        </div>

    </div> --}}
    {{-- <script>
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
                let qte =
                    `<input type="number" id="${qteId}" class="form-control" value="1" name="qtes[]" min="1"
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
    </script> --}}
@endsection
