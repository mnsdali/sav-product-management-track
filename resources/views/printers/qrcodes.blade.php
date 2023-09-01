@extends('layouts.app')

@section('content')
<h4 class="text-center"> Choisir une date</h4>
<div class="card">
    <div class="card-body">
        <div class="section-body">
            <ul class="row container-fluid" style="list-style-type: none; padding:0; margin:0">

                @foreach ($directories as $dir)
                   <li class="col-sm-12 col-md-2 col-lg-2 py-2"> <a href="{{route('printers.showDir', substr($dir,$dirLen+1))}}"> <i class="icon-folder-alt"> </i> {{substr($dir,$dirLen)}}</a> </li>
                   {{-- <li class="col-sm-12 col-md-2 col-lg-2 py-2" > <a href=""> <i class="icon-folder-alt"> </i> {{substr($dir,$dirLen)}}</a> </li> --}}
                @endforeach

            </ul>
        </div>
    </div>
</div>



@endsection
