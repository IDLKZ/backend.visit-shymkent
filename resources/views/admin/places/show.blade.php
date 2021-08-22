@extends("layout.app")
@push("styles")
@endpush
@section("content")
    <!-- partial -->
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                        {{__("admin.main")}}
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__("admin.places")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$place->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                {{--                            Organizator starts--}}
                @if($place->organizator)
                <div class="form-group">
                    <label for="organizators">{{__('admin.organizators')}}</label>
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
                                <tbody>
                                        <tr>
                                            <td>{{$place->organizator->id}}</td>
                                            <td><img src="{{$place->organizator->getFile('image')}}" width="50"></td>
                                            <td>{{$place->organizator->title}}</td>
                                            <td>{{$place->organizator->role->title}}</td>
                                            <td>{{$place->organizator->user->name}}</td>
                                            <td>
                                                @if($place->organizator->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($place->organizator->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($place->organizator->status == -1)
                                                    <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                @endif
                                            </td>
                                            <td>{{$place->organizator->eventum}}</td>
                                            <td class="d-flex">
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__("admin.action")}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('organizators.show', $place->organizator->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route('organizators.edit', $place->organizator->id)}}">{{__("admin.change")}}</a>
                                                        <form action="{{route('organizators.destroy', $place->organizator->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
                @endif
{{--                End Organizator--}}
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$place->title_kz}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$place->title_ru}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$place->title_en}}">

                </div>
                {{--                            Description start--}}
                <div class="form-group">
                    <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                    <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                      {{$place->description_kz}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                    <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                     {{$place->description_ru}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                    <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$place->description_en}}
                                </textarea>

                </div>
                {{--                    Description end--}}
                {{--                            eventum--}}

                <div class="form-group">
                    <label for="eventum">{{__('admin.eventum')}}</label>
                    <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$place->eventum}}">

                </div>
                {{--                            End of eventum--}}
                {{--                            Start of contacts--}}
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.phone')}}">{{__('admin.phone')}}</label>
                    <br>
                    @if($place->phone)
                    @foreach($place->phone as $phone)
                        <a href="tel:{{$phone}}">{{$phone}}</a>
                    @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}</label>
                    <br>
                    @if($place->social_networks)
                        @foreach($place->social_networks as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.sites')}}">{{__('admin.sites')}}</label>
                    <br>
                    @if($place->sites)
                        @foreach($place->sites as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif
                </div>
                {{--                            End of contacts--}}

                {{--            Start of the price--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.price')}}</label>
                    <input disabled type="text" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{$place->price}}">
                </div>

                {{--End of the price--}}
                {{--                            Start Address--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.address')}}</label>
                    <input disabled type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$place->address}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.video_kz')}}">{{__('admin.video_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('video_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_kz')}}" name='video_kz' autocomplete="off" placeholder="{{__('admin.video_kz')}}" value="{{$place->video_kz}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.video_ru')}}">{{__('admin.video_ru')}}</label>
                    <input disabled type="text" class="form-control @error('video_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_ru')}}" name='video_ru' autocomplete="off" placeholder="{{__('admin.video_ru')}}" value="{{$place->video_ru}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.video_en')}}">{{__('admin.video_en')}}</label>
                    <input disabled type="text" class="form-control @error('video_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_en')}}" name='video_en' autocomplete="off" placeholder="{{__('admin.video_en')}}" value="{{$place->video_en}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.audio_kz')}}">{{__('admin.audio_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('audio_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_kz')}}" name='audio_kz' autocomplete="off" placeholder="{{__('admin.audio_kz')}}" value="{{$place->audio_kz}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.audio_ru')}}">{{__('admin.audio_ru')}}</label>
                    <input disabled type="text" class="form-control @error('audio_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_ru')}}" name='audio_ru' autocomplete="off" placeholder="{{__('admin.audio_ru')}}" value="{{$place->audio_ru}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.audio_en')}}">{{__('admin.audio_en')}}</label>
                    <input disabled type="text" class="form-control @error('audio_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_en')}}" name='audio_en' autocomplete="off" placeholder="{{__('admin.audio_en')}}" value="{{$place->audio_en}}">
                </div>

                <div id="map" style="height: 400px">

                </div>
                {{--                            End of the address--}}
                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($place->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($place->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($place->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>


                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("places.edit",$place->id)}}">{{__("admin.change")}}</a>
                </div>
            </div>
        </div>
        {{--        Categories --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.places_category")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createCategory">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.places_category")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($place->categoriesPlaces->isNotEmpty())
                        @foreach($place->categoriesPlaces as $category)
                            <tr>
                                <td>
                                    {{$category->categoryplace->title}}
                                </td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("categories-place.destroy",$category->id)}}">
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
        {{--        End Categories--}}
        {{--        Routes--}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.routes")}}</h2>
            @if($place->routes)
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

                        @if($place->routes->isNotEmpty())
                            @foreach($place->routes as $route)
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
                </div>
            @endif



        </div>
        {{--        Events--}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.events")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createEvent">{{__("admin.create")}}</button>
            </div>
            @if($place->placeEvent)
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>{{__("admin.id")}}</th>
                            <th>{{__("admin.places")}}</th>
                            <th>{{__("admin.events")}}</th>
                            <th>{{__("admin.action")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($place->placeEvent->isNotEmpty())
                            @foreach($place->placeEvent as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$place->title}}</td>
                                    <td>{{$item->event->title}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('events.show', $item->event->id)}}">{{__("admin.info")}}</a>
                                                <form action="{{route('place-event.destroy',  $item->id)}}" method="post">
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
                </div>
            @endif



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
                        @if($place->galleries->isNotEmpty())
                            @foreach($place->galleries as $gallery)
                                <tr>
                                    <td><img src="{{$gallery->getFile('image')}}" width="50"></td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item gallery-edit" id="gallery-edit" data-id="{{$gallery->id}}" data-image="{{$gallery->getFile("image")}}">{{__("admin.change")}}</a>
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
        {{--        Workdays--}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.workdays")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createWorkday">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.weekday_id")}}</th>
                        <th>{{__("admin.date_start")}}</th>
                        <th>{{__("admin.date_end")}}</th>
                        <th>{{__("admin.time_start")}}</th>
                        <th>{{__("admin.time_end")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($place->workdays->isNotEmpty())
                        @foreach($place->workdays as $workday)
                            <tr>
                                <td>
                                    {{$workday->weekday->title}}
                                </td>
                                <td>
                                    {{$workday->date_start}}
                                </td>
                                <td>
                                    {{$workday->date_end}}
                                </td>
                                <td>
                                    {{$workday->time_start}}
                                </td>
                                <td>
                                    {{$workday->time_end}}
                                </td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("workday.destroy",$workday->id)}}">
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
                        <th>{{__("admin.places")}}</th>
                        <th>Рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($place->ratings->isNotEmpty())
                        @foreach($place->ratings as $rating)
                            <tr>
                                <td>
                                    {{$rating->title}}
                                </td>
                                <td>
                                    {{$rating->place->title}}
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
                        <input type="hidden" value="{{$place->id}}" name="place_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image' accept="image/*">
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
                        <input type="hidden" value="{{$place->id}}" name="place_id">
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
{{--Create WorkDay--}}
    <div class="modal fade" id="createWorkday" tabindex="-1" role="dialog" aria-labelledby="createWorkday" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать время работы</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("workday.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$place->id}}" name="place_id">
                        <div class="form-group">
                            <label for="description{{__('admin.weekday_id')}}">{{__('admin.weekday_id')}}</label>
                            <select class="weekday_id" name="weekday_id" style="font-size: 14px">
                                @foreach($weekdays as $weekday)
                                    <option value="{{$weekday->id}}">
                                        {{$weekday->title}}
                                    </option>
                                @endforeach
                            </select>
                            @error('weekday_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventum">{{__('admin.date_start')}}</label>
                            <input  type="text" class="form-control  @error('date_start') is-invalid @enderror" id="date_start" name='date_start' autocomplete="off" value="{{old('date_start')}}">
                            @error('date_start')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventum">{{__('admin.date_end')}}</label>
                            <input  type="text" class="form-control  @error('date_end') is-invalid @enderror" id="date_end" name='date_end' autocomplete="off" value="{{old('date_end')}}">
                            @error('date_end')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventum">{{__('admin.time_start')}}</label>
                            <input type="text" class="form-control  @error('time_start') is-invalid @enderror" id="time_start" name='time_start' autocomplete="off" value="{{old('time_start')}}">
                            @error('time_start')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventum">{{__('admin.time_end')}}</label>
                            <input type="text" class="form-control  @error('time_end') is-invalid @enderror" id="time_end" name='time_end' autocomplete="off" value="{{old('time_end')}}">
                            @error('time_end')
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
{{--Create Category - place--}}
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать связку категория - событие</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("categories-place.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$place->id}}" name="place_id">
                        <div class="form-group">
                            <label>{{__('admin.places_category')}}</label>
                            <select class="select-2" name="category_id">
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->title}}
                                        </option>
                                    @endforeach

                                @endif
                            </select>
                            @error('category_id')
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
{{--Create Rating --}}
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
                        <input type="hidden" value="{{$place->id}}" name="place_id">
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
    {{--Create Event --}}
    <div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="createEvent" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать рейтинг</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("place-event.store")}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$place->id}}" name="place_id">
                        <div class="form-group">
                            <label for="event_type">{{__('admin.events')}}</label>
                            <select class="w-100" name="event_id" style="width: 100%">
                                @if($events->isNotEmpty())
                                    @foreach($events as $event)
                                        <option value="{{$event->id}}">
                                            {{$event->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('event_id')
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
@endsection
@push("scripts")
    <script>
        let classNames = ['description_ru','description_kz','description_en'];
        let selectNames = [".phone",".social_networks",".sites"];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }
        for (let i = 0; i<selectNames.length;i++){
            $(selectNames[i]).select2({
                multiple:true,
                tags:true
            });
        }
        $("#category_id").select2({
            multiple:true
        })
        let points =  @json(json_decode($place->address_link));
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

        $("#date_start").datepicker(
            {
                format: 'dd/mm/yyyy',
                language:"ru"
            },

        );
        $("#date_end").datepicker(
            {
                format: 'dd/mm/yyyy',
                language:"ru"
            },
        );
        $("#time_start").datetimepicker({
            datepicker:false,
            format:'H:i'
        });
        $("#time_end").datetimepicker({
            datepicker:false,
            format:'H:i'
        });
    </script>
@endpush
