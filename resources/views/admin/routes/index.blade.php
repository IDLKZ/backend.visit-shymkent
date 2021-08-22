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
                            <a class="search-button btn btn-success text-white" data-toggle="modal" data-target="#searchModal">
                                {{__("admin.search")}}
                                <i data-feather="search"></i>
                            </a>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
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

    @include('layout.components.settings', $setting)
    {{--    Search--}}

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.search")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" action="{{route("search-route")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-2">
                        {{--                            Title starts--}}
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                            <input type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{old('title_kz')}}">
                            @error('title_kz')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                            <input type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{old('title_ru')}}">
                            @error('title_ru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{old('title_en')}}">
                            @error('title_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{--                            Description start--}}
                        <div class="form-group">
                            <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                            <textarea class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {{old('description_kz')}}
                                </textarea>
                            @error('description_kz')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                            <textarea class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                    {{old('description_ru')}}
                                </textarea>
                            @error('description_ru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{old('description_en')}}
                                </textarea>
                            @error('description_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="eventum">{{__('admin.eventum')}}  </label>
                            <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{old('eventum')}}">
                            @error('eventum')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="distance">{{__('admin.distance')}}  </label>
                            <input type="number" class="form-control  @error('distance') is-invalid @enderror" id="distance" name='distance' autocomplete="off" placeholder="{{__('admin.distance')}}" value="{{old('distance')}}">
                            @error('distance')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="time">{{__('admin.time')}}  </label>
                            <input type="number" class="form-control  @error('time') is-invalid @enderror" id="time" name='time' autocomplete="off" placeholder="{{__('admin.time')}}" value="{{old('time')}}">
                            @error('time')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventum">{{__('admin.address')}}  </label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{old('address')}}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                            <select class="form-select" name="status">
                                <option value="">{{__("admin.all")}}</option>
                                <option value="1">{{__("admin.yes_status")}}</option>
                                <option value="0">{{__("admin.not_status")}}</option>
                                <option value="-1">{{__("admin.mod_status")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.start_search")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection




