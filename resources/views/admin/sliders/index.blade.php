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
                    {{__("admin.users_list")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.users_list")}}
                            </h6>
                            <a href="{{route('sliders.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Порядковый номер</th>
                                    <th>Изображение</th>
                                    <th>{{__("admin.status")}}</th>
                                    <th>{{__("admin.action")}}</th>
                                </tr>
                                </thead>
                                @if($sliders)
                                    <tbody>

                                    @if($sliders->isNotEmpty())
                                        @foreach($sliders as $slider)
                                            <tr>
                                                <td>{{$slider->title}}</td>
                                                <td>{{$slider->number}}</td>
                                                <td><img src="{{$slider->getFile('image')}}" width="50"></td>
                                                <td><input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger"></td>
                                                <td><input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger"></td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">{{__("admin.info")}}</a>
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


