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
                    {{__("admin.routes")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.routes")}}
                            </h6>
                            <a href="{{route('routes.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($routes)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.image")}}</th>
                                        <th>{{__("admin.title")}}</th>
                                        <th>{{__("admin.route_categories")}}</th>
                                        <th>{{__("admin.route_types")}}</th>
                                        <th>{{__("admin.organizators")}}</th>
                                        <th>{{__("admin.distance")}}</th>
                                        <th>{{__("admin.time")}}</th>
                                        <th>{{__("admin.status")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($routes->isNotEmpty())
                                        @foreach($routes as $route)
                                            <tr>
                                                <td>{{$route->id}}</td>
                                                <td><img src="{{$route->getFile('image')}}" width="50"></td>
                                                <td>{{$route->title}}</td>
                                                <td>{{$route->category->title}}</td>
                                                <td>
                                                    @if($route->types)
                                                        @if($route->types->isNotEmpty())
                                                            <ul>
                                                                @foreach($route->types as $type)
                                                                    <li>{{$type->routeType->title}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($route->organizatorsRoute)
                                                        @if($route->organizatorsRoute->isNotEmpty())
                                                            <ul>
                                                                @foreach($route->organizatorsRoute as $organizator)
                                                                    <li>{{$organizator->organizator->title . "(" .$organizator->organizator->role->title . ")"}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{$route->distance}}</td>
                                                <td>{{$route->time}}</td>
                                                <td>
                                                    @if($route->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($route->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($route->status == -1)
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
                                                            <a class="dropdown-item" href="{{route('routes.show', $route->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('routes.edit', $route->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('routes.destroy', $route->id)}}" method="post">
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

                                </table>
                                {{$routes->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection




