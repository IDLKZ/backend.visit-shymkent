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
                    {{__("admin.points")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.points")}}
                            </h6>
                            <a href="{{route('points.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>{{__("admin.id")}}</th>
                                    <th>{{__("admin.image")}}</th>
                                    <th>{{__("admin.routes")}}</th>
                                    <th>{{__("admin.title")}}</th>
                                    <th>{{__("admin.price")}}</th>
                                    <th>{{__("admin.number")}}</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>
                                @if($points)
                                    <tbody>

                                    @if($points->isNotEmpty())
                                        @foreach($points as $point)
                                            <tr>
                                                <td>{{$point->id}}</td>
                                                <td><img src="{{$point->getFile('image')}}" width="50"></td>
                                                <td>{{$point->route->title}}</td>
                                                <td>{{$point->title}}</td>
                                                <td>{{$point->price}}</td>
                                                <td>{{$point->number}}</td>
                                                <td><input disabled type="checkbox" @if($point->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('points.edit', $point->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('points.destroy', $point->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->

@endsection





