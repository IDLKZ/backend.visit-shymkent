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
                    {{__("admin.organizators")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.organizators")}}
                            </h6>
                            <a href="{{route('organizators.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($organizators)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.image")}}</th>
                                        <th>{{__("admin.title")}}</th>
                                        <th>{{__("admin.role_id")}}</th>
                                        <th>{{__("admin.user_id")}}</th>
                                        <th>{{__("admin.status")}}</th>
                                        <th>{{__("admin.eventum")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($organizators->isNotEmpty())
                                        @foreach($organizators as $organizator)
                                            <tr>
                                                <td>{{$organizator->id}}</td>
                                                <td><img src="{{$organizator->getFile('image')}}" width="50"></td>
                                                <td>{{$organizator->title}}</td>
                                                <td>{{$organizator->role->title}}</td>
                                                <td>{{$organizator->user->name}}</td>
                                                <td>
                                                    @if($organizator->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($organizator->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($organizator->status == -1)
                                                        <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$organizator->eventum}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('organizators.show', $organizator->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('organizators.edit', $organizator->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('organizators.destroy', $organizator->id)}}" method="post">
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
                                {{$organizators->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection




