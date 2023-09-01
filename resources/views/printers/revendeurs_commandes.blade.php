@extends('layouts.app')

@section('content')
    <h4 class="text-center"> List des commandes des revendeurs</h4>
    <div class="card">
        <div class="card-body">
            <div class="section-body">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="table-responsive mb-4">
                                <table class="table table-hover commandes-rev-data-table dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Revendeur</th>
                                            <th>Prix Total</th>
                                            <th>Date Vente</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Revendeur</th>
                                            <th>Prix Total</th>
                                            <th>Date Vente</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($revendeursCommandes as $cmd)
                                            <tr class="curr-commande">
                                                <td class="reference"> {{ $cmd['reference'] }} </td>
                                                <td class="username"> {{ $cmd['username'] }} </td>
                                                <td class="total"> {{ $cmd['total'] }} </td>
                                                <td class="date"> {{ $cmd['updated_at'] }} </td>
                                                <td>
                                                    <a href="{{ route('printers.showCommande', $cmd['reference']) }}"
                                                        class="view-more-commande" title="En-savoir plus"
                                                        data-toggle="tooltip" data-placement="top">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var leftSidebarID = "left-sidebar-menu-commandes-revendeurs";
    </script>
@endsection
