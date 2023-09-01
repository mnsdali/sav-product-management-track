@extends('layouts.app')

@section('content')
<h4 class="text-center"> QRs de la Variation: {{$piece->ref}}</h4>
<div class="card " id="pdf-content">
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th ><h2><pre>   Piece REFs   </pre></h2></th>
                </tr>
            </thead>
        </table>
        <br>
        <div class="section-body">

            <div class="w-75 mx-auto qrs-variation">


                @for ($i=0; $i<count($qrCodes);$i++)
                    @if($i%6==0 && $i!=0)
                        <hr>
                    @endif
                    <img src="{{asset('storage/'.$qrCodes[$i])}}" class="qr_code" width=100 >

                @endfor
            </div>

        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <button type="button" id="print-qrs-btn" class="btn btn-success checkout-btn" title="Impression des qrs"
        data-toggle="tooltip" data-placement="bottom">
        <i class="icon-printer mr-2"></i>Imprimer
    </button>
</div>


@endsection
