@extends('layouts.app')

@section('content')
    @if (session('success'))
    <div id="successAlert" class="alert alert-icon alert-success alert-admissible fade show" role="alert">
        <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
    </div>

    @endif
    @if (session('warning'))
    <div id="successAlert" class="alert alert-icon alert-warning alert-admissible fade show" role="alert">
        <i class="fe fe-bell mr-2" aria-hidden="true"></i> {{ session('warning') }}
    </div>
    @endif
    <h4 class="text-center">Liste des revendeurs</h4>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover revendeurDTable  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Courriel</th>
                                    <th>Nom et Prénom</th>
                                    <th>Tel1</th>
                                    <th>Tel2</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                    @foreach ($revendeurs as $revendeur)
                                    <tr class="curr-rev gradeA">
                                        <td class="email"> <b>{{ $revendeur->email }}</b> </td>
                                        <td class="childTitle">
                                            {{ $revendeur->name }}
                                        </td>
                                        <td>{{ $revendeur->num_tel1 }} </td>
                                        <td class="prix"> {{ $revendeur->num_tel2 }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
@endsection
