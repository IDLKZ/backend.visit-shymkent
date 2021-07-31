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
                    <a class="btn btn-warning" href="{{route("category-events.edit",$category->id)}}">{{__("admin.change")}}</a>
                    <form method="post" action="{{route("category-events.destroy",$category->id)}}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">{{__("admin.delete")}}</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="row bg-white">
            @if($category->events)
                @if($category->events->isNotEmpty())
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>{{__("admin.id")}}</th>
                                <th>{{__("admin.image")}}</th>
                                <th>{{__("admin.title")}}</th>
                                <th>{{__("admin.event_categories")}}</th>
                                <th>{{__("admin.status")}}</th>
                                <th>{{__("admin.eventum")}}</th>
                                <th>{{__("admin.action")}}</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($category->events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td><img src="{{$event->getFile('image')}}" width="50"></td>
                                    <td>{{$event->title}}</td>
                                    <td>
                                        @if($event->category->isNotEmpty())
                                            @foreach($event->category as $category)
                                                <p>{{$category->title}}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($category->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($category->status == -1)
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
                                                <a class="dropdown-item" href="#">{{__("admin.info")}}</a>
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
                            </tbody>
                        </table>
                    </div>

                @endif
            @endif
        </div>
    </div>



@endsection




