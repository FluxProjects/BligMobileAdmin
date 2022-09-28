@extends('layout.layout')
@section('body')
<section class="row m-0">
	<div class="col-2 p-0 mt-3 bg-dark">
		<div class="_sidebar ">
			<ul class="p-3">
				<li class="profile_li">
					<img class="text-center img-circle" src="{{ asset('img/product_slider/cS-4.jpg') }}" width="100px" height="100px" alt="Profile">
				</li>
				<li><a href="{{ url('dashboard') }}" class="d-block"><i class="fas pr-3 fa-tachometer-alt"></i> Dashboard</a></li>
				<li><a href="{{ url('dashboard') }}" class="d-block"><i class="fas pr-3 fa-exclamation-circle"></i> Enquires</a></li>
				<li onclick="_dropdown('sub_product')"><a class="d-block"><i class="pr-3 fab fa-product-hunt"></i> Products</a></li>
					<ul class="pl-3 dnone bg-gray-light rounded sub_product">
						<li class="border-none"><a href="{{ url('admin/products/all') }}"><i class="fas pr-3 fa-plus-circle"></i> All Products</li></a>
						<li class="border-none"><a href="{{ url('product/add') }}"><i class="fas pr-3 fa-th-large"></i> Add Product</a></li>
					</ul>
				<li><a class="d-block"><i class="fas pr-3 fa-th"></i> Category</a></li>
				{{-- <li onclick="_dropdown('sub_setting')"><a class="d-block"><i class="fa pr-3 fa-cogs"></i> Setting</a></li>
				<ul class="pl-3 dnone bg-gray-light rounded sub_setting">
					<li class="border-none"><i class="fas pr-3 fa-images"></i> Carousel</li>
					<li class="border-none"><i class="fas pr-3 fa-comment-dots"></i> SMS Config</li>
				</ul> --}}

				<li class="border-none">
					<a href="{{ route('logout') }}"
					   onclick="event.preventDefault();
					                 document.getElementById('logout-form').submit();">
					    <i class="pr-3 fas fa-sign-out-alt" style="margin-top:80px"></i>{{ __('Logout') }}
					</a>
				</li>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				    {{ csrf_field() }}
				</form>
				<li class="border-none"><i class="fas pr-3 fa-sync-alt"></i> Version: 1.0</li>
			</ul>
		</div>
	</div>
	<div class="col-10">
		@yield('admin_body')
	</div>
	
</section>
@endsection
@section('jquery')
	
@endsection
<script type="text/javascript">
	function _dropdown(elem) {
		$('.'+elem).slideToggle();
	}
</script>