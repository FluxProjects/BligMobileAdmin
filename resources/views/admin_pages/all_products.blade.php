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
    <li class="d-inline-block px-2"><b>All</b></li>
</ul>
<section class="section_body">
  <table class="table" id="allProducts">
  	<thead class="bg-dark">
  		<tr>
  			<th class="text-white">Product</th>
  			<th class="text-white">Category Name</th>
  			<th class="text-white">Price Approx</th>
  			<th class="text-white">Delivary Time</th>
  			<th class="text-white">Min Pieces</th>
  			<th class="text-white">Created At</th>
  			<th class="text-white">Action</th>
  		</tr>
  	</thead>
  	<tbody></tbody>
  </table>
</section>
@endsection
@section('jquery')
<script>
	
	$('#allProducts').dataTable( {
	  "ajax": {
	    "url": "{{ url('admin/products/all') }}",
	    "datatype": "html",
	    "type": "get",
	  }
	} );
</script>
@endsection