<div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="col-md-4 control-label">{{ 'Product' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_name" type="text" id="product_name" value="{{ $stockmanagement->product_name?? ''}}" >
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label for="stock" class="col-md-4 control-label">{{ 'Product Stock' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="stock" type="text" id="stock" value="{{ $stockmanagement->stock?? ''}}" >
        {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText?? 'Create' }}">
    </div>
</div>
