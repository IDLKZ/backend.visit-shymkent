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
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.events")}}
                            </h6>
                            <a href="{{route('events.create')}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($events)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>EventId</th>
                                        <th>{{__("admin.image")}}</th>
                                        <th>{{__("admin.title")}}</th>
                                        <th>{{__("admin.organizators")}}</th>
                                        <th>{{__("admin.time")}}</th>
                                        <th>{{__("admin.by_user")}}</th>
                                        <th>{{__("admin.places")}}</th>
                                        <th>{{__("admin.event_categories")}}</th>
                                        <th>{{__("admin.status")}}</th>
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
                                                <td>{{$event->title}}
                                                    @if($event->event_id) <span class="badge badge-info">Eventum</span>
                                                    @if($event->eventumEvent->status == 0)
                                                        <span class="badge badge-danger">На модерации</span>
                                                    @elseif($event->eventumEvent->status == 1)
                                                        <span class="badge badge-success">Активен</span>
                                                    @endif
                                                    <small>
                                                        {{\Carbon\Carbon::parse(($event->eventumEvent->current_updated))->format("d/m/Y H:i:s")}}
                                                    </small>
                                                    @endif

                                                </td>
                                                <td>{{$event->organizator ? $event->organizator->title : "-"}}</td>
                                                <td>
                                                    @if($event->workdays)
                                                        @foreach($event->workdays as $workday)
                                                            <small>
                                                                {{$workday->date_start}} -  {{$workday->date_end}}
                                                                {{$workday->time_start}} -  {{$workday->time_end}}
                                                                {{$workday->weekday->title}}
                                                            </small>
                                                            <br>
                                                        @endforeach
                                                    @endif

                                                </td>
                                                <td>{{$event->by_user ? $event->byUser->name : "-"}}</td>
                                                <td>{{$event->place ? $event->place->title : "-"}}</td>
                                                <td>
                                                    @if($event->category->isNotEmpty())
                                                        @foreach($event->category as $category)
                                                            <p>{{$category->title}}</p>
                                                        @endforeach
                                                    @endif
                                                </td>
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




