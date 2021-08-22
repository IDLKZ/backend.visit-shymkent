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
                    {{__("admin.souvenirs")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5">
            <div class="col-md-4">
                <img src="{{$souvenir->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="event_type">{{__('admin.souvenir_category')}}</label>
                    <select disabled class="w-100" id="category_id" name="category_id">
                                <option
                                    selected>
                                    {{$souvenir->souvenirCategory ? $souvenir->souvenirCategory->title : "-"}}
                                </option>

                    </select>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>{{__("admin.image")}}</th>
                                <th>{{__("admin.title")}}</th>
                                <th>{{__("admin.alias")}}</th>
                                <th>{{__("admin.action")}}</th>
                            </tr>
                            </thead>
                            @if($souvenir->souvenirCategory)
                                <tbody>
                                        <tr>
                                            <td><img src="{{$souvenir->souvenirCategory->getFile('image')}}" width="50"></td>
                                            <td>{{$souvenir->souvenirCategory->title}}</td>
                                            <td>{{$souvenir->souvenirCategory->alias}}</td>
                                            <td>
                                                @if($souvenir->souvenirCategory->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($souvenir->souvenirCategory->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($souvenir->souvenirCategory->status == -1)
                                                    <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__("admin.action")}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route("category-souvenir.show",$souvenir->souvenirCategory->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route("category-souvenir.edit",$souvenir->souvenirCategory->id)}}">{{__("admin.change")}}</a>
                                                        <form method="post" action="{{route("category-souvenir.destroy",$souvenir->souvenirCategory->id)}}">
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

                <div class="form-group">
                    <label for="event_type">{{__('admin.shop_id')}}</label>
                    <select disabled class="w-100"  name="shop_id">
                        <option
                            selected>
                            {{$souvenir->shop->title}}
                        </option>
                    </select>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>{{__("admin.id")}}</th>
                                <th>{{__("admin.image")}}</th>
                                <th>{{__("admin.role_id")}}</th>
                                <th>{{__("admin.title")}}</th>
                                <th>{{__("admin.status")}}</th>
                                <th>{{__("admin.eventum")}}</th>
                                <th>{{__("admin.action")}}</th>
                            </tr>
                            </thead>
                            @if($souvenir->shop)
                                <tbody>
                                        <tr>
                                            <td>{{$souvenir->shop->id}}</td>
                                            <td><img src="{{$souvenir->shop->getFile('image')}}" width="50"></td>
                                            <td>{{$souvenir->shop->role->title}}</td>
                                            <td>{{$souvenir->shop->title}}</td>
                                            <td>
                                                @if($souvenir->shop->status == 1)
                                                    <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                @elseif($souvenir->shop->status == 0)
                                                    <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                @elseif($souvenir->shop->status == -1)
                                                    <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                @endif
                                            </td>
                                            <td>{{$souvenir->shop->eventum}}</td>

                                            <td class="d-flex">
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__("admin.action")}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('shops.show', $souvenir->shop->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route('shops.edit', $souvenir->shop->id)}}">{{__("admin.change")}}</a>
                                                        <form action="{{route('shops.destroy', $souvenir->shop->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
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
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$souvenir->title_kz}}">

                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$souvenir->title_ru}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$souvenir->title_en}}">

                </div>
                {{--                            Description start--}}
                <div class="form-group">
                    <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                    <textarea disabled class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off">
                                    {{$souvenir->description_kz}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                    <textarea disabled class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off">
                                    {{$souvenir->description_ru}}
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                    <textarea disabled class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off">
                                    {{$souvenir->description_en}}
                                </textarea>
                </div>
                {{--                    Description end--}}
                {{--                            Eventum--}}

                <div class="form-group">
                    <label for="eventum">{{__('admin.eventum')}}</label>
                    <input disabled type="text" class="form-control  @error('eventum') is-invalid @enderror" id="eventum" name='eventum' autocomplete="off" placeholder="{{__('admin.eventum')}}" value="{{$souvenir->eventum}}">
                </div>
                {{--                            End of eventum--}}

                {{--            Start of the price--}}
                <div class="form-group">
                    <label for="eventum">{{__('admin.price')}}</label>
                    <input disabled type="number" min="1" class="form-control  @error('price') is-invalid @enderror" id="price" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{$souvenir->price}}">

                </div>

                {{--End of the price--}}

                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($souvenir->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($souvenir->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($souvenir->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("souvenirs.edit",$souvenir->id)}}">{{__("admin.change")}}</a>
                </div>
            </div>
        </div>

        {{--            Galleries --}}
        <div class="row bg-white py-5">
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
                    @if($souvenir->galleries->isNotEmpty())
                        @foreach($souvenir->galleries as $gallery)
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
                        <input type="hidden" value="{{$souvenir->id}}" name="souvenir_id">
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
                        <input type="hidden" value="{{$souvenir->id}}" name="souvenir_id">
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
        let selectNames = [".phone",".social_networks",".sites"];
        for (let i = 0; i<classNames.length;i++){
            CKEDITOR.replace(classNames[i])
        }


        $(".gallery-edit").on("click",function (e){
            e.preventDefault();
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

