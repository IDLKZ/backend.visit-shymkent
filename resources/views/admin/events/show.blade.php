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
                    {{__("admin.events")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$event->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="event_type">{{__('admin.event_type')}}</label>
                    <select disabled class="w-100" name="type_id">
                        @if($types->isNotEmpty())
                            @foreach($types as $type)
                                @if($event->type_id == $type->id)
                                    <option selected value="{{$type->id}}">
                                        {{$type->title}}
                                    </option>
                                @else
                                    <option value="{{$type->id}}">
                                        {{$type->title}}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                @if($event->organizator)
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
                                    <td>{{$event->organizator->id}}</td>
                                    <td><img src="{{$event->organizator->getFile('image')}}" width="50"></td>
                                    <td>{{$event->organizator->title}}</td>
                                    <td>{{$event->organizator->role->title}}</td>
                                    <td>{{$event->organizator->user->name}}</td>
                                    <td>
                                        @if($event->organizator->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($event->organizator->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($event->organizator->status == -1)
                                            <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                        @endif
                                    </td>
                                    <td>{{$event->organizator->eventum}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('organizators.show', $event->organizator->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('organizators.edit', $event->organizator->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('organizators.destroy', $event->organizator->id)}}" method="post">
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
                @if($event->place)
                <div class="form-group">
                    <label>{{__("admin.places")}}</label>
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
                                <tbody>
                                        <tr>
                                            <td>{{$event->place->id}}</td>
                                            <td><img src="{{$event->place->getFile('image')}}" width="50"></td>
                                            <td>{{$event->place->title}}</td>
                                            <td>{{$event->place->organizator ? $event->place->organizator->title . "(" . $event->place->organizator->role->title . ")" : "-"}}</td>
                                            <td>
                                                @if($event->place->category->isNotEmpty())
                                                    @foreach($event->place->category as $category)
                                                        <p>{{$category->title}}</p>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if($event->place->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($event->place->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($event->place->status == -1)
                                                    <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                @endif
                                            </td>
                                            <td>{{$event->place->eventum}}</td>
                                            <td class="d-flex">
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__("admin.action")}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('places.show', $event->place->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route('places.edit', $event->place->id)}}">{{__("admin.change")}}</a>
                                                        <form action="{{route('places.destroy', $event->place->id)}}" method="post">
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
                {{--                            Title starts--}}
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$event->title_kz}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$event->title_ru}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$event->title_en}}">

                </div>
                {{--                            Description start--}}
                <div class="form-group">
                    <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                    <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                      {{$event->description_kz}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                    <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                     {{$event->description_ru}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                    <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$event->description_en}}
                                </textarea>

                </div>
                {{--                    Description end--}}
                {{--                            Eventum--}}

                <div class="form-group">
                    <label for="eventum">{{__('admin.eventum')}}</label>
                    <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$event->eventum}}">

                </div>
                {{--                            End of eventum--}}
                {{--                            Start of contacts--}}
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.phone')}}">{{__('admin.phone')}}</label>
                    <br>
                    @if($event->phone)
                    @foreach($event->phone as $phone)
                        <a href="tel:{{$phone}}">{{$phone}}</a>
                    @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}</label>
                    <br>
                    @if($event->social_networks)
                        @foreach($event->social_networks as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.sites')}}">{{__('admin.sites')}}</label>
                    <br>
                    @if($event->sites)
                        @foreach($event->sites as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif
                </div>
                {{--                            End of contacts--}}

                {{--            Start of the price--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.price')}}</label>
                    <input disabled type="text" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{$event->price}}">
                </div>

                {{--End of the price--}}
                {{--                            Start Address--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.address')}}</label>
                    <input disabled type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$event->address}}">
                </div>

                <div id="map" style="height: 400px">

                </div>


                {{--                            End of the address--}}

                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($event->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($event->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($event->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>

                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("events.edit",$event->id)}}">{{__("admin.change")}}</a>
                </div>
            </div>
        </div>
        {{--        Categories --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.event_categories")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createCategory">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.event_categories")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($event->categoryEvent->isNotEmpty())
                        @foreach($event->categoryEvent as $category)
                            <tr>
                                <td>
                                    {{$category->categoryevent->title}}
                                </td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{route("categories-events.destroy",$category->id)}}">
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
            @if($event->categoriesEvents)
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

                            @if($event->categoriesEvents->isNotEmpty())
                                @foreach($event->categoriesEvents as $category)
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
                                                    <a class="dropdown-item" href="{{route("category-events.show",$category->id)}}">{{__("admin.info")}}</a>
                                                    <a class="dropdown-item" href="{{route("category-events.edit",$category->id)}}">{{__("admin.change")}}</a>
                                                    <form method="post" action="{{route("category-events.destroy",$category->id)}}">
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


            @endif
        </div>
        {{--        End Categories--}}

        {{--        Places--}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.places")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createPlace">{{__("admin.create")}}</button>
            </div>
            @if($event->placeEvent)
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>{{__("admin.id")}}</th>
                            <th>{{__("admin.events")}}</th>
                            <th>{{__("admin.places")}}</th>
                            <th>{{__("admin.action")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($event->placeEvent->isNotEmpty())
                            @foreach($event->placeEvent as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$event->title}}</td>
                                    <td>{{$item->place->title}}</td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('places.show', $item->place->id)}}">{{__("admin.info")}}</a>
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
                        @if($event->galleries->isNotEmpty())
                            @foreach($event->galleries as $gallery)
                                <tr>
                                    <td><img src="{{$gallery->getFile('image')}}" width="50"></td>
                                    <td class="d-flex">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__("admin.action")}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="gallery-edit dropdown-item" data-id="{{$gallery->id}}" data-image="{{$gallery->getFile("image")}}">{{__("admin.change")}}</a>
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
                    @if($event->workdays->isNotEmpty())
                        @foreach($event->workdays as $workday)
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
                        <th>{{__("admin.events")}}</th>
                        <th>Рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($event->ratings->isNotEmpty())
                        @foreach($event->ratings as $rating)
                            <tr>
                                <td>
                                    {{$rating->title}}
                                </td>
                                <td>
                                    {{$rating->event->title}}
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
                        <input type="hidden" value="{{$event->id}}" name="event_id">
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
                        <input type="hidden" value="{{$event->id}}" name="event_id">
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
                        <input type="hidden" value="{{$event->id}}" name="event_id">
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
{{--Create Category - Event--}}
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать связку категория - событие</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("categories-events.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$event->id}}" name="event_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <select name="category_id">
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
                        <input type="hidden" value="{{$event->id}}" name="event_id">
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
    <div class="modal fade" id="createPlace" tabindex="-1" role="dialog" aria-labelledby="createPlace" aria-hidden="true">
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
                        <input type="hidden" value="{{$event->id}}" name="event_id">
                        <div class="form-group">
                            <label for="event_type">{{__('admin.places')}}</label>
                            <select class="w-100 select-2" name="place_id" style="width: 100%">
                                @if($places->isNotEmpty())
                                    @foreach($places as $place)
                                        <option value="{{$place->id}}">
                                            {{$place->title}}
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
        let points =  @json(json_decode($event->address_link));
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
