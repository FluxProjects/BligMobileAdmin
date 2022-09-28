@extends('admin_pages.layout.index')
@section('admin_body')
<ul class="bg-light my-3 p-3 bg-muted breadcrumbs">
    <li class="d-inline-block px-2">
        <b>Home <span><i class="blue pl-3 fas fa-angle-double-right"></i></span></b>    
    </li>
    <li class="d-inline-block px-2">
        <b>Dashboard <span><i class="green pl-3 fas  fa-angle-double-right"></i></span></b>
    </li>
</ul>
<section class="section_body p-4">
	<div class="row">
		<div class="col-md-4 col-sm-6">
			<div class="_card">
				<div class="_overlay"></div>
				<h3 class="text-muted"><b>Category:</b>{{$no_categorie}}</h3>
				<h5 class="text-muted"><b>Sub Category:</b>{{$no_sub_categorie}}</h5>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="_card">
				<div class="_overlay"></div>
				<h3 class="text-muted"><b>Products:</b>{{$no_product}}</h3>
				{{-- <h5 class="text-muted"><b>Category:</b>7</h5> --}}
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="_card">
				<div class="_overlay"></div>
				<h3 class="text-muted"><b>Visitors:</b>5</h3>
			</div>
		</div>
	</div>
	<div class="row p-0 mt-5">
		<div class="col-sm-12">
			<h3 class="text-muted">Enquires:</h3>
			<div class="_queries  _border rounded p-4">
				<table class="table table-striped">
					<thead class="bg-green">
						<tr>
							<th class="text-center text-white"><i class="fas fa-hashtag"></i> Phone No</th>
							<th class="text-center text-white"><i class="fas fa-comment-dots"></i> Message</th>
							<th class="text-center text-white"><i class="fas fa-chart-bar"></i>Status</th>
							<th class="text-center text-white"><i class="fa fa-cogs"></i> Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $orderlog['data'] as $key => $o )
						<tr>
							<td class="text-center text-muted">{{ $o['phone'] }}</td>
							<td class="text-center text-muted">{{ $o['msg'] }}</td>
							<td class="text-center text-muted">
								<span class="badge" style="{{ $o['is_delivered']==1 && $o['is_cancel']==0 ? 'background-color: #28a745!important' : ( $o['is_delivered']==0 && $o['is_cancel']==0 ? 'background-color: #ffc107!important' : '' ) 	 }}">
								{{ $o['is_delivered']==1 && $o['is_cancel']==0 ? 'Delivered' : ( $o['is_delivered']==0 && $o['is_cancel']==0 ? 'In Process' : 'Cancel' ) 	 }}
								</span>
							</td>
							<td class="text-center text-muted">{{ date('d-m-Y h:i',strtotime($o['date'])) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</section>
@endsection