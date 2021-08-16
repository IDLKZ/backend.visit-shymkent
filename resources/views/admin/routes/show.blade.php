@extends("layout.app")
@push("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <textarea hidden class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
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
                    <textarea hidden class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
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
                    <textarea hidden class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {!! $route->description_en !!}
                                </textarea>
                    @error('description_en')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                {{--                    Description end--}}
                {{--                            Eventum, Description, Time--}}

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
{{--        Points--}}
        @if($route->routePoints)
            @if($route->routePoints->isNotEmpty())
                    <div class="row bg-white py-5">
                        <h2>{{__("admin.points")}}</h2>
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
                            <tbody>
                                @foreach($route->routePoints as $point)
                                    <tr>
                                        <td>{{$point->id}}</td>
                                        <td><img src="{{$point->getFile('image')}}" width="50"></td>
                                        <td>{{$point->route->title}}</td>
                                        <td>{{$point->title}}</td>
                                        <td>{{$point->price}}</td>
                                        <td>{{$point->number}}</td>
                                        <td>
                                            @if($point->status == 1)
                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                            @elseif($point->status == 0)
                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                            @elseif($point->status == -1)
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
                                                    <a class="dropdown-item" href="{{route('points.show', $point->id)}}">{{__("admin.info")}}</a>
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
                            </tbody>
                    </table>
                </div>
                @endif
        @endif



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
                                            <form method="post" action="{{route("gallery.destroy",$type->id)}}">
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
                            <label for="event_type">{{__('admin.route_types')}}</label>
                            <select class="w-100" id="type_id" name="type_id">
                                @if($types->isNotEmpty())
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">
                                            {{$type->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('types')
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

@endsection
@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
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
            if(points.length > 0){
                for(let i = 0; i <points.length; i++){
                    L.marker([points[i].lat,points[i].lng]).addTo(map);
                }
                map.setView([points[0].lat,points[0].lng], 14);
            }
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

