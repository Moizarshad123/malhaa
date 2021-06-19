@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<style>
    .aiz-switch input:empty {
        height: 0;
        width: 0;
        overflow: hidden;
        position: absolute;
        opacity: 0;
        }
        .aiz-switch input:empty ~ span {
        display: inline-block;
        position: relative;
        text-indent: 0;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        line-height: 24px;
        height: 21px;
        width: 40px;
        border-radius: 12px;
        }
        .aiz-switch input:empty ~ span:after,
        .aiz-switch input:empty ~ span:before {
        position: absolute;
        display: block;
        top: 0;
        bottom: 0;
        left: 0;
        content: " ";
        -webkit-transition: all 0.1s ease-in;
        transition: all 0.1s ease-in;
        width: 40px;
        border-radius: 12px;
        }
        .aiz-switch input:empty ~ span:before {
        background-color: #e8ebf1;
        }
        .aiz-switch input:empty ~ span:after {
        height: 17px;
        width: 17px;
        line-height: 20px;
        top: 2px;
        bottom: 2px;
        margin-left: 2px;
        font-size: 0.8em;
        text-align: center;
        vertical-align: middle;
        color: #f8f9fb;
        background-color: rgb(71, 102, 243);
        }
        .aiz-switch input:checked ~ span:after {
        background-color: var(--primary);
        margin-left: 20px;
        }
        .aiz-switch-secondary input:checked ~ span:after {
        background-color: var(--secondary);
        }
        .aiz-switch-success input:checked ~ span:after {
        background-color: var(--success);
        }
        .aiz-switch-info input:checked ~ span:after {
        background-color: var(--info);
        }
        .aiz-switch-warning input:checked ~ span:after {
        background-color: var(--warning);
        }
        .aiz-switch-danger input:checked ~ span:after {
        background-color: var(--danger);
        }
        .aiz-switch-light input:checked ~ span:after {
        background-color: var(--primary);
        }
        .aiz-switch-dark input:checked ~ span:after {
        background-color: var(--dark);
        }
        .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        }
        #plus{
            float: right;
        }
        .active, .collapsible:hover {
        background-color: #555;
        }

        .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        }
        

</style>
    
@endpush
   
    <button style="font-weight: bold" type="button" class="collapsible">Open General 
        <i class="fa fa-plus" id="plus" aria-hidden="true"></i>
    </button>
