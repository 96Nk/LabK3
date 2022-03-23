<x-app-layout>
    <section class="landing-home section-pb-space" id="home">
        <img class="img-fluid bg-img-cover" src="{{ asset('assets/images/landing/landing-home/home-bg2.jpg') }}"
             alt="">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="landing-home-contain">
                        <div>
                            <div class="landing-logo"><img class="img-fluid"
                                                           src="{{ asset('assets/images/landing/landing-home/logo.png') }}"
                                                           alt=""></div>
                            <h6>clean design </h6>
                            <h2>viho Bootstrap <span>Admin Template</span></h2>
                            <p>When it comes to dashboard or web apps. one of the first impression you consider is
                                the design. It needs to be high quality enough otherwise you will lose potential
                                users due to bad design.</p><a class="btn-landing btn-lg" href="index.html"
                                                               target="_blank">view demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-block">
            <div class="circle1 opicity3"></div>
            <div class="star"><i class="fa fa-asterisk"></i></div>
            <div class="star star1"><i class="fa fa-asterisk"></i></div>
            <div class="star star2 opicity3"><i class="fa fa-asterisk"></i></div>
            <div class="star star3"><i class="fa fa-times"></i></div>
            <div class="star star4 opicity3"><i class="fa fa-times"></i></div>
            <div class="star star5 opicity3"><i class="fa fa-times"></i></div>
            <ul class="animat-block">
                <li><img class="img-fluid img-parten top-parten"
                         src="{{ asset('assets/images/landing/landing-home/home-position/img-parten.png') }}"
                         alt="">
                    <div><img class="img-fluid img1 v-align-t m-t-30"
                              src="{{ asset('assets/images/landing/landing-home/home-position/img-1.jpg') }}"
                              alt=""><img class="img-fluid img2 v-align-t"
                                          src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-2.jpg"
                                          alt=""><img class="img-fluid img3 v-align-b"
                                                      src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-3.jpg"
                                                      alt=""><img class="img-fluid img4 v-align-b"
                                                                  src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-4.jpg"
                                                                  alt=""></div>
                </li>
                <li>
                    <div><img class="img-fluid img5"
                              src="{{ asset('assets/images/landing/landing-home/home-position/img-5.png') }}"
                              alt=""><img class="img-fluid img6 v-align-c"
                                          src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-6.jpg"
                                          alt=""></div>
                </li>
                <li><img class="img-fluid img-parten bottom-parten"
                         src="{{ asset('assets/images/landing/landing-home/home-position/img-parten.png') }}"
                         alt="">
                    <div><img class="img-fluid img7 v-align-t"
                              src="{{ asset('assets/images/landing/landing-home/home-position/img-7.jpg') }}"
                              alt=""><img class="img-fluid img8 v-align-t"
                                          src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-8.jpg"
                                          alt=""><img class="img-fluid img9"
                                                      src="{{ asset('assets/images/landing/landing') }}-home/home-position/img-9.jpg"
                                                      alt=""></div>
                </li>
            </ul>
        </div>
    </section>
    <!--home section end-->
    <!--demo section start-->
    <section class="demo-section section-py-space" id="demo">
        <div class="title">
            <h2>Creative Layouts</h2>
        </div>
        <div class="custom-container">
            <div class="row demo-block demo-imgs">
                <div class="col-lg-4 col-sm-6">
                    <div class="demo-box">
                        <div class="img-wrraper"><img class="img-fluid"
                                                      src="{{ asset('assets/images/landing/demo/1.jpg') }}" alt="">
                            <div class="overlay">
                                <ul class="demo-link hover-link">
                                    <li><a id="default-demo" href="index.html" target="_blank"><img
                                                src="{{ asset('assets/images/landing/icon/html/html.png') }}"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h3>Default Layout</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="demo-box">
                        <div class="img-wrraper"><img class="img-fluid"
                                                      src="{{ asset('assets/images/landing/demo/2.jpg') }}" alt="">
                            <div class="overlay">
                                <ul class="demo-link">
                                    <li><a id="compact-demo" href="dashboard-02.html" target="_blank"><img
                                                src="{{ asset('assets/images/landing/icon/html/html.png') }}"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h3>Compact Layout</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                    <div class="demo-box">
                        <div class="img-wrraper"><img class="img-fluid"
                                                      src="{{ asset('assets/images/landing/demo/3.jpg') }}" alt="">
                            <div class="overlay">
                                <ul class="demo-link">
                                    <li><a id="modern-demo" href="general-widget.html" target="_blank"><img
                                                src="{{ asset('assets/images/landing/icon/html/html.png') }}"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h3>Modern layout</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->
    @include('js.global')
    @slot('script')
        <script>

        </script>
    @endslot
</x-app-layout>
