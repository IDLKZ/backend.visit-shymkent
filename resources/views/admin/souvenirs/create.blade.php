@extends('layout.app')
@push("styles")

@endpush
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.souvenirs')}}</li>
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
                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('souvenirs.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="event_type">{{__('admin.souvenir_category')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <select class="w-100" id="category_id" name="category_id">
                                    <option value="">Не выбрано</option>
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

                            <div class="form-group">
                                <label for="event_type">{{__('admin.shop_id')}}</label>
                                <select class="w-100"  name="shop_id">
                                    @if($shops->isNotEmpty())
                                        @foreach($shops as $shop)
                                            <option value="{{$shop->id}}">
                                                {{$shop->title . "(" .  $shop->role->title . ")"}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('shop_id')
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
                                <label for="eventum">{{__('admin.price')}}</label>
                                <input type="number" min="1" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            {{--End of the price--}}

                            <div class="form-group">
                                <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                                <select class="form-select" name="status">
                                    <option value="1">{{__("admin.yes_status")}}</option>
                                    <option value="0">{{__("admin.not_status")}}</option>
                                    <option value="-1">{{__("admin.mod_status")}}</option>
                                </select>
                            </div>

                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.save')}}</button>
                            <a href="{{route("souvenirs.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
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
    </script>
@endpush
