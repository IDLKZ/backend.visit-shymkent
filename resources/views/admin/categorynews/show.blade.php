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
                    {{__("admin.category_news")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5">
            <div class="col-md-4">
                <img src="{{$category->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_kz')}}">{{__('admin.title_kz')}}</label>
                    <input disabled type="text" class="form-control  @error('title_kz') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_kz')}}" name='title_kz' autocomplete="off" placeholder="{{__('admin.title_kz')}}" value="{{$category->title_kz}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_ru')}}">{{__('admin.title_ru')}}</label>
                    <input disabled type="text" class="form-control @error('title_ru') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_ru')}}" name='title_ru' autocomplete="off" placeholder="{{__('admin.title_ru')}}" value="{{$category->title_ru}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername{{__('admin.title_en')}}">{{__('admin.title_en')}}</label>
                    <input disabled type="text" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputUsername{{__('admin.title_en')}}" name='title_en' autocomplete="off" placeholder="{{__('admin.title_en')}}" value="{{$category->title_en}}">
                </div>

                <div class="form-group">
                    <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                    <select disabled class="form-select" name="status">
                        <option value="1" @if($category->status == 1) selected  @endif>{{__("admin.yes_status")}}</option>
                        <option value="0" @if($category->status == 0) selected  @endif>{{__("admin.not_status")}}</option>
                        <option value="-1" @if($category->status == -1) selected  @endif>{{__("admin.mod_status")}}</option>
                    </select>
                </div>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("category-news.edit",$category->id)}}">{{__("admin.change")}}</a>
                    <form method="post" action="{{route("category-news.destroy",$category->id)}}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">{{__("admin.delete")}}</button>
                    </form>
                </div>
            </div>
        </div>
        <h2>{{__("admin.news")}}</h2>
        @if($category->news)
            @if($category->news->isNotEmpty())
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>{{__("admin.id")}}</th>
                            <th>{{__("admin.image")}}</th>
                            <th>{{__("admin.title")}}</th>
                            <th>{{__("admin.category_id")}}</th>
                            <th>{{__("admin.user_id")}}</th>
                            <th>{{__("admin.status")}}</th>
                            <th>{{__("admin.action")}}</th>
                        </tr>
                        </thead>
                            <tbody>
                                @foreach($category->news as $new)
                                    <tr>
                                        <td>{{$new->id}}</td>
                                        <td><img src="{{$new->getFile('image')}}" width="50"></td>
                                        <td>{{$new->title}}</td>
                                        <td>{{$new->categorynews->title}}</td>
                                        <td>{{$new->user->name}}</td>
                                        <td>
                                            @if($new->status == 1)
                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                            @elseif($new->status == 0)
                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                            @elseif($new->status == -1)
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
                                                    <a class="dropdown-item" href="{{route('news.show', $new->id)}}">{{__("admin.info")}}</a>
                                                    <a class="dropdown-item" href="{{route('news.edit', $new->id)}}">{{__("admin.change")}}</a>
                                                    <form action="{{route('news.destroy', $new->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                    </form>
                                                </div>
                                            </div>



                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                    </table>
                </div>

            @endif

        @endif

    </div>



@endsection





