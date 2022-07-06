<div class="title">
    <h2>Layanan Kami</h2>
</div>
<div class="custom-container">
    <div class="row">
        <?php foreach ($services as $service) { ?>
        <div class="col-xl-4 col-sm-4 box-col-4">
            <div class="card features-faq product-box">
                <div class="faq-image product-img">
                    <img class="img-fluid"
                         src="{{asset('storage/'.$service['service_landing_image'])}}"
                         alt="">
                </div>
                <div class="card-body">
                    <a href="{{url('layanan-kami/'. $service['service_landing_id'])}}">
                        <h6>{{$service['service_landing_title']}}</h6>
                    </a>
{{--                    <p>Pelatihan yang kami adakan di pandu oleh ahli - ahli K3 yang kompeten dan bersertifikasi--}}
{{--                        nasional.</p>--}}
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
