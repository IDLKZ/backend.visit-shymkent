@extends('layout.app')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.event_categories')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.create")}}
                        </h6>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('category-events.store')}}">
                            @csrf
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


                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                                <input  accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                                <div class="form-group">
                                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                                    <select class="form-select" name="status">
                                        <option value="1">{{__("admin.yes_status")}}</option>
                                        <option value="0">{{__("admin.not_status")}}</option>
                                        <option value="-1">{{__("admin.mod_status")}}</option>
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

