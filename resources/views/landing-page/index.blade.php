<x-app-layout>
    <section class="landing-home section-pb-space" id="home">
        <img class="img-fluid bg-img-cover"
             src="{{asset('assets/images/landing/landing-home/home-bg2.jpg')}}"
             alt="">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="landing-home-contain">
                        <div>
                            <div class="landing-logo">
                                <img class="img-fluid" src="{{asset('assets/images/landing/landing-home/logo.png')}}"
                                     alt="">
                            </div>
                            <h6>Selamat Datang di situs</h6>
                            <h2><span>Balai Laboratorium Kesehatan dan Kesalamatan Kerja</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est maxime nam ratione vel!
                                Adipisci, aliquam dolore eligendi eum in inventore labore, magnam maiores molestias,
                                nobis non perferendis quidem quod tempora.</p><a class="btn-landing btn-lg"
                                                                                 href="index.html" target="_blank">view
                                demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <li class="position-block">
            <div class="circle1 opicity3"></div>
            <div class="star"><i class="fa fa-asterisk"></i></div>
            <div class="star star1"><i class="fa fa-asterisk"></i></div>
            <div class="star star2 opicity3"><i class="fa fa-asterisk"></i></div>
            <div class="star star3"><i class="fa fa-times"></i></div>
            <div class="star star4 opicity3"><i class="fa fa-times"></i></div>
            <div class="star star5 opicity3"><i class="fa fa-times"></i></div>
            <ul class="animat-block">
                <li>
                    <img class="img-fluid img-parten top-parten"
                         src="{{asset('assets/images/landing/landing-home/home-position/img-parten.png')}}" alt="">
                    <div>
                        <img class="img-fluid img1 v-align-t m-t-30"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-1.jpg')}}" alt="">
                        <img class="img-fluid img2 v-align-t"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-2.jpg')}}" alt="">
                        <img class="img-fluid img3 v-align-b"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-3.jpg')}}" alt="">
                        <img class="img-fluid img4 v-align-b"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-4.jpg')}}" alt="">
                    </div>
                </li>
                <li>
                    <div>
                        <img class="img-fluid img5"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-5.png')}}" alt="">
                        <img class="img-fluid img6 v-align-c"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-6.jpg')}}" alt="">
                    </div>
                </li>
                <li>
                    <img class="img-fluid img-parten bottom-parten"
                         src="{{asset('assets/images/landing/landing-home/home-position/img-parten.png')}}" alt="">
                    <div>
                        <img class="img-fluid img7 v-align-t"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-7.jpg')}}" alt="">
                        <img class="img-fluid img8 v-align-t"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-8.jpg')}}" alt="">
                        <img class="img-fluid img9"
                             src="{{asset('assets/images/landing/landing-home/home-position/img-9.jpg')}}"
                             alt="">
                    </div>
                </li>
            </ul>
    </section>
    @include('landing-page.sections.section-2')
    <section class="core-feature section-py-space  bg-white" id="layanan">
        <x-landing-page.layanan-kami/>
    </section>

    @include('landing-page.sections.section-4')
    @include('landing-page.sections.section-5')
    <x-landing-page.footer></x-landing-page.footer>

    @include('js.global')
    @slot('script')
        <script>

        </script>
    @endslot
</x-app-layout>
