@extends('layout.app')
@push("styles")

@endpush
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.review')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{__("admin.change")}}
                        </h6>


{{--                            User--}}
                            <div class="form-group">
                                <label>{{__("admin.user_id")}}</label>
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__("admin.id")}}</th>
                                            <th>{{__("admin.image")}}</th>
                                            <th>{{__("admin.name")}}</th>
                                            <th>{{__("admin.role_id")}}</th>
                                            <th>E-mail</th>
                                            <th>{{__("admin.phone")}}</th>
                                            <th>{{__("admin.status")}}</th>
                                            <th>{{__("admin.verified")}}</th>
                                            <th>{{__("admin.action")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if($review->user)
                                                <tr>
                                                    <td>{{$review->user->id}}</td>
                                                    <td><img src="{{$review->user->getFile('image')}}" width="50"></td>
                                                    <td>{{$review->user->name}}</td>
                                                    <td>{{$review->user->role->title}}</td>
                                                    <td>{{$review->user->email}}</td>
                                                    <td>{{$review->user->phone}}</td>
                                                    <td><input disabled type="checkbox" @if($review->user->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                                    <td><input disabled type="checkbox" @if($review->user->verified)checked @endif data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger"></td>
                                                    <td class="d-flex">
                                                        <div class="btn-group dropdown">
                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{__("admin.action")}}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route("admin-user.show",$review->user->id)}}">{{__("admin.info")}}</a>
                                                                <a class="dropdown-item" href="{{route("admin-user.edit",$review->user->id)}}">{{__("admin.change")}}</a>
                                                                <form method="post" action="{{route("admin-user.destroy",$review->user->id)}}">
                                                                    @csrf
                                                                    @method("delete")
                                                                    <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                </form>
                                                            </div>
                                                        </div>



                                                    </td>
                                                </tr>
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>

{{--                        Place--}}
                            @if($review->place)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.places")}}
                                    </label>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.id")}}</th>
                                                <th>{{__("admin.image")}}</th>
                                                <th>{{__("admin.title")}}</th>
                                                <th>{{__("admin.organizators")}}</th>
                                                <th>{{__("admin.event_categories")}}</th>
                                                <th>{{__("admin.status")}}</th>
                                                <th>{{__("admin.eventum")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$review->place->id}}</td>
                                                <td><img src="{{$review->place->getFile('image')}}" width="50"></td>
                                                <td>{{$review->place->title}}</td>
                                                <td>{{$review->place->organizator ? $review->place->organizator->title . "(" . $review->place->organizator->role->title . ")" : "-"}}</td>
                                                <td>
                                                    @if($review->place->category->isNotEmpty())
                                                        @foreach($review->place->category as $category)
                                                            <p>{{$category->title}}</p>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($review->place->status == 1)
                                                        <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                    @elseif($review->place->status == 0)
                                                        <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                    @elseif($review->place->status == -1)
                                                        <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$review->place->eventum}}</td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('places.show', $review->place->id)}}">{{__("admin.info")}}</a>
                                                            <a class="dropdown-item" href="{{route('places.edit', $review->place->id)}}">{{__("admin.change")}}</a>
                                                            <form action="{{route('places.destroy', $review->place->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

