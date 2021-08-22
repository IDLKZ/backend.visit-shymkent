@extends("layout.app")
@push("styles")
@endpush
@section("content")
    <!-- partial -->
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                        {{__("admin.main")}}
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__("admin.news")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$news->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">

                    <div class="form-group">
                        <label for="categories_news">{{__('admin.category_news')}}</label>
                        <select disabled class="w-100" name="category_id">
                                    <option selected>
                                        {{$news->categorynews->title}}
                                    </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="event_type">{{__('admin.user_id')}}</label>
                        <select disabled class="w-100" id="author_id" name="author_id">
                                    <option selected>
                                        {{$news->user->name}}
                                    </option>
                        </select>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>{{__("admin.id")}}</th>
                                    <th>{{__("admin.image")}}</th>
                                    <th>{{__("admin.name")}}</th>
                                    <th>{{__("admin.role_id")}}</th>
                                    <th>E-mail</th>
                                    <th>{{__("admin.phone")}}</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.verified")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>
                                @if($news->user)
                                    <tbody>
                                    <tr>
                                        <td>{{$news->user->id}}</td>
                                        <td><img src="{{$news->user->getFile('image')}}" width="50"></td>
                                        <td>{{$news->user->name}}</td>
                                        <td>{{$news->user->role->title}}</td>
                                        <td>{{$news->user->email}}</td>
                                        <td>{{$news->user->phone}}</td>
                                        <td><input disabled type="checkbox" @if($news->user->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                        <td><input disabled type="checkbox" @if($news->user->verified)checked @endif data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger"></td>
                                        <td class="d-flex">
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__("admin.action")}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route("admin-user.show",$news->user->id)}}">{{__("admin.info")}}</a>
                                                    <a class="dropdown-item" href="{{route("admin-user.edit",$news->user->id)}}">{{__("admin.change")}}</a>
                                                    <form method="post" action="{{route("admin-user.destroy",$news->user->id)}}">
                                                        @csrf
                                                        @method("delete")
                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                    </form>
                                                </div>
                                            </div>



                                        </td>
                                    </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{--                            Title starts--}}
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                        <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$news->title_kz}}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                        <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$news->title_ru}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                        <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$news->title_en}}">
                    </div>
                    {{--                            Description and Education start--}}
                    <div class="form-group">
                        <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                        <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {{$news->description_kz}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                        <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                    {{$news->description_ru}}
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                        <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$news->description_en}}
                                </textarea>
                    </div>


                    {{--                    Description end--}}


                    <div class="form-group">
                        <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                        <select disabled class="form-select" name="status">
                            <option value="1" @if($news->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                            <option value="0" @if($news->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                            <option value="-1" @if($news->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                        </select>
                    </div>

                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("news.edit",$news->id)}}">{{__("admin.change")}}</a>
                </div>
            </div>
        </div>

        {{--            Galleries --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.galleries")}}</h2>
            <div class="col-md-12 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createGallery">{{__("admin.create")}}</button>
            </div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__("admin.image")}}</th>
                        <th>{{__("admin.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($news->galleries->isNotEmpty())
                        @foreach($news->galleries as $gallery)
                            <tr>
                                <td><img src="{{$gallery->getFile('image')}}" width="50"></td>
                                <td class="d-flex">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__("admin.action")}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="gallery-edit dropdown-item" data-id="{{$gallery->id}}" data-image="{{$gallery->getFile("image")}}">{{__("admin.change")}}</a>
                                            <form method="post" action="{{route("gallery.destroy",$gallery->id)}}">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                            </form>
                                        </div>
                                    </div>



                                </td>

                            </tr>
                        @endforeach

                    @endif


                    </tbody>
                </table>
            </div>
        </div>


    </div>

    {{--    Modal Gallery--}}
    <div class="modal fade" id="changeGallery" tabindex="-1" role="dialog" aria-labelledby="changeGallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить фото галлереи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="changeGalleryForm" method="post" action="" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="modal-body">
                        <img id="gallery" width="100%">
                        <input type="hidden" value="{{$news->id}}" name="news_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.change")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--   --}}
    {{--    Create Modal Gallery--}}
    <div class="modal fade" id="createGallery" tabindex="-1" role="dialog" aria-labelledby="createGallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать фото галлереи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("gallery.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$news->id}}" name="news_id">
                        <div class="form-group">
                            <label for="description{{__('admin.image')}}">{{__('admin.image')}}</label>
                            <input accept="image/png, image/jpeg" type="file" class="form-control @error('image') is-invalid @enderror" id="description{{__('admin.image')}}" name='image'>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.create")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        let classNames = ['description_ru','description_kz','description_en'];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }


        $(".gallery-edit").on("click",function (e){
            e.prnewsDefault();
            let galery_id = $(this).attr("data-id");
            let image = $(this).attr("data-image");
            $("#gallery").attr("src",image);
          let url = "<?php echo route("gallery.index"); ?>" +"/"+ galery_id;
		$('#changeGalleryForm').attr('action', url);
            jQuery.noConflict();
            $('#changeGallery').modal("show");
        });

    </script>
@endpush

