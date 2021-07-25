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
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.organizators')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.change")}}
                        </h6>
                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('organizators.update',$organizator->id)}}">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="event_type">{{__('admin.user_id')}}</label>
                                <select class="w-100" id="user_id" name="user_id">
                                    @if($users->isNotEmpty())
                                        @foreach($users as $user)
                                            <option
                                                @if($organizator->user_id == $user->id)
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
                            <div class="form-group">
                                <label for="event_type">{{__('admin.event_type')}}</label>
                                <select class="w-100" name="role_id">
                                    @if($roles->isNotEmpty())
                                        @foreach($roles as $role)
                                            <option
                                                @if($organizator->role_id == $role->id)
                                                selected
                                                @endif
                                                value="{{$role->id}}">
                                                {{$role->title}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('role_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            Title starts--}}
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                                <input type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$organizator->title_kz}}">
                                @error('title_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                                <input type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$organizator->title_ru}}">
                                @error('title_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$organizator->title_en}}">
                                @error('title_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            Description and Education start--}}
                            <div class="form-group">
                                <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                                <textarea class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {{$organizator->description_kz}}
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
                                    {{$organizator->description_ru}}
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
                                    {{$organizator->description_en}}
                                </textarea>
                                @error('description_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description{{__('admin.education_kz')}}">{{__('admin.education_kz')}}</label>
                                <textarea class="form-control @error('education_kz') is-invalid @enderror" id="description{{__('admin.education_kz')}}" name='education_kz' autocomplete="off">
                                    {{$organizator->education_kz}}
                                </textarea>
                                @error('education_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.education_ru')}}">{{__('admin.education_ru')}}</label>
                                <textarea class="form-control @error('education_ru') is-invalid @enderror" id="description{{__('admin.education_ru')}}" name='education_ru' autocomplete="off">
                                    {{$organizator->education_ru}}
                                </textarea>
                                @error('education_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.education_en')}}">{{__('admin.education_en')}}</label>
                                <textarea class="form-control @error('education_en') is-invalid @enderror" id="description{{__('admin.education_en')}}" name='education_en' autocomplete="off">
                                    {{$organizator->education_en}}
                                </textarea>
                                @error('education_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                    Description end--}}
                            {{--                            Eventum--}}

                            <div class="form-group">
                                <label for="eventum">{{__('admin.eventum')}}</label>
                                <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$organizator->eventum}}">
                                @error('eventum')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{--                            End of eventum--}}

                            {{--                            Start of languages--}}
                            <div class="form-group">
                                <label for="{{__('admin.languages')}}">{{__('admin.languages')}}</label>
                                <select multiple="multiple" class="languages" name="languages[]" style="font-size: 14px">
                                    @if($organizator->languages)
                                        @foreach($organizator->languages as $language)
                                            <option selected="selected" value="{{$language}}">{{$language}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('languages')
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






                            <div class="form-group">
                                <label for="status">{{__('admin.status')}}</label><br>
                                <input id="status" @if($organizator->status) checked @endif type="checkbox"  data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger" name="status">
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

    <script>
        let classNames = ['description_ru','description_kz','description_en',
            "education_kz","education_ru","education_en"
        ];
        let selectNames = [".languages"];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }
        for (let i = 0; i<selectNames.length;i++){
            $(selectNames[i]).select2({
                multiple:true,
                tags:true
            });
        }

    </script>
@endpush



