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


@endsection




