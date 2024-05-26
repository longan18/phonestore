@extends('admin.layouts.admin')

@section('title')
    {{ __('Sản phẩm') }}
@endsection
@section('css-after')
    <style>
        .ck-editor__editable {
            min-height: 100px;
            max-height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-dashboard mr-3"></i>{{ !empty($product->name) ?  __('Sửa sản phẩm điện thoại thông minh') : __('Tạo mới sản phẩm điện thoại thông minh') }}
            </h1>
            <p>{{ __('Thông tin sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('smartphone.index') }}">Danh sách sản phẩm điện thoại thông minh</a></li>
            <li class="breadcrumb-item"><a
                    href="#">{{ !empty($product->name) ? __('Sửa sản phẩm điện thoại thông minh') : __('Tạo mới sản phẩm điện thoại thông minh') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ !empty($product->name) ?  __('Sửa sản phẩm').' '. $product->slug : __('Tạo sản phẩm') }}</h3>
                    @if(!empty($product))
                        <p>
                            <a class="btn btn-primary icon-btn" href="{{ route('smartphone.option.index', ['product' => $product->slug]) }}"><i class="fa fa-list"></i>{{ __('Danh sách option sản phẩm') }}</a>
                        </p>
                    @endif
                </div>

                <form id="handle-product" action="{{ empty($product) ? route('smartphone.store') : route('smartphone.update', ['product' => $product->id]) }}"
                      method="POST" data-redirect="{{ route('smartphone.index') }}" enctype="multipart/form-data">
                    @if(!empty($product))
                        <input name="slug" value="{{ $product->slug }}" type="hidden">
                        <input name="id" value="{{ $product->smartphone->id }}" type="hidden">
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Tên sản phẩm') }}<span class="text-danger">*</span></label>
                                <input name="name" value="{{ $product->name ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Danh mục sản phẩm') }}<span class="text-danger">*</span></label>
                                <select name="category_id" class="select2-multiple form-control">
                                    <option value="{{ CATEGORY_SAMRTPHONE }}">smartphone</option>
                                </select>
                                <div class="error-message error_category_id"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Thương hiệu sản phẩm') }}<span class="text-danger">*</span></label>
                                <select name="brand_id" class="select2-multiple form-control" >
                                    <option value="">{{ __('Chọn nhãn hiệu:') }}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ handleSelected($brand->id, $product->brand_id ?? null) }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="error-message error_brand_id"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Ảnh sản phẩm') }}<span class="text-danger">*</span></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input name="avatar" class="d-none" type='file' id="image-upload"
                                               accept=".png,.jpg,.jpeg"/>
                                        <label for="image-upload">
                                            <div class="btn btn-primary icon-btn">
                                                <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="avatar-preview mt-2 mb-1">
                                        <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($product->avatar) ?: 'd-none' }}"
                                             height="150" width="150" id="image-preview" alt="User profile picture" src="{{ $product->avatar ?? '' }}">
                                    </div>
                                </div>
                                <div class="error-message error_avatar"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Ảnh phụ:') }}</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input name="sub_image[]" multiple="" data-max_length="4" id="image-upload-multiple"
                                               class="d-none upload_multiple" type='file' accept=".png,.jpg,.jpeg"/>
                                        <label for="image-upload-multiple">
                                            <div class="btn btn-primary icon-btn">
                                                <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="upload__img-wrap">
                                    @if(!empty($product->sub_image))
                                        @foreach($product->sub_image as $subImage)
                                            <div class="upload__img-box">
                                                <div style="background-image: url('{{ $subImage['url'] }}')" data-number="0" data-file="download (6).jpeg" class="img-bg">
                                                    <div class="upload__img-close remove-sub-image" data-sub_image_remove="{{ $subImage['id'] }}"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 row error-message error_sub_image"></div>
                            </div>
                            <div class="mb-3">
                                <label for="screenTechnology" class="form-label">{{ __('Screen technology') }}</label>
                                <input type="text" name="screen_technology" value="{{ $product->smartphone->screen_technology ?? '' }}" class="form-control">
                                <div class="error-message erro_screen_technology"></div>
                            </div>
                            <div class="mb-3">
                                <label for="screenResolution" class="form-label">{{ __('Screen resolution') }}</label>
                                <input type="text" name="screen_resolution" value="{{ $product->smartphone->screen_resolution ?? '' }}" class="form-control">
                                <div class="error-message error_screen_resolution"></div>
                            </div>
                            <div class="mb-3">
                                <label for="widescreen" class="form-label">{{ __('Widescreen') }}<span class="text-danger">*</span></label>
                                <input type="text" name="widescreen" value="{{ $product->smartphone->widescreen ?? '' }}" class="form-control">
                                <div class="error-message error_widescreen"></div>
                            </div>
                            <div class="mb-3">
                                <label for="scanningFrequency" class="form-label">{{ __('Scanning frequency') }}(GB)<span class="text-danger">*</span></label>
                                <input type="number" name="scanning_frequency" value="{{ $product->smartphone->scanning_frequency ?? '' }}" class="form-control">
                                <div class="error-message error_scanning_frequency"></div>
                            </div>
                            <div class="mb-3">
                                <label for="maximumBrightness" class="form-label">{{ __('Smaximum brightness') }}</label>
                                <input type="number" name="maximum_brightness" value="{{ $product->smartphone->maximum_brightness ?? '' }}" class="form-control">
                                <div class="error-message error_maximum_brightness"></div>
                            </div>
                            <div class="mb-3">
                                <label for="touchGlassSurface" class="form-label">{{ __('Touch glass surface') }}</label>
                                <input type="text" name="touch_glass_surface" value="{{ $product->smartphone->touch_glass_surface ?? '' }}" class="form-control">
                                <div class="error-message error_touch_glass_surface"></div>
                            </div>
                            <div class="mb-3">
                                <label for="rearCameraResolution" class="form-label">{{ __('Rear camera resolution') }}</label>
                                <input type="text" name="rear_camera_resolution" value="{{ $product->smartphone->rear_camera_resolution ?? '' }}" class="form-control">
                                <div class="error-message error_rear_camera_resolution"></div>
                            </div>
                            <div class="mb-3">
                                <label for="flashLight" class="form-label">{{ __('Flash light') }}</label>
                                <input type="text" name="flash_light" value="{{ $product->smartphone->flash_light ?? '' }}" class="form-control">
                                <div class="error-message error_flash_light"></div>
                            </div>
                            <div class="mb-3">
                                <label for="frontCameraResolution" class="form-label">Front camera resolution</label>
                                <input type="text" name="front_camera_resolution" value="{{ $product->smartphone->front_camera_resolution ?? '' }}" class="form-control">
                                <div class="error-message error_front_camera_resolution"></div>
                            </div>
                            <div class="mb-3">
                                <label for="operatingSystem" class="form-label">Operating system</label>
                                <input type="text" name="operating_system" value="{{ $product->smartphone->operating_system ?? '' }}" class="form-control">
                                <div class="error-message error_operating_system"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="cpu" class="form-label">CPU</label>
                                <input type="text" name="cpu" value="{{ $product->smartphone->cpu ?? '' }}" class="form-control">
                                <div class="error-message error_cpu"></div>
                            </div>
                            <div class="mb-3">
                                <label for="cpuSpeed" class="form-label">CPU speed</label>
                                <input type="text" name="cpu_speed" value="{{ $product->smartphone->cpu_speed ?? '' }}" class="form-control">
                                <div class="error-message error_cpu_speed"></div>
                            </div>
                            <div class="mb-3">
                                <label for="gpu" class="form-label">GPU</label>
                                <input type="text" name="gpu" value="{{ $product->smartphone->gpu ?? '' }}" class="form-control">
                                <div class="error-message error_cpu_speed"></div>
                            </div>
                            <div class="mb-3">
                                <label for="memoryStick" class="form-label">Memory stick</label>
                                <input type="text" name="memory_stick" value="{{ $product->smartphone->memory_stick ?? '' }}" class="form-control">
                                <div class="error-message error_memory_stick"></div>
                            </div>
                            <div class="mb-3">
                                <label for="phoneBook" class="form-label">Phone book</label>
                                <input type="text" name="phone_book" value="{{ $product->smartphone->phone_book ?? '' }}" class="form-control">
                                <div class="error-message error_phone_book"></div>
                            </div>
                            <div class="mb-3">
                                <label for="mobileNetwork" class="form-label">Mobile network</label>
                                <input type="text" name="mobile_network" value="{{ $product->smartphone->mobile_network ?? '' }}" class="form-control">
                                <div class="error-message error_mobile_network"></div>
                            </div>
                            <div class="mb-3">
                                <label for="sim" class="form-label">SIM</label>
                                <input type="text" name="sim" value="{{ $product->smartphone->sim ?? '' }}" class="form-control">
                                <div class="error-message error_sim"></div>
                            </div>
                            <div class="mb-3">
                                <label for="charger" class="form-label">Charger</label>
                                <input type="text" name="charger" value="{{ $product->smartphone->charger ?? '' }}" class="form-control">
                                <div class="error-message error_charger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="headphoneJack" class="form-label">Headphone jack</label>
                                <input type="text" name="headphone_jack" value="{{ $product->smartphone->headphone_jack ?? '' }}" class="form-control">
                                <div class="error-message error_headphone_jack"></div>
                            </div>
                            <div class="mb-3">
                                <label for="otherConnections" class="form-label">Other connections</label>
                                <input type="text" name="other_connections" value="{{ $product->smartphone->other_connections ?? '' }}" class="form-control">
                                <div class="error-message error_other_connections"></div>
                            </div>
                            <div class="mb-3">
                                <label for="batteryType" class="form-label">Battery type<span class="text-danger">*</span></label>
                                <input type="number" name="battery_type" value="{{ $product->smartphone->battery_type ?? '' }}" class="form-control">
                                <div class="error-message error_battery_type"></div>
                            </div>
                            <div class="mb-3">
                                <label for="batteryCapacity" class="form-label">Battery capacity</label>
                                <input type="text" name="battery_capacity" value="{{ $product->smartphone->battery_capacity ?? '' }}" class="form-control">
                                <div class="error-message error_battery_capacity"></div>
                            </div>
                            <div class="mb-3">
                                <label for="maximumChargingSupport" class="form-label">Maximum charging support</label>
                                <input type="number" name="maximum_charging_support" value="{{ $product->smartphone->maximum_charging_support ?? '' }}" class="form-control">
                                <div class="error-message error_maximum_charging_support"></div>
                            </div>
                            <div class="mb-3">
                                <label for="chargerIncludedWithTheDevice" class="form-label">Charger included with the device</label>
                                <input type="text" name="charger_included_with_the_device" value="{{ $product->smartphone->charger_included_with_the_device ?? '' }}" class="form-control">
                                <div class="error-message error_charger_included_with_the_device"></div>
                            </div>
                            <div class="mb-3">
                                <label for="advanced_security" class="form-label">Advanced security</label>
                                <input type="text" name="advanced_security" value="{{ $product->smartphone->advanced_security ?? '' }}" class="form-control">
                                <div class="error-message error_advanced_security"></div>
                            </div>
                            <div class="mb-3">
                                <label for="waterAndDustResistant" class="form-label">Water and dust resistant</label>
                                <input type="text" name="water_and_dust_resistant" value="{{ $product->smartphone->water_and_dust_resistant ?? '' }}" class="form-control">
                                <div class="error-message error_water_and_dust_resistant"></div>
                            </div>
                            <div class="mb-3">
                                <label for="record" class="form-label">Record</label>
                                <input type="text" name="record" value="{{ $product->smartphone->record ?? '' }}" class="form-control">
                                <div class="error-message error_record"></div>
                            </div>
                            <div class="mb-3">
                                <label for="design" class="form-label">Design</label>
                                <input type="text" name="design" value="{{ $product->smartphone->design ?? '' }}" class="form-control">
                                <div class="error-message error_design"></div>
                            </div>
                            <div class="mb-3">
                                <label for="material" class="form-label">Material</label>
                                <input type="text" name="material" value="{{ $product->smartphone->material ?? '' }}" class="form-control">
                                <div class="error-message error_material"></div>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" name="size" value="{{ $product->smartphone->size ?? '' }}" class="form-control">
                                <div class="error-message error_size"></div>
                            </div>
                            <div class="mb-3">
                                <label for="mass" class="form-label">Mass(g)</label>
                                <input type="number" name="mass" value="{{ $product->smartphone->mass ?? '' }}" class="form-control">
                                <div class="error-message error_mass"></div>
                            </div>
                            <div class="mb-3">
                                <label for="launchTime" class="form-label">Launch time</label>
                                <input type="text" name="launch_time" value="{{ $product->smartphone->launch_time ?? '' }}" class="form-control">
                                <div class="error-message error_launch_time"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="film" class="form-label">{{ __('Film') }}<span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="film" id="film">
                                    {!! $product->smartphone->film ?? '' !!}
                                </textarea>
                                <div class="error-message error_film"></div>
                            </div>
                            <div class="mb-3">
                                <label for="rearCameraFeature" class="form-label">Rear camera feature <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="rear_camera_feature" id="rear_camera_feature">
                                    {!! $product->smartphone->rear_camera_feature ?? '' !!}
                                </textarea>
                                <div class="error-message error_rear_camera_feature"></div>
                            </div>
                            <div class="mb-3">
                                <label for="frontCameraFeature" class="form-label">Front camera feature <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="front_camera_feature" id="front_camera_feature">
                                    {!! $product->smartphone->front_camera_feature ?? '' !!}
                                </textarea>
                                <div class="error-message error_front_camera_feature"></div>
                            </div>
                            <div class="mb-3">
                                <label for="wifi" class="form-label">Wifi <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="wifi" id="wifi">
                                    {!! $product->smartphone->wifi ?? '' !!}
                                </textarea>
                                <div class="error-message error_wifi"></div>
                            </div>
                            <div class="mb-3">
                                <label for="gps" class="form-label">GPS <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="gps" id="gps">
                                    {!! $product->smartphone->gps ?? '' !!}
                                </textarea>
                                <div class="error-message error_gps"></div>
                            </div>
                            <div class="mb-3">
                                <label for="bluetooth" class="form-label">Bluetooth <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="bluetooth" id="bluetooth">
                                    {!! $product->smartphone->bluetooth ?? '' !!}
                                </textarea>
                                <div class="error-message error_bluetooth"></div>
                            </div>
                            <div class="mb-3">
                                <label for="batteryTechnology" class="form-label">Battery technology<span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="battery_technology" id="battery_technology">
                                    {!! $product->smartphone->battery_technology ?? '' !!}
                                </textarea>
                                <div class="error-message error_battery_technology"></div>
                            </div>
                            <div class="mb-3">
                                <label for="specialFeatures" class="form-label">Special features <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="special_features" id="special_features">
                                    {!! $product->smartphone->special_features ?? '' !!}
                                </textarea>
                                <div class="error-message error_special_features"></div>
                            </div>
                            <div class="mb-3">
                                <label for="watchAMovie" class="form-label">Watch a movie <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="watch_a_movie" id="watch_a_movie">
                                    {!! $product->smartphone->watch_a_movie ?? '' !!}
                                </textarea>
                                <div class="error-message error_watch_a_movie"></div>
                            </div>
                            <div class="mb-3">
                                <label for="listeningToMusic" class="form-label">Listening to music <span class="text-danger"> - viết dưới dạng Bulleted List</span></label>
                                <textarea class="form-control" name="listening_to_music" id="listening_to_music">
                                    {!! $product->smartphone->listening_to_music ?? '' !!}
                                </textarea>
                                <div class="error-message error_listening_to_music"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> {{ __('Lưu') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/product.js') }}" type="module"></script>
    <script>
        // Lấy tất cả các phần tử textarea
        const textareas = document.querySelectorAll('textarea');

        // Lặp qua các phần tử textarea và khởi tạo CKEditor
        textareas.forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: {
                        items: [ 'bulletedList' ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
