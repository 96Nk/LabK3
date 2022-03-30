<x-auth.app-layout title="Form Login">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-3">
                    <form action="{{route('registration')}}" method="post" class="theme-form">
                        @csrf
                        <div class="card-body">
                            <h4 class="text-center">Form Registration</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input class="form-control" autofocus type="text" name="company_name"
                                               placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="form-control" type="email" name="company_email"
                                               placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Number Phone</label>
                                        <input class="form-control" type="text" name="company_phone"
                                               placeholder="Telpon" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="3" name="company_adress"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-select select-province select2" name="prov_id" required>
                                            <option selected value="">.: Provinsi :.</option>
                                            @foreach($provinces as $province)
                                                <option
                                                    value="{{$province['prov_id']}}">{{$province['prov_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kabupaten</label>
                                        <select class="form-select select-city select2" name="city_id" required>
                                            <option selected disabled value="">.: Kabupaten :.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-select select-district select2" name="district_id" required>
                                            <option selected disabled value="">.: Kecamatan :.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelurahan / Desa</label>
                                        <select class="form-select select-village" name="village_id" required>
                                            <option selected disabled value="">.: Kelurahan / Desa :.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Create Account
                                </button>
                                <a class="btn btn-outline-danger btn-block" href="{{ route('home') }}">
                                    <i class="bi bi-arrow-bar-left"></i> Back to Home
                                </a>
                            </div>
                            <p>Already have an account? <a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('js.global')
    @slot('script')
        <script>

            $('.select-province').change(async function () {
                const prov_id = $(this).val()
                const htmls = await selectCity(prov_id)
                $('.select-city').html(htmls)
            })

            $('.select-city').change(async function () {
                const city_id = $(this).val()
                const loadDistrict = await getDistrict(city_id);
                console.log(loadDistrict)
            })

            async function selectCity(prov_id, cityID = null) {
                const loadCity = await getCity(prov_id);
                const cities = loadCity.data;
                let htmls = '<option selected value="">.: Pilih Kabupaten :.</option>';
                if (cities.length) {
                    cities.forEach((city) => {
                        const attr = cityID === city.city_id ? 'selected' : '';
                        htmls += `<option ${attr} value="${city.city_id}">${city.city_name}</option>`;
                    });
                }
                return htmls;
            }

            const getCity = (prov_id) => {
                return $.getJSON(BASEURL(`referensi/city/load-city/${prov_id}`))
            }
            const getDistrict = (city_id) => {
                return $.getJSON(BASEURL(`referensi/district/load-district/${city_id}`))
            }

        </script>
    @endslot

</x-auth.app-layout>
