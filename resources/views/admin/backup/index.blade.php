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
                    {{__("admin.backup")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.backup")}}
                            </h6>
                            <a href="{{route("backup-create")}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($files)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.backup")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($files as $file)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$file->getFilename()}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route("backup-download",$file->getFilename())}}">{{__("admin.download")}}</a>
                                                            <a class="dropdown-item" href="{{route("backup-delete",$file->getFilename())}}">{{__("admin.delete")}}</a>
                                                        </div>
                                                    </div>



                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->
@endsection




