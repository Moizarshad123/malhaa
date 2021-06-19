<div class="form-group {{ $errors->has('coupon_code') ? 'has-error' : ''}}">
    <label for="coupon_code" class="col-md-4 control-label">{{ 'Coupon Code' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="coupon_code" type="text" id="coupon_code" value="{{ $coupon->coupon_code?? ''}}" required>
        {!! $errors->first('coupon_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('coupon_start_date_time') ? 'has-error' : ''}}">
    <label for="coupon_start_date_time" class="col-md-4 control-label">{{ 'Coupon Start Date Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="coupon_start_date_time" type="datetime-local" id="coupon_start_date_time" value="{{ $date?? ''}}" required>
        {!! $errors->first('coupon_start_date_time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('coupon_end_date_time') ? 'has-error' : ''}}">
    <label for="coupon_end_date_time" class="col-md-4 control-label">{{ 'Coupon End Date Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="coupon_end_date_time" type="datetime-local" id="coupon_end_date_time" value="{{ $coupon->coupon_end_date_time?? ''}}" required>
        {!! $errors->first('coupon_end_date_time', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('coupon_type') ? 'has-error' : ''}}">
    <label for="coupon_type" class="col-md-4 control-label">{{ 'Coupon Type' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="coupon_type" id="coupon_type">
            <option value="">Select Coupon Type</option>
            <option value="percent"
                @if ($coupon->coupon_type??'' == "percent")
                    selected="selected"
                @endif
            >Percent</option>
            <option value="value">Value</option>
        </select>
        {{-- <input class="form-control" name="coupon_type" type="text" id="coupon_type" value="{{ $coupon->coupon_type?? ''}}" required> --}}
        {!! $errors->first('coupon_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ $coupon->amount?? ''}}" required>
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText?? 'Create' }}">
    </div>
</div>
