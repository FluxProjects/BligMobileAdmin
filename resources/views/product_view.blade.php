@extends('layout.layout')
@section('css')
<link rel="stylesheet"  href="{{ asset('css/lightslider.css') }}"/>
<style>
ul{
list-style: none outside none;
padding-left: 0;
margin: 0;
}

.content-slider li{
background-color: #ed3020;
text-align: center;
color: #FFF;
}
.content-slider h3 {
margin: 0;
padding: 70px 0;
}
.demo{
/*width: 800px;*/
}
img{
/*width: 100%;*/
}
#image-gallery{
height:350px!important;
}
@media only screen and (min-width: 992px) {
.wrapper{
width:90%;
margin:0 auto;
}
}
.lSGallery li a img{
width:100%;
}
.lslide img{
display: flex;
margin: 0 auto;
}
#image-gallery li{
background-color: #00000040;
}
</style>
@endsection
@section('body')
<div class="my-4" style="background-color:#f5f5f5">
    <ul class="container p-3 breadcrumbs">
        <li class="d-inline-block px-2">
            <b>Home <span><i class="blue pl-3 fas fa-angle-double-right"></i></span></b>    
        </li>
        <li class="d-inline-block px-2">
            <b>{{ $products->Categor_->category_name }} <span><i class="green pl-3 fas  fa-angle-double-right"></i></span></b>
        </li>
        <li class="d-inline-block px-2"><b>{{ $products->product_name }}</b></li>
    </ul>
</div>
<div class="px-3 wrapper">
    <div class="row">
        <div class="col-md-8">
            <h3>{{ $products->product_name }}</h3>
            <section class="Product-slider p-4 border">
                <div class="demo">
                    <div class="item">
                        <div class="clearfix" >

                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                @foreach( $products->product_img as $key => $p_img )
                                <li data-thumb="{{ Config::get('app.filepath') }}/{{ $p_img->image }}">
                                    <img src="{{ Config::get('app.filepath') }}/{{ $p_img->image }}" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="px-4 py-2 mt-4 border">
                <h4 class="font-weight-bold">Details</h4>
                <div class="row">
                    @foreach( $products->product_datail as $key => $p_detail )
                    <div class="col-sm-3 col-6">
                        <h5 class="text-muted">{{ $p_detail->lebel }}</h5>
                    </div>
                    <div class="col-sm-3 col-6">
                        <h5 class="text-dark"><?php print_r( $p_detail->value)?></h5>
                    </div>
                    @endforeach
                </div><hr>
                <h4 class="font-weight-bold">Description</h4>
                <div>
                    {{ $products->descreption }}
                </div>
            </section>
        </div>
        <div class="col-md-4">
            <section class="quote_estimate">
                <div class="recap_right " id="right-recap" >
                    <div class="panel panel-recap border">
                        <h3 class="panel-heading"><strong>Quote Estimate</strong></h3>
                        <div class="panel-body">
                            <div class="recap_txt">
                                <div class="row rep rep_shipping">
                                    <div class="col-xs-7 text-left">Delivery</div>
                                    <div class="col-xs-5 text-right number cart_prev_consegna_number bold">{{ $products->delivary_time }} Business Days</div>
                                </div>
                                <div class="row rep">
                                    <div class="col-xs-7 text-left">Price Approx</div>
                                    <div class="col-xs-5 text-right number">
                                        <span class="cart_prev_netto bold">Rs {{ $products->min_pieces }}</span>
                                    </div>
                                </div>
                                <div class="row rep">
                                    <div class="col-xs-7 text-left">
                                        Min Prices <span class="cart_prev_iva_label"></span>
                                    </div>
                                    <div class="col-xs-5 text-right number cart_prev_iva bold">{{ $products->price_approx }}</div>
                                </div>
                                
                            </div>
                            <button type="button" class="btn btn-success btn-block mt-5 font-weight-bold" style="font-size:18px" data-toggle="modal" data-target="#OrderNowModal">
                                Order Now!
                            </button>
                            <div class="modal" id="OrderNowModal">
                              <div class="modal-dialog">
                                <div class="modal-content" style="border-left: 6px solid #6ec044">
                                  <div class="modal-header">
                                      <h4 class="modal-title blue font-weight-bold">Quote Estimate</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form id="order_form">
                                        <div class="row mb-5">
                                            <div class="col-12 mt-4 position-relative">
                                                <i class="fab fa-product-hunt c_icon blue"></i>
                                                <input type="text" class="form-control border-purple" placeholder="Contact No" name="contact_no" required>
                                            </div>
                                            <div class="col-12 mt-4 position-relative">
                                                <i class="fab fa-product-hunt c_icon orange"></i>
                                                <textarea class="form-control border-orange" placeholder="Something write here..." name="discription" required></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <button onclick="OrderNow()" type="button" class="btn bg-blue text-white" data-dismiss="modal"><i class="fa fa-paper-plane"></i> Send</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="location_map">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=lahore&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net"></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script src="{{ asset('js/lightslider.js') }}"></script>
<script>
$(document).ready(function() {
$("#content-slider").lightSlider({
loop:true,
keyPress:true
});
$('#image-gallery').lightSlider({
gallery:true,
item:1,
thumbItem:9,
slideMargin: 0,
speed:500,
auto:true,
loop:true,
onSliderLoad: function() {
$('#image-gallery').removeClass('cS-hidden');
}
});
});
function OrderNow() {
    $.ajax({
        url: '{{ url("order-now") }}',
        type: 'get',
        dataType: 'json',
        data: $('#order_form').serialize(),
    })
    .done(function(resp) {
        if( resp.id ){
            alert('Sended Successfully');
        }else{
            alert('Something Went Wrong, Please try later');
        }
    })
    .fail(function() {
        console.log("error");
    });
    
}
</script>
@endsection