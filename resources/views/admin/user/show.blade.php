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
                    {{__("admin.users")}}
                </li>
            </ol>
        </nav>

        <div class="row bg-white py-5 px-4">
            <div class="col-md-4">
                <img src="{{$user->getFile('image')}}" width="100%">
            </div>
            <div class="col-md-8">
                <div class="form-group" >
                    <label>
                        {{__("admin.role_id")}}
                    </label>
                    <select disabled class="js-example-basic-single w-100 select2-hidden-accessible" data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true" name="role_id">
                        <option checked value="{{$user->role_id}}">{{$user->role->title}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{__('admin.name')}}</label>
                    <input disabled type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name='name' autocomplete="off" placeholder="{{__('admin.name')}}" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="phone">{{__('admin.phone')}}</label>
                    <input disabled type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name='phone' autocomplete="off" placeholder="{{__('admin.phone')}}" value="{{$user->phone}}">
                </div>
                <div class="form-group">
                    <label for="email">{{__('admin.email')}}</label>
                    <input disabled type="email" class="form-control @error('email') is-invalid @enderror" id="email" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" value="{{$user->email}}">

                </div>

                <div class="form-group">
                    <label for="description">{{__('admin.description')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                    <input disabled type="text" class="form-control @error('description') is-invalid @enderror" id="description" name='description' autocomplete="off" placeholder="{{__('admin.description')}}" value="{{$user->description}}">
                </div>
                <div class="form-group">
                    <label for="status">{{__('admin.status')}}</label>
                    <input disabled id="status" @if($user->status)checked @endif type="checkbox"  data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger" name="status">
                </div>
                <div class="form-group">
                    <label for="verified">{{__('admin.verified')}}</label>
                    <input disabled id="verified" @if($user->verified)checked @endif type="checkbox"  data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger" name="verified">
                </div>

                <div class="d-flex justify-content-around">
                    <a class="btn btn-warning" href="{{route("admin-user.edit",$user->id)}}">{{__("admin.change")}}</a>
                </div>
            </div>
        </div>



        {{--            Blogs --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.blogs")}}</h2>
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
                    @if($user->blogs)
                        <tbody>

                        @if($user->blogs->isNotEmpty())
                            @foreach($user->blogs as $blog)
                                <tr>
                                    <td>{{$blog->id}}</td>
                                    <td><img src="{{$blog->getFile('image')}}" width="50"></td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->tag->title}}</td>
                                    <td>{{$blog->user->name}}</td>
                                    <td>
                                        @if($blog->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($blog->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($blog->status == -1)
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
                                                <a class="dropdown-item" href="{{route('blogs.show', $blog->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('blogs.edit', $blog->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('blogs.destroy', $blog->id)}}" method="post">
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
        {{--            News --}}
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.news")}}</h2>
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
                    @if($user->news)
                        <tbody>

                        @if($user->news->isNotEmpty())
                            @foreach($user->news as $new)
                                <tr>
                                    <td>{{$new->id}}</td>
                                    <td><img src="{{$new->getFile('image')}}" width="50"></td>
                                    <td>{{$new->title}}</td>
                                    <td>{{$new->categorynews->title}}</td>
                                    <td>{{$new->user->name}}</td>
                                    <td>
                                        @if($new->status == 1)
                                            <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                        @elseif($new->status == 0)
                                            <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                        @elseif($new->status == -1)
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
                                                <a class="dropdown-item" href="{{route('news.show', $new->id)}}">{{__("admin.info")}}</a>
                                                <a class="dropdown-item" href="{{route('news.edit', $new->id)}}">{{__("admin.change")}}</a>
                                                <form action="{{route('news.destroy', $new->id)}}" method="post">
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
        {{--     Oganizators   --}}
        @if($user->role_id == 4 || $user->role_id == 5)
        <div class="row bg-white py-5 px-4">
            <h2>{{__("admin.organizators")}}</h2>
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
                    @if($user->organizators)
                        <tbody>

                        @if($user->organizators->isNotEmpty())
                            @foreach($user->organizators as $organizator)
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
                    @endif
                </table>
            </div>
        </div>
        @endif
        {{--     Shops   --}}
        @if($user->role_id == 6 || $user->role_id == 7)
            <div class="row bg-white py-5 px-4">
                <h2>{{__("admin.shops")}}</h2>
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
                        @if($user->shops)
                            <tbody>

                            @if($user->shops->isNotEmpty())
                                @foreach($user->shops as $shop)
                                    <tr>
                                        <td>{{$shop->id}}</td>
                                        <td><img src="{{$shop->getFile('image')}}" width="50"></td>
                                        <td>{{$shop->role->title}}</td>
                                        <td>{{$shop->title}}</td>
                                        <td>
                                            @if($shop->status == 1)
                                                <span class="badge bg-success text-white">
                                                            {{__("admin.yes_status")}}
                                                        </span>

                                            @elseif($shop->status == 0)
                                                <span class="badge bg-danger text-white">
                                                            {{__("admin.not_status")}}
                                                        </span>
                                            @elseif($shop->status == -1)
                                                <span class="badge bg-warning text-white">
                                                            {{__("admin.mod_status")}}
                                                        </span>
                                            @endif
                                        </td>
                                        <td>{{$shop->eventum}}</td>

                                        <td class="d-flex">
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__("admin.action")}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('shops.show', $shop->id)}}">{{__("admin.info")}}</a>
                                                    <a class="dropdown-item" href="{{route('shops.edit', $shop->id)}}">{{__("admin.change")}}</a>
                                                    <form action="{{route('shops.destroy', $shop->id)}}" method="post">
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
        @endif
    </div>



@endsection







