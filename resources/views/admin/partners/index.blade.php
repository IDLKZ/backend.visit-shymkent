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
                    {{__("admin.event_categories")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.partners")}}
                            </h6>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
                            <a href="{{route('partners.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($partners)
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

                                    <tbody>

                                    @if($partners->isNotEmpty())
                                        @foreach($partners as $partner)
                                            <tr>
                                                <td><img src="{{$partner->getFile('image')}}" width="50"></td>
                                                <td>{{$partner->title}}</td>
                                                <td>{{$partner->alias}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route("partners.show",$partner->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route("partners.edit",$partner->id)}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("partners.destroy",$partner->id)}}">
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
                                {{$partners->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- partial:../../partials/_footer.html -->
    @include('layout.components.settings', $setting)
@endsection




