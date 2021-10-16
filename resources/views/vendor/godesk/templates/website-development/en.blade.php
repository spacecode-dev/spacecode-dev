@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Website <br>development agency <br>with self-created CMS</h1>
                        <p>GoDesk is a self-developed platform created on the Laravel PHP Framework. It is simple, flexible and modern. Our customers are happy because this CMS
                            saves their time and money. Custom website development has become cheaper and better.</p>
                        @include('godesk-index::add.conversion.see-price')
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-3">
                    <img src="{{ GoDesk::image('website/ready.jpg') }}" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="for section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">
                        <img src="{{ GoDesk::image('website/godesk-icons/manage.png') }}" alt="tool for manage">
                        <p class="pre h6 text-muted">CMS Website Development</p>
                        <h2 class="h3">CMS for people who value time</h2>
                        <p>Your employees were not hired to work with complex software. GoDesk is a simple solution
                            designed to manage your website. Now it is the best cms for website development we ever work
                            with. We offer you a CMS that will grow and give you new opportunities. Once you order a
                            website, you get all the functionality forever.</p>
{{--                        <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Go To YouTube</a>--}}
                        <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="The channel is under construction">Go To Youtube</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-standard section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/custom.png') }}" alt="Standard needs">
                        <h3 class="h4">Standard needs</h3>
                        <p class="m-0">The system has solved such tasks as managing users, roles and their permissions,
                            pages, posts, post comments, post categories and post tags. There is a separate section
                            named Contact Form for communication with your website visitors. Custom website development
                            services include any other improvements for your website needs.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/custom.jpg') }}" alt="Standard needs image">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-settings section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/settings.jpg') }}" alt="Settings image">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/settings.png') }}" alt="Settings">
                        <h3 class="h4">Settings</h3>
                        <p class="m-0">We provided the opportunity to set update the website name and description,
                            upload logo and favicon, change the timezone, set the main language and much more. We intend
                            to implement a lot of settings to dev website faster and better.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-meta section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/meta.png') }}" alt="Meta fields">
                        <h3 class="h4">Meta fields</h3>
                        <p class="m-0">We are think about the website visibility and give you functionality for changing
                            meta fields: meta name, meta description, meta keywords, openGraph and json-ld, document
                            state and indexing by search robots. Seo website development is a priority for us and our
                            CMS.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/meta.jpg') }}" alt="Meta fields image">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-filemanager section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/filemanager.jpg') }}"
                         alt="Filemanager image">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/filemanager.png') }}"
                             alt="Filemanager">
                        <h3 class="h4">Filemanager</h3>
                        <p class="m-0">In the filemanager you can both upload and delete files, create folders and
                            rename them, view information about downloaded files and see previews. Any web page
                            developer understands that this functionality is indispensable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">
                        <p class="pre text-muted h6">Easy to Use</p>
                        <h2 class="h3">Boost website level with CMS GoDesk</h2>
                        <p>Web Application Development should take less time and cost less.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="carousel owl-carousel owl-theme" data-carousel="{items: 1, loop: true, nav: true, navClass: [&#x27;owl2-prev btn btn-primary rounded-circle&#x27;,&#x27;owl2-next btn btn-primary rounded-circle&#x27;], navText: [&#x27;<span class=icon-angle-left></span>&#x27;,&#x27;<span class=icon-angle-right></span>&#x27;], dots: false, center: true, margin: 70, autoWidth: true, autoplayTimeout: 6000, autoplay: true, smartSpeed: 500, autoplayHoverPause: true, progress: true}">
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/users.jpg') }}" alt="Users">
                            <h4 class="title h5">Users</h4>
                            <p>Managing users, assigning them roles and permissions is the basis for any CMS and important for website application development.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/roles.jpg') }}" alt="Roles">
                            <h4 class="title h5">Roles</h4>
                            <p>It is much easier to create a role and assign it to several users than assign permissions to each of them.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/permissions.jpg') }}" alt="Permissions">
                            <h4 class="title h5">Permissions</h4>
                            <p>It is very important to be able to assign permissions for each user. After all, you may need to temporarily pick up permission.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/pages.jpg') }}" alt="Pages">
                            <h4 class="title h5">Pages</h4>
                            <p>Page Resource is an important part of any CMS for dynamic website development. Many pages are template and they have variables.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/posts.jpg') }}" alt="Posts">
                            <h4 class="title h5">Posts</h4>
                            <p>Post Resource is one of the most important sections. Can you imagine your website without articles?</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/settings.jpg') }}" alt="Settings">
                            <h4 class="title h5">Settings</h4>
                            <p>Any site consists of many elements and it is extremely important to manage them from admin panel.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/seo.jpg') }}" alt="Seo">
                            <h4 class="title h5">Seo</h4>
                            <p>Perhaps Seo is all. If your site is not indexed by search bots, you can forget about promotion.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/filemanager.jpg') }}" alt="Filemanager">
                            <h4 class="title h5">Filemanager</h4>
                            <p>The filemanager function is very important for PHP website development. The process of working with files is complicated without it.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-main section">
        <div class="container">
            <div class="row main">
                <div class="col-12">
                    <div class="heading text-center">
                        <h3>The basis for website <br>development services</h3>
                        <p>Each time, while working on a new project, we reserve the right to add new
                            features for general use. Thus, all our customers get the opportunity to use the CMS GoDesk
                            new features.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('godesk-index::add.form', ['entity' => $entity])
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop