@extends('layouts.app')

@section('content')
<h4 class="text-center"> Choisir une date</h4>
<div class="card " id="pdf-content">
    <div class="card-body">
        <div class="section-body">
            <div class="row container-fluid" style="list-style-type: none; padding:0; margin:0">


                @for ($i=0; $i<count($files);$i++)
                    <img src="{{asset('storage/'.$files[$i])}}" width=230 >
                    @if($i%3==0 && $i!=0)
                        <hr>
                    @endif
                @endfor

            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="return-btn-label d-flex">
        <small class="mt-2"> Si vous avez terminé, </small>
        <a href="{{ route('printers.qrcodes') }}" class="btn btn-link">
            <small class="return-btn-label">retourner vers l'archive des Qr Codes </small> </a>
    </div> <span class="rotative-icon mt-1 mr-4"><i class="fe fe-rotate-cw"></i></span>

    <button type="button" id="print-qrs-btn" class="btn btn-success checkout-btn" title="Impression d'un reçu"
        data-toggle="tooltip" data-placement="bottom">
        <i class="icon-printer"></i>Imprimer
    </button>
</div>


@endsection
