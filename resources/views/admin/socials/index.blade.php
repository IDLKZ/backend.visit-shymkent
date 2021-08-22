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
                    {{__("admin.socials")}}
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <h6 class="card-title">
                                {{__("admin.socials")}}
                            </h6>

                            <a  class="btn btn-success text-white" data-toggle="modal" data-target="#createSocialModal">
                                {{__("admin.create")}}
                                <i data-feather="plus"></i>
                            </a>
                        </div>
                        @if($socials)
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin.id")}}</th>
                                        <th>{{__("admin.icon")}}</th>
                                        <th>{{__("admin.alias")}}</th>
                                        <th>{{__("admin.action")}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($socials->isNotEmpty())
                                        @foreach($socials as $social)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><i class="{{$social->icon}}"></i></td>
                                                <td><a href="{{$social->alias}}" target="_blank">{{$social->alias}}</a> </td>
                                                <td class="d-flex">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{__("admin.action")}}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="edit-social dropdown-item" data-id="{{$social->id}}" data-alias="{{$social->alias}}">{{__("admin.change")}}</a>
                                                            <form method="post" action="{{route("socials.destroy",$social->id)}}">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Create social -->
    <div class="modal fade" id="createSocialModal" tabindex="-1" role="dialog" aria-labelledby="createSocialModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.socials")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("socials.store")}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="icon">{{__('admin.icon')}}</label>
                            <select class="w-100" data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true" name="icon">
                                @if($icons->isNotEmpty())
                                    @foreach($icons as $key => $value)
                                        <option value="{{$key}}">
                                            {{$value}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            @error('icon')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="social">{{__('admin.alias')}}</label>
                            <input type="text" class="form-control  @error('alias') is-invalid @enderror" id="alias" name='alias' autocomplete="off" placeholder="{{__('admin.alias')}}" >
                            @error('alias')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.save")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- partial:../../partials/_footer.html -->
    <div class="modal fade" id="editSocialsModal" tabindex="-1" role="dialog" aria-labelledby="editsocialsModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("admin.socials")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="social-form" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="form-group">
                        <label for="icon">{{__('admin.icon')}}</label>
                        <select class="w-100" data-width="100%" data-select2-id="1" tabindex="-1" aria-hidden="true" name="icon">
                            @if($icons->isNotEmpty())
                                @foreach($icons as $key => $value)
                                    <option value="{{$key}}">
                                        {{$value}}
                                    </option>
                                @endforeach
                            @endif
                        </select>

                        @error('icon')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alias">{{__('admin.social')}}</label>
                            <input type="text" class="form-control  @error('alias') is-invalid @enderror" id="alias-edit" name='alias' autocomplete="off" placeholder="{{__('admin.alias')}}" >
                            @error('alias')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("admin.save")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script>
        $(".edit-social").on("click",function (e) {
            e.preventDefault();
            let id = $(this).attr("data-id");
            let alias = $(this).attr("data-alias");
            let url = "<?php echo route("socials.index"); ?>" +"/"+ id;
            $('#social-form').attr('action',url);
            $('#alias-edit').attr('value',alias);
            jQuery.noConflict();
            $("#editSocialsModal").modal("show");




        })


    </script>
@endpush





