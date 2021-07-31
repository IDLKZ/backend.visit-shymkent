@extends('layout.app')
@push("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />    <!-- Make sure you put this AFTER Leaflet's CSS -->

@endpush
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.events')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.change")}}
                        </h6>

                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('events.update',$event->id)}}">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="event_type">{{__('admin.event_type')}}</label>
                                <select class="w-100" name="type_id">
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
                                @error('type_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="event_type">{{__('admin.user_id')}}</label>
                                <select class="w-100" id="user_id" name="user_id">
                                    @if($users->isNotEmpty())
                                        @foreach($users as $user)
                                            <option
                                                @if($user->id == $event->user_id)
                                                selected
                                                @endif
                                                value="{{$user->id}}">
                                                {{$user->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('user_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            Title starts--}}
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                                <input type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$event->title_kz}}">
                                @error('title_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                                <input type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$event->title_ru}}">
                                @error('title_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$event->title_en}}">
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
                                      {{$event->description_kz}}
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
                                     {{$event->description_ru}}
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
                                    {{$event->description_en}}
                                </textarea>
                                @error('description_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                    Description end--}}
                            {{--                            Eventum--}}

                            <div class="form-group">
                                <label for="eventum">{{__('admin.eventum')}}</label>
                                <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$event->eventum}}">
                                @error('eventum')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            End of eventum--}}

                            {{--                            Start of contacts--}}
                            <div class="form-group">
                                <label for="{{__('admin.phone')}}">{{__('admin.phone')}}</label>
                                <select multiple class="phone" name="phone[]" style="font-size: 14px">
                                    @if($event->phone)
                                        @foreach($event->phone as $phone)
                                            <option selected="selected" value="{{$phone}}">{{$phone}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}</label>
                                <select multiple class="social_networks" name="social_networks[]" style="font-size: 14px">
                                    @if($event->social_networks)
                                        @foreach($event->social_networks as $social_networks)
                                            <option selected="selected" value="{{$social_networks}}">{{$social_networks}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('social_networks')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.sites')}}">{{__('admin.sites')}}</label>
                                <select multiple class="sites" name="sites[]" style="font-size: 14px">
                                    @if($event->sites)
                                        @foreach($event->sites as $site)
                                                <option selected="selected" value="{{$site}}">{{$site}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('sites')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            End of contacts--}}
                            {{--                            Start of the images--}}
                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                                <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            {{--                            End of the images--}}
                            {{--            Start of the price--}}
                            <div class="form-group">
                                <label for="eventum">{{__('admin.price')}}</label>
                                <input type="text" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{$event->price}}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            {{--End of the price--}}
                            {{--                            Start Address--}}
                            <div class="form-group">
                                <label for="eventum">{{__('admin.address')}}</label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$event->address}}">
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
                                    <select class="form-select" name="status">
                                        <option value="1" @if($event->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                                        <option value="0" @if($event->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                                        <option value="-1" @if($event->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                                    </select>
                                </div>

                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.change')}}</button>
                            <button class="btn btn-light">{{__('admin.cancel')}}</button>
                        </form>
                    </div>
                </div>
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
            drawMarker:true,
            rotateMode:false,
            drawRectangle:false,
        });
        map.pm.setLang('ru');
        displayMarkers();

        function displayMarkers(){
            if(points.length > 0){
               for(let i = 0; i <points.length; i++){
                   console.log(points[i].lat,points[i].lng);
                   L.marker([points[i].lat,points[i].lng]).addTo(map);
               }
                map.setView([points[0].lat,points[0].lng], 14);
            }
        }


        let coordinates = [];
        $("#save").on("click",function (e) {
            e.preventDefault();
            map.eachLayer((l) => {
                if( l instanceof L.Marker){
                    coordinates.push(l.getLatLng())
                }
            })
            if(coordinates.length){
                $("#address_link").attr("value",JSON.stringify(coordinates));
            }
            $("#event-form").submit();
        })
    </script>
@endpush
