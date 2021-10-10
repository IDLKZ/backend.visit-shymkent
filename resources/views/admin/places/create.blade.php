@extends('layout.app')
@push("styles")

@endpush
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.places')}}</li>
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
                            {{__("admin.create")}}
                        </h6>
                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('places.store')}}">
                            @csrf
                            <input hidden name="type_id" value="1">
                            <div class="form-group">
                                <label for="event_type">{{__('admin.places_category')}}</label>
                                <select class="w-100" id="category_id" name="category_id[]">
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->title}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category_id[]')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="event_type">{{__('admin.events')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="w-100 select-2" id="event_id" name="events[]">
                                    @if($events->isNotEmpty())
                                        @foreach($events as $event)
                                            <option value="{{$event->id}}">
                                                {{$event->title}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="event_type">{{__('admin.organizators')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="w-100 select-2" id="organizator_id" name="organizator_id">
                                    <option value="">Не выбрано</option>
                                    @if($organizators->isNotEmpty())
                                        @foreach($organizators as $organizator)
                                            <option value="{{$organizator->id}}">
                                                {{$organizator->title . "(" . $organizator->role->title . ")"}}
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
{{--                    Description end--}}
{{--                            Eventum--}}

                            <div class="form-group">
                                <label for="eventum">{{__('admin.eventum')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{old('eventum')}}">
                                @error('eventum')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
{{--                            End of eventum--}}

{{--                            Start of contacts--}}
                            <div class="form-group">
                                <label for="{{__('admin.phone')}}">{{__('admin.phone')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="phone" name="phone[]" style="font-size: 14px">
                                </select>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="social_networks" name="social_networks[]" style="font-size: 14px">
                                </select>
                                @error('social_networks')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.sites')}}">{{__('admin.sites')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="sites" name="sites[]" style="font-size: 14px">
                                </select>
                                @error('sites')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.email')}}">{{__('admin.email')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="eventum" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" value="{{old('email')}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
{{--                            End of contacts--}}
{{--                            Start of the images--}}
                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="{{__('admin.images')}}">{{__('admin.images')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input accept="image/png, image/jpeg" type="file" class="form-control @error('images') is-invalid @enderror" id="{{__('admin.images')}}" multiple name='images[]'>
                                @error('images')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
{{--                            End of the images--}}
{{--            Start of the price--}}
                            <div class="form-group">
                                <label for="eventum">{{__('admin.price')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

{{--End of the price--}}


                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.video_kz')}}">{{__('admin.video_kz')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('video_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_kz')}}" name='video_kz' autocomplete="off" placeholder="{{__('admin.video_kz')}}" value="{{old('video_kz')}}">
                                @error('video_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.video_ru')}}">{{__('admin.video_ru')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control @error('video_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_ru')}}" name='video_ru' autocomplete="off" placeholder="{{__('admin.video_ru')}}" value="{{old('video_ru')}}">
                                @error('video_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.video_en')}}">{{__('admin.video_en')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control @error('video_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.video_en')}}" name='video_en' autocomplete="off" placeholder="{{__('admin.video_en')}}" value="{{old('video_en')}}">
                                @error('video_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.audio_kz')}}">{{__('admin.audio_kz')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('audio_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_kz')}}" name='audio_kz' autocomplete="off" placeholder="{{__('admin.audio_kz')}}" value="{{old('audio_kz')}}">
                                @error('audio_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.audio_ru')}}">{{__('admin.audio_ru')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control @error('audio_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_ru')}}" name='audio_ru' autocomplete="off" placeholder="{{__('admin.audio_ru')}}" value="{{old('audio_ru')}}">
                                @error('audio_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.audio_en')}}">{{__('admin.audio_en')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control @error('audio_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.audio_en')}}" name='audio_en' autocomplete="off" placeholder="{{__('admin.audio_en')}}" value="{{old('audio_en')}}">
                                @error('audio_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            Start Address--}}
                            <div class="form-group">
                                <label for="eventum">{{__('admin.address')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" id="address-map" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{old('address')}}">
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
                                        <option value="1">{{__("admin.yes_status")}}</option>
                                        <option value="0">{{__("admin.not_status")}}</option>
                                        <option value="-1">{{__("admin.mod_status")}}</option>
                                    </select>
                                </div>


                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.save')}}</button>
                            <a href="{{route("places.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push("scripts")
    <script>
        $(document).ready(function () {



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
            $("#event_id").select2({
                multiple:true
            })

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
            });
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
            }
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
        })

    </script>
@endpush
