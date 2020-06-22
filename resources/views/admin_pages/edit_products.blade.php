@extends('admin_pages.layout.index')
@section('admin_body')
<style>


</style>
	@if(session('msg'))
		<script>
			salert('success','Save Successfully', 3500);
		</script>
	@endif
<ul class="bg-light my-3 p-3 bg-muted breadcrumbs">
    <li class="d-inline-block px-2">
        <b>Home <span><i class="blue pl-3 fas fa-angle-double-right"></i></span></b>    
    </li>
    <li class="d-inline-block px-2">
        <b>Product<span><i class="green pl-3 fas  fa-angle-double-right"></i></span></b>
    </li>
    <li class="d-inline-block px-2"><b>Edit</b></li>
</ul>
<section class="section_body">
  <form method="post" enctype="multipart/form-data" action="{{ url('product/update') }}/{{ $id }}" >
  	{{ csrf_field() }}
	<div class="border rounded bg-light px-4 pb-5">
		<h3 class="font-weight-bold">Add Products:</h3>
		<div class="row">
			<div class="col-sm-3 position-relative">
				<i class="fab fa-product-hunt c_icon blue"></i>
				<input type="text" class="form-control border-blue" placeholder="Product Name" name="P_name" required value="{{ $product->product_name }}">
			</div>
			<div class="col-sm-3 position-relative">
				<i class="fas pr-3 fa-th c_icon green"></i>
				<select class="form-control border-green" required placeholder="Product Name" name="P_cat">
					<option disabled selected>Select Category</option>
					@foreach( $cat as $key => $c )
						<option {{ $product->category_id ==$c->id ? "selected" : "" }} value="{{ $c->id }}" >{{ $c->category_name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-3 position-relative">
				<i class="fas fa-truck-loading c_icon orange"></i>
				<input type="number" class="form-control border-orange" placeholder="Delivery Time" name="delivery_time" required value="{{ $product->delivary_time }}">
			</div>
			<div class="col-sm-3 position-relative">
				<i class="fas fa-dollar-sign c_icon pink"></i>
				<input type="text" class="form-control border-purple" placeholder="Price Approx" name="P_aprox" required value="{{ $product->price_approx }}">
			</div>
			<div class="col-sm-3 mt-4 position-relative">
				<i class="fab fa-stack-overflow c_icon orange"></i>
				<input type="number" class="form-control border-orange" placeholder="Min Prices" name="mun_p" required value="{{ $product->min_pieces }}">
			</div>
		</div>
		<h4 class="font-weight-bold mt-5">Details:</h4>
		<div class="details">
			<div class="row">
				<div class="col-sm-3 position-relative">
					<i class="fab fa-product-hunt c_icon green"></i>
					<input type="text" class="form-control border-green lable-0 " placeholder="Label" name="lable[]" required>
				</div>
				<div class="col-sm-3 position-relative">
					<i class="fab fa-product-hunt c_icon pink"></i>
					<input type="text" class="form-control border-purple value-0 " placeholder="Value" name="value[]" required>
				</div>
				<i onclick="_append()" class="_appendBtn fas fa-plus blue"></i>
			</div>
		</div>
		<h4 class="font-weight-bold mt-5">Discreption:</h4>
		<div class="discreption">
			<div class="row">
				<div class="col-sm-6 position-relative">
					<i class="fab fa-product-hunt c_icon green"></i>
					<textarea class="form-control border-green" name="discription" required>{{ $product->descreption }}</textarea>
				</div>
			</div>
		</div>
		<h4 class="font-weight-bold mt-5">Images:</h4>
		<section class="w-75" style="margin:0 auto">
			<div class="row _image_wraper py-3">
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview1">
					  <label class="bg-blue" for="image-upload1" id="image-label1">Choose File</label>
					  <input type="file" name="image[]" id="image-upload1"/>
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload1",
					    preview_box: "#image-preview1",
					    label_field: "#image-label1"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview2">
					  <label class="bg-green" for="image-upload2" id="image-label2">Choose File</label>
					  <input type="file" name="image[]" id="image-upload2" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload2",
					    preview_box: "#image-preview2",
					    label_field: "#image-label2"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview3">
					  <label class="bg-orange" for="image-upload3" id="image-label3">Choose File</label>
					  <input type="file" name="image[]" id="image-upload3" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload3",
					    preview_box: "#image-preview3",
					    label_field: "#image-label3"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview4">
					  <label class="bg-pink" for="image-upload4" id="image-label4">Choose File</label>
					  <input type="file" name="image[]" id="image-upload4" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload4",
					    preview_box: "#image-preview4",
					    label_field: "#image-label4"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview5">
					  <label class="bg-orange" for="image-upload5" id="image-label5">Choose File</label>
					  <input type="file" name="image[]" id="image-upload5" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload5",
					    preview_box: "#image-preview5",
					    label_field: "#image-label5"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview6">
					  <label class="bg-pink" for="image-upload6" id="image-label6">Choose File</label>
					  <input type="file" name="image[]" id="image-upload6" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload6",
					    preview_box: "#image-preview6",
					    label_field: "#image-label6"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview7">
					  <label class="bg-blue" for="image-upload7" id="image-label7">Choose File</label>
					  <input type="file" name="image[]" id="image-upload7" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload7",
					    preview_box: "#image-preview7",
					    label_field: "#image-label7"
					  });
					});
					</script>
				</div>
				<div class="col-sm-3 mt-4 position-relative">
					<span class="_close red"><i class="fa fa-times"></i></span>
					<div class="_image-preview" id="image-preview8">
					  <label class="bg-green" for="image-upload8" id="image-label8">Choose File</label>
					  <input type="file" name="image[]" id="image-upload8" />
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
					  $.uploadPreview({
					    input_field: "#image-upload8",
					    preview_box: "#image-preview8",
					    label_field: "#image-label8"
					  });
					});
					</script>
				</div>
			</div>
		</section>
		<div class="py-5">
			<button class="bg-blue btn col-sm-3 white" type="submit" >Submut</button>
		</div>
	</div>
	</form>
</section>
@endsection
@section('jquery')
	<script>
		var details_arry=<?php print_r(json_encode($product->product_datail,true)) ?>;
		var details='<?php print_r(count($product->product_datail)) ?>';
		for (var i = 1; i < details; i++) {
			$('._appendBtn').trigger('click');
		}
		for (var j = 0; j < details; j++) {
			$('.lable-'+j).val(details_arry[j].lebel);
			$('.value-'+j).val(details_arry[j].lebel);
		}

	</script>
@endsection