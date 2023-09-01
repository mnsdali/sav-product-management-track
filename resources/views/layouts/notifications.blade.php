<div class="notification-widget">
    <div class="card-header">
        <h3 class="card-title">Notifications</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View
                        Details </a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i>
                        Share </a>
                    <a href="javascript:void(0)" class="dropdown-item"><i
                            class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy
                        to</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i>
                        Move to</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
                        Rename</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i>
                        Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="recent_comments list-unstyled">
@hasrole('admin')
    <?php
        $date_4days = Carbon\Carbon::now()->subDays(4)->toDateTimeString();
        $latestReclamations = App\Models\Reclamation::select('reclamations.*')
        ->orderByDesc('reclamations.updated_at')
        ->join('articles', 'articles.serie_number', '=', 'reclamations.serie_number')
        ->join('variations', 'variations.designation', '=', 'articles.var_designation')
        ->join('produits','produits.reference','=','variations.prod_ref')->get();
    ?>

@foreach ($latestReclamations as $reclamation)
<li class="hoverable-bg">

    <div class="avatar_img">
        <img class="rounded img-fluid" src="../assets/images/avatars/Reclamation.png" alt="">
    </div>
    <div class="comment_body">
        <h6>{{$reclamation->client_pseudo}} <small class="float-right rec-time">{{$reclamation->updated_at}}</small></h6>
        <small><span>{{$reclamation->serie_number}}</span>, <b>{{$reclamation->type_panne}}</b></small>
        <p><small>{{$reclamation->description_panne}} </small></p>
        <div>
            @php
                $to = Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon\Carbon::now());
                $from = Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reclamation->updated_at);

                $diff_in_hours = $to->diffInHours($from);
            @endphp
            @if($reclamation->tech_email == null)
                @if($diff_in_hours > 36  && $reclamation->etat=='non_resolu')
                    <span class="badge badge-danger">Tech Non Assigné</span>
                @elseif($diff_in_hours > 24 && $reclamation->etat=='non_resolu')
                    <span class="badge badge-warning">Tech Non Assigné</span>
                @elseif ($reclamation->etat=='non_resolu')
                    <span class="badge badge-success">Tech Non Assigné</span>
                @endif
            @else
                @if($diff_in_hours > 36 && $reclamation->etat=='en_attente')
                    <span class="badge badge-danger">En attente de technicien</span>
                @elseif($diff_in_hours > 24 && $reclamation->etat=='en_attente')
                    <span class="badge badge-warning">En attente de technicien</span>
                @elseif ($reclamation->etat=='en_attente')
                    <span class="badge badge-success">En attente de technicien</span>
                @endif
            @endif
            <a href="{{route('reclamations.index')}}" title="En-savoir plus" data-toggle="tooltip" data-placement="right"><i class="icon-eyeglasses mr-2"></i> </a>
        </div>
    </div>

</li>
<p class="text-center">
    Aucune autre notification
</p>
@endforeach
@elserole('technicien')
    <?php
        $date_7days = Carbon\Carbon::now()->subDays(7)->toDateTimeString();
        $latestReclamations = App\Models\Reclamation::where('reclamations.updated_at', '>=', $date_7days)
        ->where('tech_email', Auth::user()->email)
        ->join('articles', 'articles.serie_number', '=', 'reclamations.serie_number')
        ->join('variations', 'variations.designation', '=', 'articles.var_designation')
        ->join('produits','produits.reference','=','variations.prod_ref')
        ->orderByDesc('reclamations.updated_at')->get();
    ?>
    @foreach ($latestReclamations as $reclamation)
        <li class="hoverable-bg">

            <div class="avatar_img">
                <img class="rounded img-fluid" src="../assets/images/xs/avatar4.jpg" alt="">
            </div>
            <div class="comment_body">
                <h6>{{$reclamation->client_pseudo}} <small class="float-right rec-time">{{$reclamation->updated_at}}</small></h6>
                <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                <div>
                    @php
                        $to = Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon\Carbon::now());
                        $from = Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reclamation->updated_at);

                        $diff_in_hours = $to->diffInHours($from);
                    @endphp
                    @if($diff_in_hours > 48 && $reclamation->tech_email == null)
                        <span class="badge badge-danger">Tech Non Assigné</span>
                    @elseif($diff_in_hours > 24 && $reclamation->tech_email == null)
                        <span class="badge badge-warning">Tech Non Assigné</span>
                    @else
                        <span class="badge badge-success">Tech Non Assigné</span>
                    @endif

                    <a href="javascript:void(0);"><i class="icon-bubbles"></i></a>
                    <a href="javascript:void(0);"><i class="icon-trash"></i></a>
                </div>
            </div>

        </li>
    @endforeach

@endhasrole
</ul>
</div>
</div>


                {{-- <li class="hoverable-bg">
                    <div class="avatar_img">
                        <img class="rounded img-fluid" src="../assets/images/xs/avatar3.jpg" alt="">
                    </div>
                    <div class="comment_body">
                        <h6>Dessie Parks <small class="float-right">1min ago</small></h6>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking</p>
                        <div>
                            <span class="badge badge-danger">Rejected</span>
                            <a href="javascript:void(0);"><i class="icon-bubbles"></i></a>
                            <a href="javascript:void(0);"><i class="icon-trash"></i></a>
                        </div>
                    </div>
                </li>
                <li class="hoverable-bg">
                    <div class="avatar_img">
                        <img class="rounded img-fluid" src="../assets/images/xs/avatar6.jpg" alt="">
                    </div>
                    <div class="comment_body">
                        <h6>Gary Camara <small class="float-right">5imn ago</small></h6>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution</p>
                        <div>
                            <span class="badge badge-warning">Pending</span>
                            <a href="javascript:void(0);"><i class="icon-bubbles"></i></a>
                            <a href="javascript:void(0);"><i class="icon-trash"></i></a>
                        </div>
                    </div>
                </li> --}}


