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

        <div class="row bg-white py-5">
            <div class="col-md-4">
                <img src="{{$point->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="route_id">{{__('admin.routes')}}</label>
                    <select disabled class="w-100" name="route_id">
                                    <option selected value="{{$point->route_id}}">
                                        {{$point->route->title}}
                                    </option>
                    </select>
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
                            @if($point->route)
                                <tbody>
                                        <tr>
                                            <td>{{$point->route->id}}</td>
                                            <td><img src="{{$point->route->getFile('image')}}" width="50"></td>
                                            <td>{{$point->route->title}}</td>
                                            <td>{{$point->route->category->title}}</td>
                                            <td>
                                                @if($point->route->types)
                                                    @if($point->route->types->isNotEmpty())
                                                        <ul>
                                                            @foreach($point->route->types as $type)
                                                                <li>{{$type->routeType->title}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($point->route->organizatorsRoute)
                                                    @if($point->route->organizatorsRoute->isNotEmpty())
                                                        <ul>
                                                            @foreach($route->organizatorsRoute as $organizator)
                                                                <li>{{$organizator->organizator->title . "(" .$organizator->organizator->role->title . ")"}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$point->route->distance}}</td>
                                            <td>{{$point->route->time}}</td>
                                            <td>
                                                @if($point->route->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($point->route->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($point->route->status == -1)
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
                                                        <a class="dropdown-item" href="{{route('routes.show', $point->route->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route('routes.edit', $point->route->id)}}">{{__("admin.change")}}</a>
                                                        <form action="{{route('routes.destroy', $point->route->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
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
                {{--                            Title starts--}}
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$point->title_kz}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$point->title_ru}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$point->title_en}}">

                </div>
                {{--                            Description start--}}
                <div class="form-group">
                    <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                    <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                      {{$point->description_kz}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                    <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                     {{$point->description_ru}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                    <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$point->description_en}}
                                </textarea>

                </div>
                {{--                    Description end--}}
                {{--                            Eventum--}}

                <div class="form-group">
                    <label for="eventum">{{__('admin.eventum')}}</label>
                    <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$point->eventum}}">

                </div>
                {{--                            End of eventum--}}
                {{--                            Start of contacts--}}
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.phone')}}">{{__('admin.phone')}}</label>
                    <br>
                    @if($point->phone)
                        @foreach($point->phone as $phone)
                            <a href="tel:{{$phone}}">{{$phone}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}</label>
                    <br>
                    @if($point->social_networks)
                        @foreach($point->social_networks as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif

                </div>
                <div class="form-group border px-2 py-2">
                    <label for="{{__('admin.sites')}}">{{__('admin.sites')}}</label>
                    <br>
                    @if($point->sites)
                        @foreach($point->sites as $item)
                            <a target="_blank" href="{{$item}}">{{$item}}</a>
                        @endforeach
                    @endif
                </div>
                {{--                            End of contacts--}}
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.number')}}">{{__('admin.number')}}</label>
                    <input disabled type="text" class="form-control  @error('number') is-invalid @enderror" id="exampleInputUsername{{__('admin.number')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.number')}}" value="{{$point->number}}">

                </div>

                {{--                            Start Address--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.address')}}</label>
                    <input disabled type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$point->address}}">
                </div>

                <div id="map" style="height: 400px">

                </div>


                {{--                            End of the address--}}

                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($point->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($point->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($point->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>
            </div>
        </div>

        {{--            Galleries --}}
        <div class="row bg-white py-5 px-5">
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
                    @if($point->galleries->isNotEmpty())
                        @foreach($point->galleries as $gallery)
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
                    @if($point->workdays->isNotEmpty())
                        @foreach($point->workdays as $workday)
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
                        <input type="hidden" value="{{$point->id}}" name="point_id">
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
                        <input type="hidden" value="{{$point->id}}" name="point_id">
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
                        <input type="hidden" value="{{$point->id}}" name="point_id">
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
                            <label for="placeum">{{__('admin.date_start')}}</label>
                            <input  type="text" class="form-control  @error('date_start') is-invalid @enderror" id="date_start" name='date_start' autocomplete="off" value="{{old('date_start')}}">
                            @error('date_start')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="placeum">{{__('admin.date_end')}}</label>
                            <input  type="text" class="form-control  @error('date_end') is-invalid @enderror" id="date_end" name='date_end' autocomplete="off" value="{{old('date_end')}}">
                            @error('date_end')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="placeum">{{__('admin.time_start')}}</label>
                            <input type="text" class="form-control  @error('time_start') is-invalid @enderror" id="time_start" name='time_start' autocomplete="off" value="{{old('time_start')}}">
                            @error('time_start')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="placeum">{{__('admin.time_end')}}</label>
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

@endsection
@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha512-tPXUMumrKam4J6sFLWF/06wvl+Qyn27gMfmynldU730ZwqYkhT2dFUmttn2PuVoVRgzvzDicZ/KgOhWD+KAYQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let classNames = ['description_ru','description_kz','description_en'];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }

        let points =  @json(json_decode($point->address_link));
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
            $('#changeGalleryForm').attr('action', 'http://backend.visit-shymkent/ru/admin/gallery/'+galery_id);
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

