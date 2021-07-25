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

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.category_news")}}
                            </h6>
                            <a href="{{route('category-news.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>

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
                                @if($categories)
                                    <tbody>

                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <tr>
                                                <td><img src="{{$category->getFile('image')}}" width="50"></td>
                                                <td>{{$category->title}}</td>
                                                <td>{{$category->alias}}</td>
                                                <td><input disabled type="checkbox" @if($category->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route("category-news.edit",$category->id)}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("category-news.destroy",$category->id)}}">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td>

                                            </tr>
                                        @endforeach
                                        {{$categories->links()}}
                                    @endif


                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->

@endsection





