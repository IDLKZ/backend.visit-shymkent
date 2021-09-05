<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("admin.settings")}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route("settings.update",$setting->id)}}" enctype="multipart/form-data">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    @if(!in_array($setting->id,[20]))
                    <div class="form-group">
                        <label>{{__('admin.status')}}</label>
                        <select class="form-select" name="status">
                            <option value="3" @if(count($setting->status) == 3)selected @endif>{{__("admin.all")}}</option>
                            <option value="1" @if(in_array(1,$setting->status) && count($setting->status) == 1)selected @endif>{{__("admin.yes_status")}}</option>
                            <option value="0" @if(in_array(0,$setting->status) && count($setting->status) == 1)selected @endif>{{__("admin.not_status")}}</option>
                            <option value="-1" @if(in_array(-1,$setting->status) && count($setting->status) == 1) selected @endif>{{__("admin.mod_status")}}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($setting->id == 1)
                        <div class="form-group">
                            <label>{{__('admin.verified')}}</label>
                            <select class="form-select" name="verified">
                                <option value="3"
                                @if(count($setting->verified) == 3)
                                    selected
                                    @endif
                                >{{__("admin.all")}}
                                </option>
                                <option
                                    @if(in_array(1,$setting->verified) && count($setting->verified) == 1)
                                    selected
                                    @endif
                                    value="1">{{__("admin.yes_status")}}</option>
                                <option value="0"
                                        @if(in_array(0,$setting->verified) && count($setting->verified) == 1)
                                        selected
                                    @endif
                                >{{__("admin.not_verified")}}</option>
                            </select>
                            @error('verified')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="pagination">{{__('admin.pagination')}}</label>
                        <input type="number" min="1" max="100" class="form-control  @error('pagination') is-invalid @enderror" id="pagination" name='pagination' autocomplete="off" placeholder="{{__('admin.pagination')}}" value="{{$setting->pagination}}">
                        @error('pagination')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{__('admin.order')}}</label>
                        <select class="form-select" name="order">
                            <option value="ASC" @if($setting->order == "ASC") selected @endif>{{__("admin.ASC")}}</option>
                            <option value="DESC" @if($setting->order == "DESC") selected @endif>{{__("admin.DESC")}}</option>
                        </select>
                        @error('order')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("admin.cancel")}}</button>
                    <button type="submit" class="btn btn-primary">{{__("admin.change")}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