<div class="content" >
    <br>
    <div class="form-group {{ $errors->has('categories') ? 'has-error' : ''}}">
        <label for="categories" class="col-md-4 control-label">{{ 'Categories' }}</label>
    
        <div class="col-md-6">
            <select class="form-control" name="categories" id="categories" required >
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id??'' }}"
                        @if($category->id??'' == old('categories',$category->id))
                            selected="selected"
                        @endif                        
                        >{{ $category->name??''}}</option>
                @endforeach

            </select>
            {{-- <input class="form-control" name="categories" type="text" id="categories" value="{{ $product->categories?? ''}}"  > --}}
            {!! $errors->first('categories', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
        <label for="brand" class="col-md-4 control-label">{{ 'Brand' }}</label>
        <div class="col-md-6">
            {{-- <input class="form-control" name="brand" type="text" id="brand" value="{{ $product->brand?? ''}}" > --}}
            <select class="form-control" data-live-search="true" data-selected-text-format="count"   name="brand" id="brand" >
                    <option value="">Select Brand</option>
                @foreach (\App\Brand::orderBy('name', 'asc')->get() as $key => $brand)
                    <option  value="{{ $brand->name??'' }}"
                        @if($brand->name??'' == old('brand',$brand->name))
                            selected="selected"
                        @endif
                        >  {{ ' '.$brand->name??'' }}</option>
                @endforeach
            </select>
            {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
        <label for="product_name" class="col-md-4 control-label">{{ 'Product Name' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="product_name" type="text" id="product_name" value="{{ $product->product_name?? ''}}" required >
            {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('regular_price') ? 'has-error' : ''}}">
        <label for="regular_price" class="col-md-4 control-label">{{ 'Regular Price' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="regular_price" type="number" id="regular_price" value="{{ $product->regular_price?? ''}}" required >
            {!! $errors->first('regular_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
        <label for="sale_price" class="col-md-4 control-label">{{ 'Sale Price' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="sale_price" type="number" id="sale_price" value="{{ $product->sale_price?? ''}}"  >
            {!! $errors->first('sale_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div id="standendsalprice" style="display: none">
    <div class="form-group {{ $errors->has('sale_price_start_date_time') ? 'has-error' : ''}}">
        <label for="sale_price_start_date_time" class="col-md-4 control-label">{{ 'Sale Price Start Date Time' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="sale_price_start_date_time" type="datetime-local" id="sale_price_start_date_time" value="{{ $product->sale_price_start_date_time?? ''}}" >
            {!! $errors->first('sale_price_start_date_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale_price_end_date_time') ? 'has-error' : ''}}">
        <label for="sale_price_end_date_time" class="col-md-4 control-label">{{ 'Sale Price End Date Time' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="sale_price_end_date_time" type="datetime-local" id="sale_price_end_date_time" value="{{ $product->sale_price_end_date_time?? ''}}" >
            {!! $errors->first('sale_price_end_date_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    </div>

    <div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
        <label for="short_description" class="col-md-4 control-label">{{ 'Short Description' }}</label>
        <div class="col-md-6">
            <textarea class="form-control" rows="5" name="short_description" type="textarea" id="short_description" >{{ $product->short_description?? ''}}</textarea>
            {{-- <input class="form-control" name="short_description" type="textarea" id="short_description" value="{{ $product->short_description?? ''}}" > --}}
            {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
        <label for="long_description" class="col-md-4 control-label">{{ 'Long Description' }}</label>
        <div class="col-md-6">
            <textarea class="form-control" rows="5" name="long_description" type="textarea" id="long_description" >{{ $product->long_description?? ''}}</textarea>
            {!! $errors->first('long_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<hr>
 <button style="font-weight: bold" type="button" class="collapsible">Open Attributes <i class="fa fa-plus" id="plus" aria-hidden="true"></i></button>

<div class="content">
    <br>
    {{-- <div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
        <label for="color" class="col-md-4 control-label">{{ 'Color' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="color" type="color" id="color" value="{{ $product->color?? ''}}" >
            {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
        </div>
    </div> --}}

    <div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
        <label for="color" class="col-md-4 control-label">{{ 'Color' }}<span class=" "> *</span></label>
        <div class="col-md-6">
            <select class="color-choose color_table" data-live-search="true" data-selected-text-format="count"   name="color[]" id="color" multiple disabled >
                @foreach (\App\ProductColor::orderBy('name', 'asc')->where('active',1)->get() as $key => $color)
                  
                
                
                @if($action == "edit")
                    <option
                        value="{{ $color->color_code??'' }}"
                        <?php if(in_array($color->color_code, json_decode($product->color))) echo 'selected'?>
                    >
                    {{$color->name??''}}
                    </option>
                @else
                     <option  value="{{ $color->color_code??'' }}" > {{ ' '.$color->name??'' }}</option>
                @endif
                  
                @endforeach
            </select>
    
            {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="col-md-0">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input value="1" type="checkbox" name="colors_active" >
                <span></span>
            </label>
        </div>
    </div>
{{-- 
    <div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
        <label for="size" class="col-md-4 control-label">{{ 'Size' }}</label>
        <div class="col-md-6">
            <select class="form-control" name="size" id="size">
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
            </select>
    
    
            {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
        </div>
    </div> --}}
    <div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
        <label for="size" class="col-md-4 control-label">{{ 'Size' }}</label>
        <div class="col-md-6">
            <input class="form-control size-choose" name="size[]" type="text" id="size" value="{{ $product->size?? '' }}"  >
            
            {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('main_image') ? 'has-error' : ''}}">
        <label for="main_image" class="col-md-4 control-label">{{ 'Main Image' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="main_image" type="file" id="main_image" value="{{ $product->main_image?? ''}}" required >
            @if ($action != 'add')
            <br><img src="{{asset('website/'. $product->main_image ?? '')}}" style="width: 70px;height: 70px"> 
            @endif
            {!! $errors->first('main_image', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('multi_image') ? 'has-error' : ''}}" >
        <label for="multi_image" class="col-md-4 control-label">{{ 'Multi Image' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="multi_image[]" type="file" multiple id="multi_image"  required >
            @if ($action != 'add')
            <br>
            @foreach ($multiImages as $item)
            <img src="{{asset('website/products/multi/'.$item ?? '')}}" style="width: 70px;height: 70px">
            @endforeach
            
            @endif
            {!! $errors->first('multi_image', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''}}">
        <label for="tags" class="col-md-4 control-label">{{ 'Tags' }}</label>
        <div class="col-md-6">
            <input class="form-control"  name="tags[]" type="text" id="tags" value="{{ $product->tags?? ''}}" required>
            {!! $errors->first('tags', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<hr>

    <button style="font-weight: bold" type="button" class="collapsible">Open Inventory <i class="fa fa-plus" id="plus" aria-hidden="true"></i></button>

<div class="content">
    <div class="form-group {{ $errors->has('manage_stock') ? 'has-error' : ''}}">
        <label for="manage_stock" class="col-md-4 control-label">{{ 'Manage Stock' }}</label>
        <div class="col-md-6">
            {{-- <input class="form-control" name="manage_stock" type="checkbox" id="manage_stock" > --}}
            {!! $errors->first('manage_stock', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input  name="manage_stock" type="checkbox" id="manage_stock" >
                <span></span>
            </label>
        </div>
    </div>

    <div id="stockhideandshow" class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}" style="display:none">
        <label for="stock" class="col-md-4 control-label">{{ 'Stock' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="stock" type="text" id="stock" value="{{ $product->stock?? ''}}"  >
            {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

{{-- <div class="form-group {{ $errors->has('sku_code') ? 'has-error' : ''}}">
    <label for="sku_code" class="col-md-4 control-label">{{ 'Sku Code' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sku_code" type="text" id="sku_code" value="{{ $product->sku_code?? ''}}"  >
        {!! $errors->first('sku_code', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

    <div id="sku_codeshow" class="form-group {{ $errors->has('sku_code') ? 'has-error' : ''}}" style="display:none">
        <label for="sku_code" class="col-md-4 control-label">{{ 'SKU' }}<span class=" "> *</span></label>
        <div class="col-md-6">
            <input class="form-control " name="sku_code" type="text" id="sku_code"  maxlength="10" placeholder="SKU" size="20" style="text-transform:uppercase" value="{{ $product->sku_code??''}}" required/>
            {!! $errors->first('sku_code', '<p class="help-block">:message</p>') !!}
            <span id="sku_code-error"></span>
    </div>
    {{-- <div class="col-md-0">
            <label class="" style="margin-top: 7px;">
                <input type="button" id="getit" class="button" value="Generate"  >
                <span></span>
            </label>
        </div> --}}
    </div>

    <div class="form-group {{ $errors->has('stock_status') ? 'has-error' : ''}}">
        <label for="stock_status" class="col-md-4 control-label">{{ 'Stock Status' }}</label>
        <div class="col-md-6">
                
            <select class="form-control" name="stock_status" id="stock_status" required>
                
                <option value="">Select Stock Status</option>

                {{-- <option value="{{ $product->stock_status }}" selected>{{ $product->stock_status }}</option> --}}
                <option value="In Stock"
                    @if($product->stock_status??'' == "In Stock")
                        selected="selected"
                    @endif
                >In Stock</option>
                <option value="Out Of Stock"
                    @if($product->stock_status??'' == "Out Of Stock")
                    selected="selected"
                    @endif  
                >Out Of Stock</option>
                <option value="On Backorder"
                    @if($product->stock_status??'' == "On Backorder")
                    selected="selected"
                    @endif 
                >On Backorder</option>
    
            </select>
            {{-- <input class="form-control" name="stock_status" type="text" id="stock_status" value="{{ $product->stock_status?? ''}}"  > --}}
            {!! $errors->first('stock_status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
        <label for="stock_status" class="col-md-4 control-label">{{ 'Status' }}</label>
        <div class="col-md-6">
                
            <select class="form-control" name="status" id="status" required>
                <option value="">Select Status</option>
                <option value="Published"
                    @if($product->status??'' == "Published")
                    selected="selected"
                    @endif 
                >Published</option>
                <option value="Draft"
                    @if($product->status??'' == "Draft")
                    selected="selected"
                    @endif 
                >Draft</option>
                <option value="Pending"
                    @if($product->status??'' == "Pending")
                    selected="selected"
                    @endif 
                >Pending</option>
                <option value="Trash"
                    @if($product->status??'' == "Trash")
                    selected="selected"
                    @endif 
                >Trash</option>
    
            </select>
            {{-- <input class="form-control" name="stock_status" type="text" id="stock_status" value="{{ $product->stock_status?? ''}}"  > --}}
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
   

    <div class="form-group {{ $errors->has('related_products') ? 'has-error' : ''}}">
        <label for="related_products" class="col-md-4 control-label">{{ 'Related Products' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="related_products" type="text" id="related_products" value="{{ $product->related_products?? ''}}" >
            {{-- <select class="form-control" data-live-search="true" data-selected-text-format="count"   name="related_products" id="related_products" >
                @foreach (\App\Product::orderBy('id', 'asc')->get() as $key => $product)
                    <option  value="{{ $product->id }}">  {{ ' '.$product->product_name }}</option>
                @endforeach
            </select> --}}
            {!! $errors->first('related_products', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : ''}}">
        <label for="is_featured" class="col-md-4 control-label">{{ 'Is Featured' }}</label>{{--
        <div class="col-md-6">
            <input class="form-control"  name="is_featured" type="text" id="chkSwitch" value="{{ $product->is_featured?? ''}}"  />
            {!! $errors->first('is_featured', '<p class="help-block">:message</p>') !!}
        </div> --}}
        <div class="col-md-6">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input value="1" id="chkSwitch" type="checkbox" name="is_featured" @if ($product->is_featured??'' == 1)checked @endif >
                <span></span>
            </label>
        </div>
    </div>
</div>

    <div class="form-group" style="margin-top: 10px">
        <div class="col-md-12" >
            <input class="btn btn-primary" type="submit" style="float: right;" value="{{ $submitButtonText?? 'Create' }}">
        </div>
    </div>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
<script>
    $(document).ready(function(){
        $(".color-choose").select2({
            width: "100%",
            templateResult: formatState
        });

        
        function formatState (state) {
            if (!state.id) { return state.text; }

            var $state = $('<span><span class="size-15px d-inline-block mr-2 rounded border" style="background:' + state.element.value + ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>' + state.text + '</span></span>');
            return $state;
        };
        $('input[name="colors_active"]').on('change', function() {
            if(!$('input[name="colors_active"]').is(':checked')){
                $('#color').prop('disabled', true);
            }
            else{
                $('#color').prop('disabled', false);
            }

        });
        $('#manage_stock').click(function(){
            if($(this).prop("checked") == true){
                $('#stockhideandshow').css('display','block');
                $('#sku_codeshow').css('display','block');
                
            }
            else if($(this).prop("checked") == false){
                $('#stockhideandshow').css('display','none');
                $('#sku_codeshow').css('display','none');
            }
        });

        $('#sale_price').keyup(function(){
            if($(this).val() != ''){
                $('#standendsalprice').css('display','block');
            }
            else if($(this).prop("checked") == false){
                $('#standendsalprice').css('display','none');
            }
        });
        $('#tags').removeClass('form-control');
            var tags = document.querySelector('#tags');
            tagify = new Tagify(tags);
            tagifyFun(tagify);

            $('#size').removeClass('form-control');
            var tags = document.querySelector('#size');
            tagify = new Tagify(tags);
            tagifyFun(tagify);

        // var input = document.querySelector('#tags');
        // var tagify = new Tagify(input);
        // tagify.addTags();
        // var input = document.querySelector('#size');
        // var tagify = new Tagify(input);
        // tagify.addTags();
    });
         var tags = document.querySelector('#tags');
         var size = document.querySelector('#size');

      
            
          $('#tags').keyup(function(){
            $('#tags').removeClass('form-control');
            var tags = document.querySelector('#tags');
            tagify = new Tagify(tags);
            tagifyFun(tagify)
        });
        $('#size').keyup(function(){
            $('#size').removeClass('form-control');
            var tags = document.querySelector('#size');
            tagify = new Tagify(tags);
            tagifyFun(tagify)
        });


        function tagifyFun(tagify){
            const maxChars = 15; 
            tagify.on('input', function(e){
                console.log(e);
                if( e.detail.value.length > maxChars )
                    trimValue(e);
            })
            tagify.on('add', function(e){
                // remove last added tag if the total length exceeds
                if( tagify.DOM.input.textContent.length > maxChars )
                    tagify.removeTag(); // removes the last added tag
            })
            function trimValue(e){
                // reset the value completely before making changes
                tagify.value.length = 0; 
                // trim the value
                let newValue = tagify.DOM.originalInput.value.slice(0, maxChars - e.detail.length);
                // parse the new mixed value after trimming any excess characters
                tagify.parseMixTags(newValue)
            }
        }
        // var max = '1000000';
        // var $wrap = $('#sku_code');
        // $('#getit').click(function() {
        //     var num = +$wrap.val();
        //     $wrap.val('MALHAA'+Math.ceil(Math.random() * max));
        // });

        // $( document ).ready(function() {
        //     $('#manage_stock').click(function(){
        //     if($(this).prop("checked") == true){
        //         $('#stockhideandshow').css('display','block');
        //         $('#sku_codeshow').css('display','block');
                
        //     }
        //     else if($(this).prop("checked") == false){
        //         $('#stockhideandshow').css('display','none');
        //         $('#sku_codeshow').css('display','none');
        //     }
        // });

        // $('#sale_price').keyup(function(){
        //     if($(this).val() != ''){
        //         $('#standendsalprice').css('display','block');
        //     }
        //     else if($(this).prop("checked") == false){
        //         $('#standendsalprice').css('display','none');
        //     }
        // });

        
        // });

        var coll = document.getElementsByClassName("collapsible");
            var i;
        console.log(coll.length);
            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                var sign = this.childNodes;
                console.log(sign);
                // $(this).parent('col-md-12').siblings('content'); 
                if (content.style.display === "block") {
                content.style.display = "none";
                sign[1].className  = "fa fa-plus";
                } else {
                content.style.display = "block";
                sign[1].className  = "fa fa-minus";
                content.style.marginTop  = "10px";
                }
            });
            }
</script>

@endpush


