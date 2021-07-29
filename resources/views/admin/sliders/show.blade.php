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
            <div class="col-md-12 d-flex align-items-center" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url({{asset("/uploads/".$slider->image)}}); min-height: 100vh;background-repeat: no-repeat; background-position: center; background-attachment: fixed;background-size: cover">
            <div class="px-5">
                <h2 class="text-white my-2">
                    {{$slider->title}}
                </h2>
                <h5  class="text-white my-2">
                    {{$slider->description}}
                </h5>
                <a href="{{$slider->link}}" target="_blank" class="btn btn-main mt-5">
                    {{$slider->button}}
                </a>
            </div>



            </div>
        </div>


    </div>

@endsection
