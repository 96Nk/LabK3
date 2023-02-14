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
                                <img class="img-fluid" src="{{asset('assets/images/logo-k3.png')}}"
                                     alt="" width="100">
                            </div>
                            <h6>Selamat Datang di situs</h6>
                            <h2><span>Laboratorium Kesehatan dan Kesalamatan Kerja</span></h2>
                            <p> Berdasarkan Peraturan Gubernur No. 0143 Tahun 2017 Laboratorium Kesehatan dan
                                Keselamatan Kerja Bertugas Melaksanakan Kegiatan Teknis Operasional Dinas Tenaga Kerja
                                dan Transmigrasi di Bidang Pelayanan Jasa Pengujian, Fasilitasi, Supervisi, Penyuluhan
                                dan Bimbingan Teknis Higiene Perusahaan, Ergonomi, Kesehatan dan Keselamatan Kerja
                            </p>
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
                        <img class="img-fluid img-70 v-align-t m-t-30"
                             src="{{asset('assets/images/front/1.jpg')}}" alt="">
                        <img class="img-fluid img-70 v-align-t"
                             src="{{asset('assets/images/front/2.jpg')}}" alt="">
                        <img class="img-fluid img-70 v-align-b"
                             src="{{asset('assets/images/front/3.jpg')}}" alt="">
                        <img class="img-fluid img-70 v-align-b"
                             src="{{asset('assets/images/front/4.jpeg')}}" alt="">
                    </div>
                </li>
                <li>
                    <div>
                        <img class="img-fluid img-50"
                             src="{{asset('assets/images/front/5.jpeg')}}" alt="">
                        <img class="img-fluid img-50 v-align-c"
                             src="{{asset('assets/images/front/6.jpg')}}" alt="">
                        <img class="img-fluid img-50 v-align-c"
                             src="{{asset('assets/images/front/7.jpg')}}" alt="">
                    </div>
                </li>
                <li>
                    <img class="img-fluid img-parten bottom-parten"
                         src="{{asset('assets/images/landing/landing-home/home-position/img-parten.png')}}" alt="">
                    <div>
                        <img class="img-fluid img-50 v-align-t"
                             src="{{asset('assets/images/front/8.jpg')}}" alt="">
                        <img class="img-fluid img-50 v-align-t"
                             src="{{asset('assets/images/front/9.jpg')}}" alt="">
                        <img class="img-fluid img-50 v-align-t"
                             src="{{asset('assets/images/front/10.jpg')}}" alt="">
                        <img class="img-fluid img-50 v-align-t"
                             src="{{asset('assets/images/front/11.jpg')}}" alt="">
                        <img class="img-fluid img-50 v-align-t"
                             src="{{asset('assets/images/front/12.jpg')}}" alt="">
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
