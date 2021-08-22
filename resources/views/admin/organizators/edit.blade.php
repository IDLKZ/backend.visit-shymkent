@extends('layout.app')
@push("styles")
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
                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('organizators.update',$organizator->id)}}">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="event_type">{{__('admin.user_id')}}</label>
                                <select class="w-100 select-2" id="user_id" name="user_id">
                                    <option value="{{$organizator->user_id}}">
                                        {{$organizator->user->name . " (" . $organizator->user->role->title . ")"}}
                                    </option>
                                    @if($users->isNotEmpty())
                                        @foreach($users as $user)
                                            <option
                                                value="{{$user->id}}">
                                                {{$user->name . " (" . $user->role->title . ")"}}
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
                                <label for="description{{__('admin.education_kz')}}">{{__('admin.education_kz')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
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
                                <label for="description{{__('admin.education_ru')}}">{{__('admin.education_ru')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
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
                                <label for="description{{__('admin.education_en')}}">{{__('admin.education_en')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
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
                                <label for="eventum">{{__('admin.eventum')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$organizator->eventum}}">
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
                                <select multiple class="phone" name="phone[]" style="font-size: 14px">
                                    @if($organizator->phone)
                                        @foreach($organizator->phone as $phone)
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
                                <label for="{{__('admin.social_networks')}}">{{__('admin.social_networks')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select multiple class="social_networks" name="social_networks[]" style="font-size: 14px">
                                    @if($organizator->social_networks)
                                        @foreach($organizator->social_networks as $social_networks)
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
                                <label for="{{__('admin.sites')}}">{{__('admin.sites')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select multiple class="sites" name="sites[]" style="font-size: 14px">
                                    @if($organizator->sites)
                                        @foreach($organizator->sites as $site)
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
                            {{--                            Start of languages--}}
                            <div class="form-group">
                                <label for="{{__('admin.languages')}}">{{__('admin.languages')}}  <small class="text-danger">{{__("admin.not_required")}}</small></label>
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
                            <div class="form-group">
                                <label for="eventum">{{__('admin.address')}}<small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name='address' autocomplete="off" placeholder="{{__('admin.address')}}" value="{{$organizator->address}}">
                                @error('address')
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
                            {{--                            End of the images--}}






                            <div class="form-group">
                                <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                                <select class="form-select" name="status">
                                    <option value="1" @if($organizator->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                                    <option value="0" @if($organizator->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                                    <option value="-1" @if($organizator->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.change')}}</button>
                            <a href="{{route("organizators.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push("scripts")
    <script>
        let classNames = ['description_ru','description_kz','description_en',
            "education_kz","education_ru","education_en"
        ];
        let selectNames = [".languages"];
        let selectNames2 = [".phone",".social_networks",".sites"];

        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }
        for (let i = 0; i<selectNames.length;i++){
            $(selectNames[i]).select2({
                multiple:true,
                tags:true
            });
        }
        for (let i = 0; i<selectNames2.length;i++){
            $(selectNames2[i]).select2({
                multiple:true,
                tags:true
            });
        }

    </script>
@endpush



