@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item "><a href="{{route('admin.product.index')}}">Products</a></li>
<li class="breadcrumb-item active" aria-current="page">Add/Edit Products</li>
@endsection
@section('content')
<h2 class="modal-title">Add/Edit Products</h2>
<form  action="{{route('admin.product.store')}}" method="post" accept-charset="utf-8">
	<div class="row">
		@csrf
		<div class="col-lg-9">
			<div class="form-group row">
				<div class="col-lg-12">
					<label class="form-control-label">Title: </label>
					<input type="text" id="txturl" name="title" class="form-control ">
					<p class="small">{{config('app.url')}}<span id="url"></span>
					<input type="hidden" name="slug" id="slug" value="">
				</p>
			</div>
		</div>
		<div class="form-group row">
			
			<div class="col-lg-12">
				<label class="form-control-label">Description: </label>
				<textarea name="description" id="editor" class="form-control "></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-6 col-lg-3">
				<label class="form-control-label">Price: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="text" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1">
				</div>
			</div>
			<div class="col-6  col-lg-3">
				<label class="form-control-label">Discount: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="discount">
							<input type="checkbox" name="discount" value="0" />
						</span>
					</div>
					<input type="text" class="form-control" name="discount_price" placeholder="0.00" aria-label="discount_price" aria-describedby="discount" disabled />
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<label class="form-control-label">Featured: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="featured"><input type="checkbox" name="discount" value="0" /></span>
					</div>
					<input type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured" disabled />
				</div>
			</div>
			<div class="col-6  col-lg-3">
				<label class="form-control-label">On Sale: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="onsale"><input type="checkbox" name="discount" value="0" /></span>
					</div>
					<input type="text" class="form-control" name="onsale" placeholder="0.00" aria-label="onsale" aria-describedby="onsale" />
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="card col-sm-12 p-0">
				<div class="card-header align-items-center">
					<h5 class="card-title float-left">Extra Options</h5>
					<div class="float-right" >
						<button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
						<button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
					</div>
					
				</div>
				<div class="card-body" id="extras">
					<div class="row align-items-center options">
						<div class="col-sm-4">
							<label class="form-control-label">Option <span class="count">1</span></label>
							<input type="text" name="extra['option'][]" class="form-control" value="" placeholder="size">
						</div>
						<div class="col-sm-8">
							<label class="form-control-label">Values</label>
							<input type="text" name="extra['values'][]" class="form-control" placeholder="options1 | option2 | option3" />
							<label class="form-control-label">Additional Prices</label>
							<input type="text" name="extra['prices'][]" class="form-control" placeholder="price1 | price2 | price3" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<ul class="list-group row">
			<li class="list-group-item active"><h5>Status</h5></li>
			<li class="list-group-item">
				<div class="form-group row">
					<select class="form-control" id="status">
						<option value="1">Pending</option>
						<option value="2">Publish</option>
					</select>
				</div>
				<div class="form-group row">
					<div class="col-lg-12">
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Add Product" />
					</div>
					
				</div>
			</li>
			<li class="list-group-item active"><h5>Feaured Image</h5></li>
			<li class="list-group-item">
				<div class="input-group mb-3">
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
						<label class="custom-file-label" for="thumbnail">Choose file</label>
					</div>
				</div>
				<div class="img-thumbnail">
					<img src="{{asset('images/no-thumbnail.jpeg')}}" id="imgthumbnail" class="img-fluid" alt="">
				</div>
			</li>
			<li class="list-group-item active"><h5>Select Categories</h5></li>
			<li class="list-group-item ">
				<select name="category_id" id="select2" class="form-control" multiple>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
					<option value="4">Four</option>
					
				</select>
			</li>
		</ul>
	</div>
</div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
	$(function(){
			ClassicEditor.create( document.querySelector( '#editor' ), {
		toolbar: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','undo', 'redo' ],
	})
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );
		$('#txturl').on('keyup', function(){
			const pretty_url = slugify($(this).val());
			$('#url').html(slugify(pretty_url));
			$('#slug').val(pretty_url);
		})
		$('#select2').select2({
			placeholder: "Select multiple Categories",
		allowClear: true
		});
		
		$('#status').select2({
			placeholder: "Select a status",
		allowClear: true,
		minimumResultsForSearch: Infinity
		});
$('#thumbnail').on('change', function() {
var file = $(this).get(0).files;
var reader = new FileReader();
reader.readAsDataURL(file[0]);
reader.addEventListener("load", function(e) {
var image = e.target.result;
$("#imgthumbnail").attr('src', image);
});
});
$('#btn-add').on('click', function(e){
	
		var count = $('.options').length+1;
		$('#extras').append('<div class="row align-items-center options">\
						<div class="col-sm-4">\
									<label class="form-control-label">Option <span>'+count+'</span></label>\
									<input type="text" name="extra[\'option\'][]" class="form-control" value="" placeholder="size">\
						</div>\
						<div class="col-sm-8">\
									<label class="form-control-label">Values</label>\
									<input type="text" name="extra[\'values\'][]" class="form-control" placeholder="options1 | option2 | option3" />\
									<label class="form-control-label">Additional Prices</label>\
									<input type="text" name="extra[\'prices\'][]" class="form-control" placeholder="price1 | price2 | price3" />\
						</div>\
					</div>');
})
$('#btn-remove').on('click', function(e){
	
		if($('.options').length > 1){
			$('.options:last').remove();
		}
})
   $("input[name=onsale]").flatpickr({
   	altInput: true,
    altFormat: "F j, Y",
    dateFormat: "d-m-Y",
    minDate: 'today'
   });
$('#discount input[type=checkbox]').on('click', function(){
	
	if($(this).is(":checked"))
		$('input[name=discount_price]').removeAttr('disabled');
	else
		$('input[name=discount_price]').prop('disabled','disabled');
})
})
</script>
@endsection