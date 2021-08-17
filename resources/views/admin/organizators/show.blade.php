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
                    {{__("admin.organizators")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$organizator->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                    <div class="form-group">
                        <label for="event_type">{{__('admin.user_id')}}</label>
                        <select disabled class="w-100" id="user_id" name="user_id">
                                    <option selected>
                                        {{$organizator->user->name}}
                                    </option>
                        </select>
                    </div>
                    <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>{{__("admin.id")}}</th>
                            <th>{{__("admin.image")}}</th>
                            <th>{{__("admin.name")}}</th>
                            <th>{{__("admin.role_id")}}</th>
                            <th>E-mail</th>
                            <th>{{__("admin.phone")}}</th>
                            <th>{{__("admin.status")}}</th>
                            <th>{{__("admin.verified")}}</th>
                            <th>{{__("admin.action")}}</th>
                        </tr>
                        </thead>
                        @if($organizator->user)
                            <tbody>
                                    <tr>
                                        <td>{{$organizator->user->id}}</td>
                                        <td><img src="{{$organizator->user->getFile('image')}}" width="50"></td>
                                        <td>{{$organizator->user->name}}</td>
                                        <td>{{$organizator->user->role->title}}</td>
                                        <td>{{$organizator->user->email}}</td>
                                        <td>{{$organizator->user->phone}}</td>
                                        <td><input disabled type="checkbox" @if($organizator->user->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                        <td><input disabled type="checkbox" @if($organizator->user->verified)checked @endif data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger"></td>
                                        <td class="d-flex">
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__("admin.action")}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route("admin-user.show",$organizator->user->id)}}">{{__("admin.info")}}</a>
                                                    <a class="dropdown-item" href="{{route("admin-user.edit",$organizator->user->id)}}">{{__("admin.change")}}</a>
                                                    <form method="post" action="{{route("admin-user.destroy",$organizator->user->id)}}">
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


                    <div class="form-group">
                        <label for="event_type">{{__('admin.role_id')}}</label>
                        <select disabled class="w-100" name="role_id">
                                    <option selected>
                                        {{$organizator->role->title}}
                                    </option>
                        </select>
                    </div>
                    {{--                            Title starts--}}
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                        <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$organizator->title_kz}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                        <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$organizator->title_ru}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                        <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$organizator->title_en}}">
                    </div>
                    {{--                            Description and Education start--}}
                    <div class="form-group">
                        <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                        <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {{$organizator->description_kz}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                        <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                    {{$organizator->description_ru}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                        <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$organizator->description_en}}
                                </textarea>
                    </div>

                    <div class="form-group">
                        <label for="description{{__('admin.education_kz')}}">{{__('admin.education_kz')}}</label>
                        <textarea disabled class="form-control @error('education_kz') is-invalid @enderror" id="description{{__('admin.education_kz')}}" name='education_kz' autocomplete="off">
                                    {{$organizator->education_kz}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.education_ru')}}">{{__('admin.education_ru')}}</label>
                        <textarea disabled class="form-control @error('education_ru') is-invalid @enderror" id="description{{__('admin.education_ru')}}" name='education_ru' autocomplete="off">
                                    {{$organizator->education_ru}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.education_en')}}">{{__('admin.education_en')}}</label>
                        <textarea disabled class="form-control @error('education_en') is-invalid @enderror" id="description{{__('admin.education_en')}}" name='education_en' autocomplete="off">
                                    {{$organizator->education_en}}
                                </textarea>
                    </div>
                    {{--                    Description end--}}
                    {{--                            Eventum--}}

                    <div class="form-group">
                        <label for="eventum">{{__('admin.eventum')}}</label>
                        <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$organizator->eventum}}">
                    </div>
                    {{--                            End of eventum--}}
                {{--                            Start of contacts--}}
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.phone')}}">{{__('admin.phone')}}</label>
                    <br>
                    @if($organizator->phone)
                        @foreach($organizator->phone as $phone)
                            <a href="tel:{{$phone}}">{{$phone}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}</label>
                    <br>
                    @if($organizator->social_networks)
                        @foreach($organizator->social_networks as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.sites')}}">{{__('admin.sites')}}</label>
                    <br>
                    @if($organizator->sites)
                        @foreach($organizator->sites as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <label for="eventum">{{__('admin.address')}}<small class="text-danger">{{__("admin.not_required")}}</small></label>
                    <input disabled type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$organizator->address}}">
                </div>
                {{--                            End of contacts--}}
                    {{--                            Start of languages--}}
                    <div class="form-group">
                        <label for="{{__('admin.languages')}}">{{__('admin.languages')}}</label>
                        <br>
                        @if($organizator->languages)
                            @foreach($organizator->languages as $item)
                                <p>{{$item}}</p>
                            @endforeach
                        @endif


                    </div>

                    {{--                            End of contacts--}}







                    <div class="form-group">
                        <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                        <select disabled class="form-select" name="status">
                            <option value="1" @if($organizator->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                            <option value="0" @if($organizator->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                            <option value="-1" @if($organizator->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                        </select>
                    </div>


            </div>
        </div>

        {{--            Galleries --}}
        <div class="row bg-white py-5 px-4 px-4">
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
                    @if($organizator->galleries->isNotEmpty())
                        @foreach($organizator->galleries as $gallery)
                            <tr>
                                <td><img src="{{$gallery->getFile('image')}}" width="50"></td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item gallery-edit" data-id="{{$gallery->id}}" data-image="{{$gallery->getFile("image")}}">{{__("admin.change")}}</a>
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
        {{--        Event--}}
        <div class="row bg-white py-5 px-4 px-4">
            <h2>{{__("admin.events")}}</h2>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.id")}}</th>
                        <th>{{__("admin.image")}}</th>
                        <th>{{__("admin.title")}}</th>
                        <th>{{__("admin.organizators")}}</th>
                        <th>{{__("admin.places")}}</th>
                        <th>{{__("admin.event_categories")}}</th>
                        <th>{{__("admin.status")}}</th>
                        <th>{{__("admin.eventum")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    @if($organizator->events)
                        <tbody>

                        @if($organizator->events->isNotEmpty())
                            @foreach($organizator->events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td><img src="{{$event->getFile('image')}}" width="50"></td>
                                    <td>{{$event->title}}</td>
                                    <td>{{$event->organizator ? $event->organizator->title : "-"}}</td>
                                    <td>{{$event->place ? $event->place->title : "-"}}</td>
                                    <td>
                                        @if($event->category->isNotEmpty())
                                            @foreach($event->category as $category)
                                                <p>{{$category->title}}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($event->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($event->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($event->status == -1)
                                            <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                        @endif
                                    </td>
                                    <td>{{$event->eventum}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('events.show', $event->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('events.edit', $event->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('events.destroy', $event->id)}}" method="post">
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
        {{--        Place--}}
        <div class="row bg-white py-5 px-4 px-4">
            <h2>{{__("admin.places")}}</h2>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.id")}}</th>
                        <th>{{__("admin.image")}}</th>
                        <th>{{__("admin.title")}}</th>
                        <th>{{__("admin.organizators")}}</th>
                        <th>{{__("admin.event_categories")}}</th>
                        <th>{{__("admin.status")}}</th>
                        <th>{{__("admin.eventum")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    @if($organizator->places)
                        <tbody>

                        @if($organizator->places->isNotEmpty())
                            @foreach($organizator->places as $place)
                                <tr>
                                    <td>{{$place->id}}</td>
                                    <td><img src="{{$place->getFile('image')}}" width="50"></td>
                                    <td>{{$place->title}}</td>
                                    <td>{{$place->organizator ? $place->organizator->title . "(" . $place->organizator->role->title . ")" : "-"}}</td>
                                    <td>
                                        @if($place->category->isNotEmpty())
                                            @foreach($place->category as $category)
                                                <p>{{$category->title}}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($place->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($place->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($place->status == -1)
                                            <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                        @endif
                                    </td>
                                    <td>{{$place->eventum}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('places.show', $place->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('places.edit', $place->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('places.destroy', $place->id)}}" method="post">
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
{{--        Routes--}}
        <div class="row bg-white py-5 px-4 px-4">
            <h2>{{__("admin.routes")}}</h2>
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
                    @if($organizator->routes)
                        <tbody>

                        @if($organizator->routes->isNotEmpty())
                            @foreach($organizator->routes as $route)
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
                    @endif
                </table>
            </div>
        </div>
{{--        Rating--}}
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
                        <th>{{__("admin.organizators")}}</th>
                        <th>Рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($organizator->ratings->isNotEmpty())
                        @foreach($organizator->ratings as $rating)
                            <tr>
                                <td>
                                    {{$rating->title}}
                                </td>
                                <td>
                                    {{$rating->organizator->title}}
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
                        <input type="hidden" value="{{$organizator->id}}" name="organizator_id">
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
                        <input type="hidden" value="{{$organizator->id}}" name="organizator_id">
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
                        <input type="hidden" value="{{$organizator->id}}" name="organizator_id">
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
@endsection
@push("scripts")
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        let classNames = ['description_ru','description_kz','description_en','education_ru','education_kz','education_en'];
        let selectNames = [".phone",".social_networks",".sites"];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }


        $(".gallery-edit").on("click",function (e){
            e.preventDefault();
            let galery_id = $(this).attr("data-id");
            let image = $(this).attr("data-image");
            $("#gallery").attr("src",image);
            $('#changeGalleryForm').attr('action', 'http://backend.visit-shymkent/ru/admin/gallery/'+galery_id);
            jQuery.noConflict();
            $('#changeGallery').modal("show");
        });

    </script>
@endpush


