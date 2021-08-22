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
                    {{__("admin.sliders")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.sliders")}}
                            </h6>
                            <a class="search-button btn btn-success text-white" data-toggle="modal" data-target="#searchModal">
                                {{__("admin.search")}}
                                <i data-feather="search"></i>
                            </a>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
                            <a href="{{route('sliders.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($sliders)
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>{{__("admin.title")}}</th>
                                    <th>{{__("admin.number")}}</th>
                                    <th>{{__("admin.image")}}</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>
                                    <tbody>

                                    @if($sliders->isNotEmpty())
                                        @foreach($sliders as $slider)
                                            <tr>
                                                <td>{{$slider->title}}</td>
                                                <td>{{$slider->number}}</td>
                                                <td><img src="{{$slider->getFile('image')}}" width="50"></td>
                                                <td>

                                                    @if($slider->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($slider->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($slider->status == -1)
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
                                                            <a class="dropdown-item" href="{{route('sliders.show', $slider->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('sliders.edit', $slider->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('sliders.destroy', $slider->id)}}" method="post">
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
                            {{$sliders->links()}}
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
                <form method="get" action="{{route("search-slider")}}" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="description{{__('admin.description_kz')}}">{{__('admin.description_kz')}}</label>
                            <input type="text" class="form-control @error('description_kz') is-invalid @enderror" id="description{{__('admin.description_kz')}}" name='description_kz' autocomplete="off" placeholder="{{__('admin.description_kz')}}" value="{{old('description_kz')}}">
                            @error('description_kz')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.description_ru')}}">{{__('admin.description_ru')}}</label>
                            <input type="text" class="form-control @error('description_ru') is-invalid @enderror" id="description{{__('admin.description_ru')}}" name='description_ru' autocomplete="off" placeholder="{{__('admin.description_ru')}}" value="{{old('description_ru')}}">
                            @error('description_ru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.description_en')}}">{{__('admin.description_en')}}</label>
                            <input type="text" class="form-control @error('description_en') is-invalid @enderror" id="description{{__('admin.description_en')}}" name='description_en' autocomplete="off" placeholder="{{__('admin.description_en')}}" value="{{old('description_en')}}">
                            @error('description_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.button_kz')}}">{{__('admin.button_kz')}}</label>
                            <input type="text" class="form-control @error('button_kz') is-invalid @enderror" id="description{{__('admin.button_kz')}}" name='button_kz' autocomplete="off" placeholder="{{__('admin.button_kz')}}" value="{{old('button_kz')}}">
                            @error('button_kz')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.button_ru')}}">{{__('admin.button_ru')}}</label>
                            <input type="text" class="form-control @error('button_ru') is-invalid @enderror" id="description{{__('admin.button_ru')}}" name='button_ru' autocomplete="off" placeholder="{{__('admin.button_ru')}}" value="{{old('button_ru')}}">
                            @error('button_ru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.button_en')}}">{{__('admin.button_en')}}</label>
                            <input type="text" class="form-control @error('button_en') is-invalid @enderror" id="description{{__('admin.button_en')}}" name='button_en' autocomplete="off" placeholder="{{__('admin.button_en')}}" value="{{old('button_en')}}">
                            @error('button_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.link')}}">{{__('admin.link')}}</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="description{{__('admin.link')}}" name='link' autocomplete="off" placeholder="{{__('admin.link')}}" value="{{old('link')}}">
                            @error('link')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description{{__('admin.number')}}">{{__('admin.number')}}</label>
                            <input type="number" class="form-control @error('number') is-invalid @enderror" id="description{{__('admin.number')}}" name='number' autocomplete="off" placeholder="{{__('admin.number')}}" value="{{old('number')}}">
                            @error('number')
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