{{--                            Event--}}
                            @if($review->event)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.events")}}
                                    </label>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.id")}}</th>
                                                <th>{{__("admin.image")}}</th>
                                                <th>{{__("admin.title")}}</th>
                                                <th>{{__("admin.organizators")}}</th>
                                                <th>{{__("admin.places")}}</th>
                                                <th>{{__("admin.event_categories")}}</th>
                                                <th>{{__("admin.status")}}</th>
                                                <th>{{__("admin.eventum")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    <tr>
                                                        <td>{{$review->event->id}}</td>
                                                        <td><img src="{{$review->event->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->event->title}}</td>
                                                        <td>{{$review->event->organizator ? $review->event->organizator->title : "-"}}</td>
                                                        <td>{{$review->event->place ? $review->event->place->title : "-"}}</td>
                                                        <td>
                                                            @if($review->event->category->isNotEmpty())
                                                                @foreach($review->event->category as $category)
                                                                    <p>{{$category->title}}</p>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($review->event->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->event->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->event->status == -1)
                                                                <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                            @endif
                                                        </td>
                                                        <td>{{$review->event->eventum}}</td>
                                                        <td class="d-flex">
                                                            <div class="btn-group dropdown">
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    {{__("admin.action")}}
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route('events.show', $review->event->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('events.edit', $review->event->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('events.destroy', $review->event->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @endif

{{--                            Route--}}
                            @if($review->route)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.routes")}}
                                    </label>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.id")}}</th>
                                                <th>{{__("admin.image")}}</th>
                                                <th>{{__("admin.title")}}</th>
                                                <th>{{__("admin.route_categories")}}</th>
                                                <th>{{__("admin.route_types")}}</th>
                                                <th>{{__("admin.organizators")}}</th>
                                                <th>{{__("admin.distance")}}</th>
                                                <th>{{__("admin.time")}}</th>
                                                <th>{{__("admin.status")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td>{{$review->route->id}}</td>
                                                        <td><img src="{{$review->route->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->route->title}}</td>
                                                        <td>{{$review->route->category->title}}</td>
                                                        <td>
                                                            @if($review->route->types)
                                                                @if($review->route->types->isNotEmpty())
                                                                    <ul>
                                                                        @foreach($review->route->types as $type)
                                                                            <li>{{$type->routeType->title}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($review->route->organizatorsRoute)
                                                                @if($review->route->organizatorsRoute->isNotEmpty())
                                                                    <ul>
                                                                        @foreach($review->route->organizatorsRoute as $review->organizator)
                                                                            <li>{{$review->organizator->organizator->title . "(" .$review->organizator->organizator->role->title . ")"}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{$review->route->distance}}</td>
                                                        <td>{{$review->route->time}}</td>
                                                        <td>
                                                            @if($review->route->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->route->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->route->status == -1)
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
                                                                    <a class="dropdown-item" href="{{route('routes.show', $review->route->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('routes.edit', $review->route->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('routes.destroy', $review->route->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @endif

{{--                            Blog--}}
                            @if($review->blog)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.blogs")}}
                                    </label>
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
                                                    <tr>
                                                        <td>{{$review->blog->id}}</td>
                                                        <td><img src="{{$review->blog->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->blog->title}}</td>
                                                        <td>{{$review->blog->tag->title}}</td>
                                                        <td>{{$review->blog->user->name}}</td>
                                                        <td>
                                                            @if($review->blog->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->blog->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->blog->status == -1)
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
                                                                    <a class="dropdown-item" href="{{route('blogs.show', $review->blog->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('blogs.edit', $review->blog->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('blogs.destroy', $review->blog->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>



                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

{{--                            News--}}
                            @if($review->news)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.news")}}
                                    </label>
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
                                                    <tr>
                                                        <td>{{$review->news->id}}</td>
                                                        <td><img src="{{$review->news->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->news->title}}</td>
                                                        <td>{{$review->news->categorynews->title}}</td>
                                                        <td>{{$review->news->user->name}}</td>
                                                        <td>
                                                            @if($review->news->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->news->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->news->status == -1)
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
                                                                    <a class="dropdown-item" href="{{route('news.show', $review->news->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('news.edit', $review->news->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('news.destroy', $review->news->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>



                                                        </td>
                                                    </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            @endif

{{--                            Shop--}}
                            @if($review->shop)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.shops")}}
                                    </label>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.id")}}</th>
                                                <th>{{__("admin.image")}}</th>
                                                <th>{{__("admin.role_id")}}</th>
                                                <th>{{__("admin.title")}}</th>
                                                <th>{{__("admin.status")}}</th>
                                                <th>{{__("admin.eventum")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    <tr>
                                                        <td>{{$review->shop->id}}</td>
                                                        <td><img src="{{$review->shop->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->shop->role->title}}</td>
                                                        <td>{{$review->shop->title}}</td>
                                                        <td>
                                                            @if($review->shop->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->shop->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->shop->status == -1)
                                                                <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                            @endif
                                                        </td>
                                                        <td>{{$review->shop->eventum}}</td>

                                                        <td class="d-flex">
                                                            <div class="btn-group dropdown">
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    {{__("admin.action")}}
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route('shops.show', $review->shop->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('shops.edit', $review->shop->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('shops.destroy', $review->shop->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>



                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
{{--                            Organizator--}}
                            @if($review->organizator_id)
                            <div class="form-group">
                                <label>
                                    {{__("admin.organizators")}}
                                </label>
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
                                                <tr>
                                                    <td>{{$review->organizator->id}}</td>
                                                    <td><img src="{{$review->organizator->getFile('image')}}" width="50"></td>
                                                    <td>{{$review->organizator->title}}</td>
                                                    <td>{{$review->organizator->role->title}}</td>
                                                    <td>{{$review->organizator->user->name}}</td>
                                                    <td>
                                                        @if($review->organizator->status == 1)
                                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                        @elseif($review->organizator->status == 0)
                                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                        @elseif($review->organizator->status == -1)
                                                            <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>{{$review->organizator->eventum}}</td>
                                                    <td class="d-flex">
                                                        <div class="btn-group dropdown">
                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{__("admin.action")}}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('organizators.show', $review->organizator->id)}}">{{__("admin.info")}}</a>
                                                                <a class="dropdown-item" href="{{route('organizators.edit', $review->organizator->id)}}">{{__("admin.change")}}</a>
                                                                <form action="{{route('organizators.destroy', $review->organizator->id)}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                </form>
                                                            </div>
                                                        </div>



                                                    </td>
                                                </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            @endif
{{--                            Souvenir--}}
                            @if($review->souvenir)
                                <div class="form-group">
                                    <label>
                                        {{__("admin.souvenirs")}}
                                    </label>
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
                                                    <tr>
                                                        <td>{{$review->souvenir->id}}</td>
                                                        <td><img src="{{$review->souvenir->getFile('image')}}" width="50"></td>
                                                        <td>{{$review->souvenir->title}}</td>
                                                        <td>{{$review->souvenir->souvenirCategory ? $review->souvenir->souvenirCategory->title : "-"}}</td>
                                                        <td>{{$review->souvenir->shop->title}}</td>
                                                        <td>
                                                            @if($review->souvenir->status == 1)
                                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                                            @elseif($review->souvenir->status == 0)
                                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                                            @elseif($review->souvenir->status == -1)
                                                                <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                                            @endif
                                                        </td>
                                                        <td>{{$review->souvenir->eventum}}</td>
                                                        <td class="d-flex">
                                                            <div class="btn-group dropdown">
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    {{__("admin.action")}}
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route('souvenirs.show', $review->souvenir->id)}}">{{__("admin.info")}}</a>
                                                                    <a class="dropdown-item" href="{{route('souvenirs.edit', $review->souvenir->id)}}">{{__("admin.change")}}</a>
                                                                    <form action="{{route('souvenirs.destroy', $review->souvenir->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item">{{__("admin.delete")}}</button>
                                                                    </form>
                                                                </div>
                                                            </div>



                                                        </td>
                                                    </tr>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            @endif


{{--                            --}}


{{--                            Rating--}}
                            @if($review->rating)
                            <div class="form-group">
                                <label>{{__("admin.rating")}}</label>
                                @if($review->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star @if($i <= $review->rating) checked-star @endif"></span>
                                    @endfor
                                @endif
                            </div>
                            @endif





                            {{--                            Review start--}}
                            <div class="form-group my-2  pa-4">
                                <label>{{__("admin.review")}}</label>
                                <p class="text-dark">{{$review->review}}</p>
                            </div>

                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <form id="event-form" class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('reviews.update',$review->id)}}">
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="user_id" value="{{$review->user_id}}">
                            <div class="form-group">
                                <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                                <select class="form-select" name="status">
                                    <option value="1" @if($review->status == 1) selected @endif>{{__("admin.yes_status")}}</option>
                                    <option value="0" @if($review->status == 0) selected @endif>{{__("admin.not_status")}}</option>
                                    <option value="-1" @if($review->status == -1) selected @endif>{{__("admin.mod_status")}}</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" id="save" class="btn btn-primary mr-2">{{__('admin.change')}}</button>
                            <a href="{{route("events.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


