<x-app-layout>
    <section class="ecommerce-pages section-py-space section-pb-space mt-5">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-9">
                    <x-card>
                        @slot('header')
                            <div class="img-wrraper">
                                <img class="img-fluid" src="{{asset('/storage/'.$service['service_landing_image'])}}"
                                     alt="">
                            </div>
                            <h2 class="m-3 text-center"><?= $service['service_landing_title']?></h2>
                            <span><i class="bi bi-calendar3"></i>
                                <time class="entry-date published"
                                      datetime="{{$service['created_at']}}">{{formatDateMonthIndo($service['created_at'])}}</time>
                            </span>
                        @endslot
                        <?= $service['service_landing_body']?>
                    </x-card>
                </div>
                <div class="col-md-3">
                    <h5 class="f-w-700 text-center mb-3"
                        style="text-decoration: underline; text-decoration-color: #24695C; text-decoration-thickness: 5px;">
                        TERBARU</h5>
                    <ul class="list-group list-group-flush" style="width: 100%">
                        @foreach($services as $i => $datum)
                            <li class="list-group-item" style="height: 100px">
                                <a href="">
                                    <img style="width:100px;height:60px"
                                         src="{{asset('/storage/'. $datum['service_landing_image'])}}"
                                         alt="">
                                    <span style="font-size: 13pt"><?= $datum['service_landing_title']?></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @include('landing-page.sections.section-5')
    <x-landing-page.footer></x-landing-page.footer>

    @include('js.global')
    @slot('script')
        <script>

        </script>
    @endslot
</x-app-layout>
