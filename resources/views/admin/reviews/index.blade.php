@extends("layout.app")
@section("content")
    <!-- partial -->

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                        {{__("admin.main")}}
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__("admin.reviews")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.reviews")}}
                            </h6>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
                        </div>
                        @if($reviews)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.user_id")}}</th>
                                        <th>{{__("admin.rating")}}</th>
                                        <th>{{__("admin.review")}}</th>
                                        <th>{{__("admin.status")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($reviews->isNotEmpty())
                                        @foreach($reviews as $review)
                                            <tr>
                                                <td>{{$review->user->name}}</td>
                                                <td>
                                                    @if($review->rating)
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <span class="fa fa-star @if($i <= $review->rating) checked-star @endif"></span>
                                                        @endfor
                                                    @endif
                                                </td>
                                                <td>{{$review->review}}</td>
                                                <td>
                                                    @if($review->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($review->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($review->status == -1)
                                                        <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route("reviews.show",$review->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route("reviews.edit",$review->id)}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("reviews.destroy",$review->id)}}">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>
                                {{$reviews->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->
    @include('layout.components.settings', $setting)
@endsection

