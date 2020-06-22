@extends('layout.layout')
@section('body')
<section>
	<div class="container">
		<div class="col-12 my-5">
			<p class="head m-0-auto ">{{ $products->sub_category_name }}</p>
			<p class="head m-0-auto ">{{ $products->category_name }}</p>
		    <div class="d-flex justify-content-center ">
		      <div class="center_b mb-5 mt-3">
		      </div>
		    </div>
		</div>
	<div class="row pt-5 ">
		{{-- @dd($products); --}}
		@foreach( $products->catagory_pro as $key => $p )
			<div class="col-md-4  col-lg-3 col-sm-6 col-12 p-0 product ">
				<a href="{{ url('products/view') }}/{{$p->id}}">
				<div class=" d-flex content_center" style="height:260px;"><img src="{{ Config::get('app.filepath') }}/{{ $p->product_img[0]->image }}" width="100%"></div>
				</a>
				<div class=" p-5 name">{{ $p->product_name }}</div>
			</div>
		@endforeach
		@if( count($products->catagory_pro) <= 0 )
			<b style="margin:0 auto">Sorry Product Did't Found</b>
		@endif
	</div>
   </section>
@endsection