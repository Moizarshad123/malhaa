<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title" type="text" id="title" value="{{ $banner->title ?? ''}}" required>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
    <label for="banner" class="col-md-4 control-label">{{ 'Banner' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="banner" type="file" id="banner" value="{{ $banner->banner ??''}}" required>
        @if ($action != 'add')
        <br><img src="{{asset('website/'. $banner->banner ?? '')}}" style="width: 70px;height: 70px"> 
        @endif
        {!! $errors->first('banner', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText ?? 'Create' }}">
    </div>
</div>
