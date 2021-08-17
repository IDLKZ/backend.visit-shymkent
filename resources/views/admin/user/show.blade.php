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

        <div class="row bg-white py-5">
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


    </div>



@endsection







