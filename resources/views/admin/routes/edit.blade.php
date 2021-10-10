@extends('layout.app')
@push("styles")

@endpush
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.routes')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.change")}}
                        </h6>

                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('routes.update',$route->id)}}">
                            @csrf
                            @method("PUT")
                            {{--                    Категория, Типы и Организаторы--}}
                            <div class="form-group">
                                <label for="event_type">{{__('admin.route_categories')}}</label>
                                <select class="w-100 select-2" id="category_id" name="category_id">
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <option
                                                @if($category->id == $route->category_id)
                                                selected
                                                @endif
                                                value="{{$category->id}}">
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
                            {{--                            Title starts--}}
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                                <input type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$route->title_kz}}">
                                @error('title_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                                <input type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$route->title_ru}}">
                                @error('title_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$route->title_en}}">
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
                                <textarea class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
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
                                <textarea class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
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
                                <label for="eventum">{{__('admin.eventum')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$route->eventum}}">
                                @error('eventum')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="distance">{{__('admin.distance')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="number" class="form-control  @error('distance') is-invalid @enderror" id="distance" name='distance' autocomplete="off" placeholder="{{__('admin.distance')}}" value="{{$route->distance}}">
                                @error('distance')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="time">{{__('admin.time')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="number" class="form-control  @error('time') is-invalid @enderror" id="time" name='time' autocomplete="off" placeholder="{{__('admin.time')}}" value="{{$route->time}}">
                                @error('time')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            End of eventum--}}

                            {{--                            Start of the images--}}
                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            {{--                            End of the images--}}

                            {{--                            Start Address--}}
                            <div class="form-group">
                                <label for="eventum">{{__('admin.address')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input id="address-map" type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$route->address}}">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <small class="text-danger">{{__("admin.not_required")}}</small>
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
                                    <option value="1" @if($route->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                                    <option value="0" @if($route->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                                    <option value="-1" @if($route->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                                </select>
                            </div>

                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.change')}}</button>
                            <a href="{{route("routes.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
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
            drawMarker:true,
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


        //Yandex
        ymaps.ready(init);
        function init() {
            var suggestView1 = new ymaps.SuggestView('address-map');
            suggestView1.events.add('select', function (e) {
                let address = e.get('item').value;
                $.ajax({url: "https://geocode-maps.yandex.ru/1.x?geocode="+address +"&apikey=4ed97ace-10cc-4af1-885d-6a4e57caaa82"+"&format=json&result="+1,
                    success: function(result) {
                        let point = result.response.GeoObjectCollection.featureMember[0].GeoObject.Point;
                        point = point.pos.split(" ");
                        map.eachLayer((layer) => {
                            if(layer['_latlng']!=undefined)
                                layer.remove();
                        });
                        map.setView(new L.LatLng(point[1], point[0]), 14);
                        L.marker([point[1], point[0]]).addTo(map);
                    }});
            });

            //    Yandex Map Points
            let streetsName = "";

            map.on('pm:create', ({shape,layer}) => {
                let position = layer.getLatLng();
                $.ajax({url: "https://geocode-maps.yandex.ru/1.x?geocode="+position.lng + " " + position.lat +"&apikey=4ed97ace-10cc-4af1-885d-6a4e57caaa82"+"&format=json&result="+1,
                    success: function(result) {
                        let positionName = result.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.text;
                        if(positionName !== undefined){
                            $("#address-map").val(function(index, curValue){
                                streetsName = curValue + " ";
                            });
                            $("#address-map").val(streetsName + positionName);
                        }
                    }});
            });
        }



    </script>
@endpush

