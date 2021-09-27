@extends('layout.app')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.partner')}}</li>
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
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('partners.update',$partner->id)}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">{{__('admin.title')}}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="{{__('admin.title')}}" name='title' autocomplete="off" placeholder="{{__('admin.title')}}" value="{{$partner->title}}">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('admin.alias')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="url" class="form-control @error('alias') is-invalid @enderror" id="{{__('admin.alias')}}" name='alias' autocomplete="off" placeholder="{{__('admin.alias')}}" value="{{$partner->alias}}">
                                @error('alias')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image' accept="image/*">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>






                            <button type="submit" class="btn btn-primary mr-2">{{__('admin.change')}}</button>
                            <a href="{{route('partners.index')}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection



