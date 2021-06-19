<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $category->name ?? ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
    <label for="banner" class="col-md-4 control-label">{{ 'Banner' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="banner" type="file" id="banner" value="{{ $category->banner ?? ''}}" required>
        @if($action != 'add')

        
        <br><img src="{{asset('website/'. $category->banner ?? '')}}" style="width: 70px;height: 70px">
        @endif
        {!! $errors->first('banner', '<p class="help-block">:message</p>') !!}
    </div>
    
</div><div class="form-group {{ $errors->has('url_name') ? 'has-error' : ''}}">
    <label for="url_name" class="col-md-4 control-label">{{ 'Url Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="url_name" type="text" id="url_name" value="{{ $category->url_name ?? ''}}" required>
        {!! $errors->first('url_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
         
          </select>
        {{-- <input class="form-control" name="status" type="text" id="status" value="{{ $category->status ?? ''}}" required> --}}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText ?? 'Create' }}">
    </div>
</div>
