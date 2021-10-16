@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Головна</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12">
                    <div class="heading text-center">
                        <p class="pre h6">Ніяких прихованих платежів</p>
                        <h1>Справедливі ціни, що відповідають вашим потребам</h1>
                        <p>Просте і прозоре ціноутворення для всіх. Ніяких несподіваних додаткових платежів.</p>
                    </div>
                </div>
                <div class="col-12" id="priceTableDiv">
                    <price-table price-data='{!! json_encode([
                        'currency' => $settings->prices->currency,
                        'apps' => [
                            (object)['name' => 'landing', 'title' => [__('Landing Page'), __('One Page Website')]],
                            (object)['name' => 'personal', 'title' => [__('Personal Website'), __('Promo Website'), __('Website for Small Business'), __('Blog')]],
                            (object)['name' => 'corporate', 'title' => [__('Corporate Website')]],
                            (object)['name' => 'individual', 'title' => [__('Online Portal'), __('Ecommerce'), __('Individual Development')]]
                        ],
                        'list' => [
                            (object)['name' => 'result', 'title' => '', 'array' => [$settings->prices->one->without, $settings->prices->personal->without, $settings->prices->corporate->without, $settings->prices->ecommerce->without]],
                            (object)['name' => 'pages', 'title' => __('Pages'), 'array' => [1, 10, 20, -1]],
                            (object)['name' => 'design', 'title' => __('Web Design'), 'array' => [$settings->prices->one->design, $settings->prices->personal->design, $settings->prices->corporate->design, $settings->prices->ecommerce->design]],
                            (object)['name' => 'admin', 'title' => __('Admin Panel'), 'array' => [true, true, true, true]],
                            (object)['name' => 'testing', 'title' => __('Testing'), 'array' => [true, true, true, true]],
                            (object)['name' => 'content', 'title' => __('Content filling'), 'array' => [true, true, true, true]],
                            (object)['name' => 'mobile', 'title' => __('Mobile-driven'), 'array' => [true, true, true, true]],
                            (object)['name' => 'security', 'title' => __('Security audit'), 'array' => [true, true, true, true]],
                            (object)['name' => 'seo', 'title' => __('Compliant with SEO standard'), 'array' => [true, true, true, true]],
                            (object)['name' => 'performance', 'title' => __('Scalability and performance'), 'array' => [true, true, true, true]],
                            (object)['name' => 'multilingual', 'title' => __('Multilingual'), 'array' => [true, true, true, true]],
                            (object)['name' => 'hosting', 'title' => __('Web Hosting'), 'array' => [6, 8, 12, 20]]
                        ]
                    ]) !!}'></price-table>
                    @include('godesk-index::add.conversion.request-exact-cost')
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="faq section-inverse">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-12">--}}
    {{--                    <div class="heading">--}}
    {{--                        <h2 class="text-light">Frequently asked Questions</h2>--}}
    {{--                        <p>We've crafted this FAQ page to answer many of your frequently asked questions.</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-12">--}}
    {{--                    <div id="accordion">--}}
    {{--                        <div class="card">--}}
    {{--                            <div class="card-header" id="headingOne">--}}
    {{--                                <h5 class="mb-0">--}}
    {{--                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
    {{--                                        Collapsible Group Item #1--}}
    {{--                                    </button>--}}
    {{--                                </h5>--}}
    {{--                            </div>--}}

    {{--                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">--}}
    {{--                                <div class="card-body">--}}
    {{--                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="card">--}}
    {{--                            <div class="card-header" id="headingTwo">--}}
    {{--                                <h5 class="mb-0">--}}
    {{--                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
    {{--                                        Collapsible Group Item #2--}}
    {{--                                    </button>--}}
    {{--                                </h5>--}}
    {{--                            </div>--}}
    {{--                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">--}}
    {{--                                <div class="card-body">--}}
    {{--                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="card">--}}
    {{--                            <div class="card-header" id="headingThree">--}}
    {{--                                <h5 class="mb-0">--}}
    {{--                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">--}}
    {{--                                        Collapsible Group Item #3--}}
    {{--                                    </button>--}}
    {{--                                </h5>--}}
    {{--                            </div>--}}
    {{--                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">--}}
    {{--                                <div class="card-body">--}}
    {{--                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    @include('godesk-index::add.form', ['entity' => $entity])--}}
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop