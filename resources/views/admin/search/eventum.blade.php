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
                    {{__("admin.events")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if($events)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>EventId</th>
                                        <th>{{__("admin.image")}}</th>
                                        <th>{{__("admin.title")}}</th>
                                        <th>{{__("admin.status")}}</th>
                                        <th>{{__("admin.places")}}</th>
                                        <th>{{__("admin.eventum")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($events->isNotEmpty())
                                        @foreach($events as $event)
                                            <tr>
                                                <td>{{$event->id}}</td>
                                                <td>{{$event->event_id}}</td>
                                                <td><img src="{{$event->getFile('image')}}" width="50"></td>
                                                <td>{{$event->title}}</td>
                                                <td>
                                                    @if($event->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($event->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($event->status == -1)
                                                        <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$event->place ? $event->place->title : "-"}}</td>
                                                <td>{{$event->eventum}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('events.show', $event->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('events.edit', $event->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('events.destroy', $event->id)}}" method="post">
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
                                {{$events->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection




