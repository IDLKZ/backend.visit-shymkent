@extends("layout.app")
@push("styles")
@endpush
@section("content")
    <!-- partial -->
    <div class="page-content ">

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

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$route->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="{{__("admin.route_categories")}}">{{__('admin.route_categories')}}</label>
                    <input disabled type="text" class="form-control" id="{__('admin.route_categories')}}" name='category_id' autocomplete="off" value="{{$route->category->title}}">
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
                            @if($route->category)
                                <tbody>


                                        <tr>
                                            <td><img src="{{$route->category->getFile('image')}}" width="50"></td>
                                            <td>{{$route->category->title}}</td>
                                            <td>{{$route->category->alias}}</td>
                                            <td>
                                                @if($route->category->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($route->category->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($route->category->status == -1)
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
                                                        <a class="dropdown-item" href="{{route("route_categories.show",$route->category->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route("route_categories.edit",$route->category->id)}}">{{__("admin.change")}}</a>
                                                        <form method="post" action="{{route("route_categories.destroy",$route->category->id)}}">
                                                            @csrf
                                                            @method("delete")
                                                            <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                        </form>
                                                    </div>
                                                </div>



                                            </td>

                                        </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$route->title_kz}}">
                    @error('title_kz')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$route->title_ru}}">
                    @error('title_ru')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$route->title_en}}">
                    @error('title_en')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                {{--                            Description start--}}
                <div class="form-group">
                    <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                    <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {!! $route->description_kz !!}
                                </textarea>
                    @error('description_kz')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                    <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                    {!! $route->description_ru !!}
                                </textarea>
                    @error('description_ru')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                    <textarea  disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {!! $route->description_en !!}
                                </textarea>
                    @error('description_en')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                {{--                    Description end--}}
                {{--                            eventum, Description, Time--}}

                <div class="form-group">
                    <label for="eventum">{{__('admin.eventum')}}</label>
                    <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$route->eventum}}">
                    @error('eventum')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="distance">{{__('admin.distance')}}</label>
                    <input disabled type="number" class="form-control  @error('distance') is-invalid @enderror" id="distance" name='distance' autocomplete="off" placeholder="{{__('admin.distance')}}" value="{{$route->distance}}">
                    @error('distance')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="time">{{__('admin.time')}}</label>
                    <input disabled type="number" class="form-control  @error('time') is-invalid @enderror" id="time" name='time' autocomplete="off" placeholder="{{__('admin.time')}}" value="{{$route->time}}">
                    @error('time')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                {{--                            End of eventum--}}



                {{--                            Start Address--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.address')}}</label>
                    <input disabled type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$route->address}}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div id="map" style="height: 400px">

                </div>
                <input type="hidden" id="address_link" name="address_link">
                @error('address_link')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                {{--                            End of the address--}}

                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($route->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($route->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($route->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>
            </div>
        </div>


{{--        Places--}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.places")}}/{{__("admin.points")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createRoutePlace">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.routes")}}</th>
                        <th>{{__("admin.places")}}/{{__("admin.points")}}</th>
                        <th>{{__("admin.number")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($route->routePlace->isNotEmpty())
                        @foreach($route->routePlace as $place)
                            <tr>
                                <td>{{$route->title}}</td>
                                <td>{{$place->place->title . " (" . $place->place->type->title . ")"}}</td>
                                <td>{{$place->number}}</td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                            @if($place->place->type_id == 1)
                                                href="{{route("places.show",$place->place->id)}}"
                                                @else
                                               href="{{route("points.show",$place->place->id)}}"
                                               @endif
                                               target="_blank"
                                            >{{__("admin.info")}}</a>
                                            <a class="routePlace-edit dropdown-item" data-id="{{$place->id}}" data-number="{{$place->number}}" data-place="{{$place->place->id}}">{{__("admin.change")}}</a>
                                            <form method="post" action="{{route("route_place.destroy",$place->id)}}">
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
            </div>



        </div>



        {{--            Types --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.route_types")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createRouteType">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.routes")}}</th>
                        <th>{{__("admin.route_types")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($route->types->isNotEmpty())
                        @foreach($route->types as $type)
                            <tr>
                                <td>{{$route->title}}</td>
                                <td>{{$type->routeType->title}}</td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("route_and_type.destroy",$type->id)}}">
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
            </div>
        </div>

        {{--            Organizators --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.organizators")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createRouteOrganizator">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.routes")}}</th>
                        <th>{{__("admin.organizators")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($route->organizatorsRoute->isNotEmpty())
                        @foreach($route->organizatorsRoute as $organizator)
                            <tr>
                                <td>{{$route->title}}</td>
                                <td>{{$organizator->organizator->title ."(". $organizator->organizator->role->title .")"}}</td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("route_and_organizator.destroy",$organizator->id)}}">
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
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.id")}}</th>
                        <th>{{__("admin.image")}}</th>
                        <th>{{__("admin.title")}}</th>
                        <th>{{__("admin.role_id")}}</th>
                        <th>{{__("admin.user_id")}}</th>
                        <th>{{__("admin.status")}}</th>
                        <th>{{__("admin.eventum")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    @if($route->organizatorsRoute)
                        <tbody>

                        @if($route->organizatorsRoute->isNotEmpty())
                            @foreach($route->organizatorsRoute as $organizator)
                                <tr>
                                    <td>{{$organizator->organizator->id}}</td>
                                    <td><img src="{{$organizator->organizator->getFile('image')}}" width="50"></td>
                                    <td>{{$organizator->organizator->title}}</td>
                                    <td>{{$organizator->organizator->role->title}}</td>
                                    <td>{{$organizator->organizator->user->name}}</td>
                                    <td>
                                        @if($organizator->organizator->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($organizator->organizator->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($organizator->organizator->status == -1)
                                            <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                        @endif
                                    </td>
                                    <td>{{$organizator->organizator->eventum}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('organizators.show', $organizator->organizator->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('organizators.edit', $organizator->organizator->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('organizators.destroy', $organizator->organizator->id)}}" method="post">
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

        {{--            Galleries --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.galleries")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createGallery">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.image")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($route->galleries->isNotEmpty())
                        @foreach($route->galleries as $gallery)
                            <tr>
                                <td><img src="{{$gallery->getFile('image')}}" width="50"></td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="gallery-edit dropdown-item"  data-id="{{$gallery->id}}" data-image="{{$gallery->getFile("image")}}">{{__("admin.change")}}</a>
                                            <form method="post" action="{{route("gallery.destroy",$gallery->id)}}">
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
            </div>
        </div>

        {{--        Ratings--}}
        <div class="row bg-white py-5 px-4">
            <h2>Рейтинг</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createRating">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.title")}}</th>
                        <th>{{__("admin.routes")}}</th>
                        <th>Рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($route->ratings->isNotEmpty())
                        @foreach($route->ratings as $rating)
                            <tr>
                                <td>
                                    {{$rating->title}}
                                </td>
                                <td>
                                    {{$rating->route->title}}
                                </td>
                                <td>
                                    {{$rating->rating}}
                                </td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("ratings.destroy",$rating->id)}}">
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
            </div>
        </div>
    </div>

{{--    Route and Type--}}
    <div class="modal fade" id="createRouteType" tabindex="-1" role="dialog" aria-labelledby="createRouteType" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить типы маршрута</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("route_and_type.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="route_type">{{__('admin.route_types')}}</label>
                            <select class="w-100" id="type_id" name="type_id">
                                @if($types->isNotEmpty())
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">
                                            {{$type->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

{{--    Organizator Modal--}}
    <div class="modal fade" id="createRouteOrganizator" tabindex="-1" role="dialog" aria-labelledby="createRouteOrganizator" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить Организатора</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("route_and_organizator.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="route_type">{{__('admin.organizators')}}</label>
                            <select class="w-100" id="organizator_id" name="organizator_id">
                                @if($organizators->isNotEmpty())
                                    @foreach($organizators as $organizator)
                                        <option value="{{$organizator->id}}">
                                            {{$organizator->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('organizator_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--    Modal Gallery--}}
    <div class="modal fade" id="changeGallery" tabindex="-1" role="dialog" aria-labelledby="changeGallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить фото галлереи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="changeGalleryForm" method="post" action="" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="modal-body">
                        <img id="gallery" width="100%">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.change")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--   --}}
    {{--    Create Modal Gallery--}}
    <div class="modal fade" id="createGallery" tabindex="-1" role="dialog" aria-labelledby="createGallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать фото галлереи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("gallery.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
{{--    Rating--}}
    <div class="modal fade" id="createRating" tabindex="-1" role="dialog" aria-labelledby="createRating" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать рейтинг</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("ratings.store")}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.title')}}">{{__('admin.title')}}</label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputUsername{{__('admin.title')}}" name='title' autocomplete="off" placeholder="{{__('admin.title')}}" value="{{old('title')}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.title')}}">Рейтинг</label>
                            <input required type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" id="exampleInputUsername{{__('admin.rating')}}" name='rating' autocomplete="off" placeholder="0.0-5.0" value="{{old('rating')}}">
                            @error('rating')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--    Route and Place--}}
    <div class="modal fade" id="createRoutePlace" tabindex="-1" role="dialog" aria-labelledby="createRoutePlace" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить типы точек или мест</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("route_place.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$route->id}}" name="route_id">
                        <div class="form-group">
                            <label for="place_id">{{__('admin.points')}}/{{__("admin.places")}}</label>
                            <select class="w-100 select-2" id="place_id" name="place_id" style="width: 100%">
                                @if($places->isNotEmpty())
                                    @foreach($places as $place)
                                        <option value="{{$place->id}}">
                                            {{$place->title . "(" . $place->type->title . ")"}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('place_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="route_type">{{__('admin.number')}}</label>
                            <input type="number" name="number" min="1" max="100" style="width: 100%">
                            @error('number')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--    Change Route and Place--}}
    <div class="modal fade" id="changeRoutePlace" tabindex="-1" role="dialog" aria-labelledby="changeRoutePlace" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить типы точек или мест</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-routePlace" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <input type="hidden" value="{{$route->id}}" name="route_id">

                    <div class="modal-body">
                        @if($places->isNotEmpty())
                        <div class="form-group">
                            <label for="place_id">{{__('admin.points')}}/{{__("admin.places")}}</label>
                            <select class="w-100 select-2" id="place_id" name="place_id" style="width: 100%">
                                    @foreach($places as $place)
                                        <option value="{{$place->id}}">
                                            {{$place->title . "(" . $place->type->title . ")"}}
                                        </option>
                                    @endforeach
                            </select>
                            @error('place_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <input id="routePlace" type="text" hidden name="place_id" style="width: 100%">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="routeNumber">{{__('admin.number')}}</label>
                            <input id="routeNumber" type="number" name="number" min="1" max="100" style="width: 100%">
                            @error('number')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.change")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push("scripts")

    <script>
        let classNames = ['description_ru','description_kz','description_en'];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }
        let points =  @json(json_decode($route->address_link));
        var map = L.map('map',{preferCanvas:true}).setView([42.30, 69.56], 12);
        L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}').addTo(map);
        map.pm.addControls({
            position: 'topleft',
            drawCircle: false,
            drawCircleMarker:false,
            tooltips:false,
            drawPolyline:false,
            dragMode:false,
            cutPolygon:false,
            drawPolygon:false,
            editMode:false,
            drawMarker:false,
            rotateMode:false,
            drawRectangle:false,
        });
        map.pm.setLang('ru');
        displayMarkers();
        function displayMarkers(){
            if(points){
                if(points.length > 0){
                    for(let i = 0; i <points.length; i++){
                        L.marker([points[i].lat,points[i].lng]).addTo(map);
                    }
                    map.setView([points[0].lat,points[0].lng], 14);
                }
            }

        }

        $(".gallery-edit").on("click",function (e){
            e.preventDefault();
            let galery_id = $(this).attr("data-id");
            let image = $(this).attr("data-image");
            $("#gallery").attr("src",image);
            let url = "<?php echo route("gallery.index"); ?>" +"/"+ galery_id;
		    $('#changeGalleryForm').attr('action', url);
            jQuery.noConflict();
            $('#changeGallery').modal("show");
        });

        $(".routePlace-edit").on("click",function (e){
            e.preventDefault();
            let id = $(this).attr("data-id");
            let number = $(this).attr("data-number");
            let place = $(this).attr("data-place");
            $("#routeNumber").attr("value",number);
            $("#routePlace").attr("value",place);
            let url = "<?php echo route("route_place.index"); ?>" +"/"+ id;
            $('#edit-routePlace').attr('action', url);
            jQuery.noConflict();
            $("#changeRoutePlace").modal("show");
        });



    </script>
@endpush

