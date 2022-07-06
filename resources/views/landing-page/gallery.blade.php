<x-app-layout>
    <section class="ecommerce-pages section-py-space section-pb-space mt-5">
        <div class="title">
            <h2><?= $items['gallery_category_name']?></h2>
        </div>
        <div class="custom-container">
            <div class="row">
                @foreach($items['items'] as $item)
                    <div class="col-md-4">
                        <div class="pages-box">
                            <div class="img-wrraper">
                                <img class="img-fluid" src="{{asset('/storage/'.$item['gallery_item_image'])}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
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
