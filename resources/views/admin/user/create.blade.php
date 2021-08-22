@extends('layout.app')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{__('admin.main')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.users')}}</li>
            </ol>
        </nav>

        <div class="row">
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__("admin.create")}}</h6>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('admin-user.store')}}">
                            @csrf
                            <div class="form-group" >
                                <label>
                                    {{__("admin.role_id")}}
                                </label>
                                <select class="w-100" data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true" name="role_id">
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name='email' autocomplete="off" placeholder="{{__('admin.email')}}" value="{{old('email')}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> {{__("admin.password")}}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" autocomplete="current-password" placeholder=" {{__("admin.password")}}" name="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('admin.description')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name='description' autocomplete="off" placeholder="{{__('admin.description')}}" value="{{old('description')}}">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">{{__('admin.image')}} <small class="text-danger">{{__("admin.not_required")}}</small></label>
                                <input accept="image/jpeg,image/png,image/gif" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name='image'>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('admin.status')}}</label>
                                <input id="status" type="checkbox"  data-toggle="toggle" data-on="{{__("admin.yes_status")}}" data-off="{{__("admin.not_status")}}" data-onstyle="success" data-offstyle="danger" name="status">
                                @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="verified">{{__('admin.verified')}}</label>
                                <input id="verified" type="checkbox" checked  data-toggle="toggle" data-on="{{__("admin.verified")}}" data-off="{{__("admin.not_verified")}}" data-onstyle="success" data-offstyle="danger" name="verified">
                                @error('verified')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">{{__('admin.save')}}</button>
                            <a href="{{route("admin-user.index")}}" class="btn btn-light">{{__('admin.cancel')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


