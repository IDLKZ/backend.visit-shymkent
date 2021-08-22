@extends("layout.app")
@push("styles")
@endpush
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
                            <a class="search-button btn btn-success text-white" data-toggle="modal" data-target="#searchModal">
                                {{__("admin.search")}}
                                <i data-feather="search"></i>
                            </a>
                            <a class="edit-settings btn btn-success text-white" data-toggle="modal" data-target="#settingsModal">
                                {{__("admin.settings")}}
                                <i data-feather="database"></i>
                            </a>
                            <a href="{{route("admin-user.create")}}" class="btn btn-success">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($users)
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

                                @if($users->isNotEmpty())
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td><img src="{{$user->getFile('image')}}" width="50"></td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->role->title}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td><input disabled type="checkbox" @if($user->status)checked @endif data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger"></td>
                                            <td><input disabled type="checkbox" @if($user->verified)checked @endif data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger"></td>
                                            <td class="d-flex">
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__("admin.action")}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route("admin-user.show",$user->id)}}">{{__("admin.info")}}</a>
                                                        <a class="dropdown-item" href="{{route("admin-user.edit",$user->id)}}">{{__("admin.change")}}</a>
                                                        <form method="post" action="{{route("admin-user.destroy",$user->id)}}">
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
                        </div>
                        {{$users->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('layout.components.settings', $setting)

    <!-- partial:../../partials/_footer.html -->
{{--    Search--}}

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.search")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" action="{{route("search-user")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-2">
                        <div class="form-group" >
                            <label>
                                {{__("admin.role_id")}}
                            </label>
                            <select class="w-100" data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true" name="role_id">
                                <option value="">{{__("admin.all")}}</option>
                                @if($roles->isNotEmpty())
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">
                                            {{$role->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('admin.name')}}</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name='name' autocomplete="off" placeholder="{{__('admin.name')}}" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{__('admin.phone')}}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name='phone' autocomplete="off" placeholder="{{__('admin.phone')}}" value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('admin.email')}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('admin.description')}} </label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name='description' autocomplete="off" placeholder="{{__('admin.description')}}" value="{{old('description')}}">
                            @error('description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description{{__('admin.status')}}">{{__('admin.status')}}</label>
                            <select class="form-select" name="status">
                                <option value="">{{__("admin.all")}}</option>
                                <option value="1">{{__("admin.yes_status")}}</option>
                                <option value="0">{{__("admin.not_status")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pagination">{{__('admin.pagination')}}</label>
                            <input type="number" min="1" max="100" class="form-control  @error('pagination') is-invalid @enderror" id="pagination" name='pagination' autocomplete="off" placeholder="{{__('admin.pagination')}}" value="{{$setting->pagination}}">
                            @error('pagination')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.start_search")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>







@endsection
@push("scripts")
@endpush
