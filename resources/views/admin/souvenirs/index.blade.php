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
                    {{__("admin.souvenirs")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.souvenirs")}}
                            </h6>
                            <a class="search-button btn btn-success text-white" data-toggle="modal" data-target="#searchModal">
                                {{__("admin.search")}}
                                <i data-feather="search"></i>
                            </a>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
                            <a href="{{route('souvenirs.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($souvenirs)
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>{{__("admin.id")}}</th>
                                    <th>{{__("admin.image")}}</th>
                                    <th>{{__("admin.title")}}</th>
                                    <th>{{__("admin.category_id")}}</th>
                                    <th>{{__("admin.shop_id")}}</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.eventum")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>

                                    <tbody>

                                    @if($souvenirs->isNotEmpty())
                                        @foreach($souvenirs as $souvenir)
                                            <tr>
                                                <td>{{$souvenir->id}}</td>
                                                <td><img src="{{$souvenir->getFile('image')}}" width="50"></td>
                                                <td>{{$souvenir->title}}</td>
                                                <td>{{$souvenir->souvenirCategory ? $souvenir->souvenirCategory->title : "-"}}</td>
                                                <td>{{$souvenir->shop->title}}</td>
                                                <td>
                                                    @if($souvenir->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($souvenir->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($souvenir->status == -1)
                                                        <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$souvenir->eventum}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('souvenirs.show', $souvenir->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('souvenirs.edit', $souvenir->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('souvenirs.destroy', $souvenir->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
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
                            {{$souvenirs->links()}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->
    @include('layout.components.settings', $setting)
    {{--    Search--}}

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.search")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" action="{{route("search-souvenir")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-2">
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
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.price')}}">{{__('admin.price')}}</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="exampleInputUsername{{__('admin.price')}}" name='price' autocomplete="off" placeholder="{{__('admin.price')}}" value="{{old('price')}}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername{{__('admin.alias')}}">{{__('admin.alias')}}</label>
                            <input type="text" class="form-control @error('alias') is-invalid @enderror" id="exampleInputUsername{{__('admin.alias')}}" name='alias' autocomplete="off" placeholder="{{__('admin.alias')}}" value="{{old('alias')}}">
                            @error('alias')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                            <select class="form-select" name="status">
                                <option value="">{{__("admin.all")}}</option>
                                <option value="1">{{__("admin.yes_status")}}</option>
                                <option value="0">{{__("admin.not_status")}}</option>
                                <option value="-1">{{__("admin.mod_status")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pagination">{{__('admin.pagination')}}</label>
                            <input type="number" min="1" max="100" class="form-control  @error('pagination') is-invalid @enderror" id="pagination" name='pagination' autocomplete="off" placeholder="{{__('admin.pagination')}}" value="{{$setting->pagination}}">
                            @error('pagination')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.start_search")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection




