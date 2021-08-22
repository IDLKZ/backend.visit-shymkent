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
                    {{__("admin.places_category")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.places_category")}}
                            </h6>
                            <a href="{{route('category-place.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($categoryPlaces)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.image")}}</th>
                                        <th>{{__("admin.title")}}</th>
                                        <th>{{__("admin.alias")}}</th>
                                        <th>{{__("admin.status")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($categoryPlaces->isNotEmpty())
                                        @foreach($categoryPlaces as $category)
                                            <tr>
                                                <td><img src="{{$category->getFile('image')}}" width="50"></td>
                                                <td>{{$category->title}}</td>
                                                <td>{{$category->alias}}</td>
                                                <td>
                                                    @if($category->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($category->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($category->status == -1)
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
                                                            <a class="dropdown-item" href="{{route("category-place.show",$category->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route("category-place.edit",$category->id)}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("category-place.destroy",$category->id)}}">
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
                                {{$categoryPlaces->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection




