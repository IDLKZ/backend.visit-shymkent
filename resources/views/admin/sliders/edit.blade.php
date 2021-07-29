@extends('layout.app')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.sliders')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__("admin.change")}}</h6>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('sliders.update', $slider->id)}}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                                <input type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$slider->title_kz}}">
                                @error('title_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                                <input type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$slider->title_ru}}">
                                @error('title_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$slider->title_en}}">
                                @error('title_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                                <input type="text" class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off" placeholder="{{__('admin.description_kz')}}" value="{{$slider->description_kz}}">
                                @error('description_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                                <input type="text" class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off" placeholder="{{__('admin.description_ru')}}" value="{{$slider->description_ru}}">
                                @error('description_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                                <input type="text" class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off" placeholder="{{__('admin.description_en')}}" value="{{$slider->description_en}}">
                                @error('description_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.button_kz')}}">{{__('admin.button_kz')}}</label>
                                <input type="text" class="form-control @error('button_kz') is-invalid @enderror" id="description{{__('admin.button_kz')}}" name='button_kz' autocomplete="off" placeholder="{{__('admin.button_kz')}}" value="{{$slider->button_kz}}">
                                @error('button_kz')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.button_ru')}}">{{__('admin.button_ru')}}</label>
                                <input type="text" class="form-control @error('button_ru') is-invalid @enderror" id="description{{__('admin.button_ru')}}" name='button_ru' autocomplete="off" placeholder="{{__('admin.button_ru')}}" value="{{$slider->button_ru}}">
                                @error('button_ru')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.button_en')}}">{{__('admin.button_en')}}</label>
                                <input type="text" class="form-control @error('button_en') is-invalid @enderror" id="description{{__('admin.button_en')}}" name='button_en' autocomplete="off" placeholder="{{__('admin.button_en')}}" value="{{$slider->button_en}}">
                                @error('button_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.link')}}">{{__('admin.link')}}</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="description{{__('admin.link')}}" name='link' autocomplete="off" placeholder="{{__('admin.link')}}" value="{{$slider->link}}">
                                @error('link')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.number')}}">{{__('admin.number')}}</label>
                                <input type="number" class="form-control @error('number') is-invalid @enderror" id="description{{__('admin.number')}}" name='number' autocomplete="off" placeholder="{{__('admin.number')}}" value="{{$slider->number}}">
                                @error('number')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                                <select class="form-select" name="status">
                                    <option value="1" @if($slider->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                                    <option value="0" @if($slider->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                                    <option value="-1" @if($slider->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">{{__('admin.save')}}</button>
                            <button class="btn btn-light">{{__('admin.cancel')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

