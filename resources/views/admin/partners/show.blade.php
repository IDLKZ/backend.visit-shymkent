@extends("layout.app")
@section("content")
    <!-- partial -->

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                        {{__("admin.main")}}
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__("admin.partner")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5">
            <div class="col-md-4">
                <img src="{{$partner->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="title">{{__('admin.title')}}</label>
                    <input disabled type="text" class="form-control @error('title') is-invalid @enderror" id="{{__('admin.title')}}" name='title' autocomplete="off" placeholder="{{__('admin.title')}}" value="{{$partner->title}}">
                </div>

                <div class="form-group">
                    <label for="title">{{__('admin.alias')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                    <input disabled type="text" class="form-control @error('alias') is-invalid @enderror" id="{{__('admin.alias')}}" name='alias' autocomplete="off" placeholder="{{__('admin.alias')}}" value="{{$partner->alias}}">
                </div>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("partners.edit",$partner->id)}}">{{__("admin.change")}}</a>
                    <form method="post" action="{{route("partners.destroy",$partner->id)}}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">{{__("admin.delete")}}</button>
                    </form>
                </div>
            </div>
        </div>



    </div>



@endsection





