@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section-inverse">
        <div class="bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-md-12">
                    <h1 class="h6">Web Development Agency</h1>
                    <h2 class="hero-heading text-light">Looking <br>for a php web development partner?</h2>
                    <p>Hi, my name is Vladlen, I'm the web developer and SpaceCode CEO, work with and for many start-ups. I have {{ date('Y') - 2014 }} years of experience in custom web application development and love working with the latest web development technologies like Laravel, Vue js ....</p>
                    @include('godesk-index::add.conversion.see-price')
                    <blockquote class="blockquote mb-0">
                        <footer class="blockquote-footer d-flex align-items-center">
{{--                            <img src="{{ GoDesk::image('website/founder.jpg') }}" alt="SpaceCode Founder">--}}
                            <div>
                                <p class="h6">Vladlen</p>
                                <small>SpaceCode CEO</small>
                            </div>
                        </footer>
                    </blockquote>
                </div>
                <div class="col-lg-6 col-md-12" id="orderFormDiv">
                    <order-form order-data='{!! json_encode($entity->orderData) !!}'></order-form>
                </div>
            </div>
        </div>
    </div>
    <div class="skills">
        <div class="inner">
            <div class="container">
                <div class="row bg-white p-lg-5 p-4 d-flex align-items-center">
                    <div class="col-lg-8 col-md-9 col-sm-12 skills">
                        <p>We work on:</p>
                        <div class="d-flex align-items-center flex-wrap flex-sm-nowrap">
                            <img src="{{ GoDesk::image('website/prog/php.png') }}" alt="php">
                            <img src="{{ GoDesk::image('website/prog/css3.png') }}" alt="css3">
                            <img src="{{ GoDesk::image('website/prog/html5.png') }}" alt="html5">
                            <img src="{{ GoDesk::image('website/prog/mysql.png') }}" alt="mysql">
                            <img src="{{ GoDesk::image('website/prog/sass.png') }}" alt="sass">
                            <img src="{{ GoDesk::image('website/prog/jquery.png') }}" alt="jquery">
                            <img src="{{ GoDesk::image('website/prog/npm.png') }}" alt="npm">
                            <img src="{{ GoDesk::image('website/prog/nodejs.png') }}" alt="nodejs">
                            <img src="{{ GoDesk::image('website/prog/git.png') }}" alt="git">
                            <img src="{{ GoDesk::image('website/prog/laravel.png') }}" alt="laravel">
                            <img src="{{ GoDesk::image('website/prog/vuejs.png') }}" alt="vuejs">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12 numbers d-md-flex align-items-center justify-content-between d-none">
                        <div class="h2 companies">
                            100+<small>companies</small>
                        </div>
                        <div class="h2 years">
                            {{ date('Y') - 2014 }}<small>years</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="help section-primary">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-sm-12">
                    <h2 class="text-light">SpaceCode is a web app development company with the right approach</h2>
                    <p>Some of the companies with which I worked faced the problem of supporting their websites. They constantly had to modify and redo something to make their website function. Sometimes it happened that their site crashed and had to contact us for help.</p>
                    <p>As an individual backend web development expert in the past and SpaceCode Founder in present I know that the developer needs time to understand the code and solve the problem, but sometimes bug is too easy. The customer spends most of the budget only because the code needs to be studied.</p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <p>To solve these problems, we have developed the <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale)  }}">best cms for website development</a> based on Laravel.</p>
                    <p>We've been exposed to hundreds of projects over the years acting as a lead designers, UX lead, UX consultants, product advisors and full stack developers, which have helped us to optimise the quality and speed of our CMS. We always work with a clear timeframe towards specific deliverables and outcomes, so even though writing code is a creative process, it's always aligned with the business objectives.</p>
                    <p>We approach all our projects, regardless of the project size, with a kick-off discovery session to understand our client's vision, the business objectives and what the user data is indicating.</p>
                    <p>We help companies build and launch their products, improve their UX and product performance or completely develop whole project.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2>We design a lot of things</h2>
                    </div>
                    @if($entity->items->count() > 0)
                        <div class="carousel owl-carousel owl-theme" data-carousel="{items: 1, loop: true, nav: true, navClass: [&#x27;owl2-prev btn btn-primary rounded-circle&#x27;,&#x27;owl2-next btn btn-primary rounded-circle&#x27;], navText: [&#x27;<span class=icon-angle-left></span>&#x27;,&#x27;<span class=icon-angle-right></span>&#x27;], dots: false, center: true, margin: 70, autoWidth: true, autoplayTimeout: 6000, autoplay: true, smartSpeed: 500, autoplayHoverPause: true}">
                            @foreach($entity->items as $portfolio)
                                <div class="item d-flex flex-column">
                                    <a href="{!! $portfolio->url !!}" style="background: {!! $portfolio->variables->heading_color !!}">
                                        <img src="{!! $portfolio->thumbnail !!}">
                                        <div class="content">
                                            <h4 class="title">{{ $portfolio->title }}</h4>
                                            <p>{!! $portfolio->excerpt !!}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="godesk section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h3>A little about CMS GoDesk</h3>
                        <p>Superbly developed admin panel for Laravel websites. We have carefully worked on it and use the modern web development technologies to make you the most productive in the galaxy.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="nav justify-content-start flex-md-column flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-assignment-tab" data-toggle="pill" href="#v-pills-assignment" role="tab" aria-controls="v-pills-assignment" aria-selected="true">Assignment</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings Control</a>
                        <a class="nav-link" id="v-pills-seo-tab" data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">Search Engine Optimization</a>
                        <a class="nav-link" id="v-pills-filemanager-tab" data-toggle="pill" href="#v-pills-filemanager" role="tab" aria-controls="v-pills-filemanager" aria-selected="false">Filemanager</a>
                        <a class="nav-link" id="v-pills-pages-tab" data-toggle="pill" href="#v-pills-pages" role="tab" aria-controls="v-pills-pages" aria-selected="false">Pages</a>
                        <a class="nav-link" id="v-pills-blog-tab" data-toggle="pill" href="#v-pills-blog" role="tab" aria-controls="v-pills-blog" aria-selected="false">Blog</a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-assignment" role="tabpanel" aria-labelledby="v-pills-assignment-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/access.png') }}" alt="Assignment access">
                                        <div class="card-body">
                                            <h5 class="card-title">Access</h5>
                                            <p class="card-text">The process of checking the username and password of the user (or similar data).</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/users.png') }}" alt="Assignment users">
                                        <div class="card-body">
                                            <h5 class="card-title">Users</h5>
                                            <p class="card-text">User management, the ability to delete, create and edit, assign roles and permissions.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/roles.png') }}" alt="Assignment roles">
                                        <div class="card-body">
                                            <h5 class="card-title">Roles</h5>
                                            <p class="card-text">Role management, the ability to delete, create and edit, assign specific permissions. A role can be assigned to a user.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/permissions.png') }}" alt="Assignment permissions">
                                        <div class="card-body">
                                            <h5 class="card-title">Permissions</h5>
                                            <p class="card-text">The right to perform certain operations by users. It is possible to assign to the user either for a specific role.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/logo.png') }}" alt="Settings logo & favicon">
                                        <div class="card-body">
                                            <h5 class="card-title">Logo & Favicon</h5>
                                            <p class="card-text">The ability to upload a logo and favicon, which is cropped to specific sizes. The favicon is cropped twice for different sizes and is automatically placed in links in head.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/prefixes.png') }}" alt="Settings resource's prefixes">
                                        <div class="card-body">
                                            <h5 class="card-title">Resource's prefixes</h5>
                                            <p class="card-text">For some resources (for example posts) a prefix is required to display on website url. You can change them.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/tracking.png') }}" alt="Settings tracking">
                                        <div class="card-body">
                                            <h5 class="card-title">Tracking codes</h5>
                                            <p class="card-text">Analytics and statistics should be far from the last place in website optimization. Godesk makes it possible to insert Google Tag Manager and Facebook Pixel Code.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Settings multilanguage">
                                        <div class="card-body">
                                            <h5 class="card-title">Multi-language</h5>
                                            <p class="card-text">You can change admin panel language, specify the website main language and add additional ones.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/meta.png') }}" alt="Seo meta fields">
                                        <div class="card-body">
                                            <h5 class="card-title">Meta fields</h5>
                                            <p class="card-text">Each page requires meta fields: meta-title, meta-description, meta-keywords, openGraph and json-ld. We took care of it.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/crawls.png') }}" alt="Seo crawlers">
                                        <div class="card-body">
                                            <h5 class="card-title">Web crawlers</h5>
                                            <p class="card-text">A spiderbot systematically browses the World Wide Web, typically for the purpose of Web indexing. We give you the ability to control them.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/metadata.png') }}" alt="Seo additional meta">
                                        <div class="card-body">
                                            <h5 class="card-title">Additional meta</h5>
                                            <p class="card-text">A lot of metadata is not used by developers. We offer you the opportunity to manage rel=first, rel=last, rel=next, rel=prev, rel=canonical, rel=up, rel=author links and meta name=document-state.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-filemanager" role="tabpanel" aria-labelledby="v-pills-filemanager-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/upload.png') }}" alt="Filemanager upload">
                                        <div class="card-body">
                                            <h5 class="card-title">Upload</h5>
                                            <p class="card-text">You can upload files both single and multiple.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/display.png') }}" alt="Filemanager display">
                                        <div class="card-body">
                                            <h5 class="card-title">Display</h5>
                                            <p class="card-text">After uploading the file, you can view detailed information about it.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/folder.png') }}" alt="Filemanager folders">
                                        <div class="card-body">
                                            <h5 class="card-title">Folders</h5>
                                            <p class="card-text">The file manager has the ability to create, delete and rename folders.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multiple.png') }}" alt="Filemanager multiple">
                                        <div class="card-body">
                                            <h5 class="card-title">Multiple</h5>
                                            <p class="card-text">You can upload files all together by choosing their path or use Drag and Drop function.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pages" role="tabpanel" aria-labelledby="v-pills-pages-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/templates.png') }}" alt="Pages templates">
                                        <div class="card-body">
                                            <h5 class="card-title">Templates</h5>
                                            <p class="card-text">It often happens that the unusual body field is not enough for you. So, you can use template function to choose custom page.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/statuses.png') }}" alt="Pages statuses">
                                        <div class="card-body">
                                            <h5 class="card-title">Statuses</h5>
                                            <p class="card-text">There are two statuses for displaying pages: published and pending. In the second case, the page will be unavailable.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/guards.png') }}" alt="Pages guards">
                                        <div class="card-body">
                                            <h5 class="card-title">Guards</h5>
                                            <p class="card-text">Let's say you need an API that should work in the same application and work with JSON web tokens. Web defender is used by default.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Pages multilanguage">
                                        <div class="card-body">
                                            <h5 class="card-title">Multi-language</h5>
                                            <p class="card-text">All multilingual pages are configured separately from the main one. SEO fields, names, descriptions, links are unique.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-blog" role="tabpanel" aria-labelledby="v-pills-blog-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/posts.png') }}" alt="Blog posts">
                                        <div class="card-body">
                                            <h5 class="card-title">Posts</h5>
                                            <p class="card-text">For full blog functionality we have developed post resource. You can freely manage any post.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/comments.png') }}" alt="Blog comments">
                                        <div class="card-body">
                                            <h5 class="card-title">Comments<span class="badge badge-warning">next release</span></h5>
                                            <p class="card-text">Comment management system. Filtering, editing, deleting and creating.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/post-categories.png') }}" alt="Blog post categories and tags">
                                        <div class="card-body">
                                            <h5 class="card-title">Post categories and tags</h5>
                                            <p class="card-text">How can you imagine a blog without a categorization system or tagging? We took care to create it.</p>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="item col-6">--}}
                                {{--                                    <div class="card">--}}
                                {{--                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/post-tags.png') }}" alt="Blog post tags">--}}
                                {{--                                        <div class="card-body">--}}
                                {{--                                            <h5 class="card-title">Post tags</h5>--}}
                                {{--                                            <p class="card-text">Standard tagging system for posts. Easy to manage.</p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Blog post multilanguage">
                                        <div class="card-body">
                                            <h5 class="card-title">Multi-language</h5>
                                            <p class="card-text">All multilingual posts are configured separately from the main one. SEO fields, names, descriptions, links are unique.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex buttons">
                    <a class="btn btn-primary" href="{!! GoDesk::urlById('page', 9, $entity->locale) !!}">More about GoDesk</a>
                </div>
            </div>
        </div>
    </div>
    <div class="how section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="heading">
                        <h3>How can we help you?</h3>
                        <p>Tell us what you want to achieve by working with SpaceCode. We are ready to discuss any existing project or startup.</p>
                    </div>
                </div>
                <div class="item item-1 col-lg-4 col-md-12">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/independent.png') }}" alt="Laravel Web Application Development">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Senior level:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">$</small>{{ $settings->prices->hour }}<small class="number">/hour</small>
                                @elseif($settings->prices->currency === 'грн')
                                    {{ $settings->prices->hour }}<small class="number"> UAH</small><small class="number">/hour</small>
                                @elseif($settings->prices->currency === 'руб')
                                    {{ $settings->prices->hour }}<small class="number"> RUB</small><small class="number">/hour</small>
                                @endif
                            </p>
                            <h5 class="card-title">Laravel Web <br>Application Development</h5>
                            <p class="card-text">Maybe you need a custom web development solution, so our web application development services will help you achieve your business goals. Our Laravel developers specialize in building eloquent applications that are tailored specifically to your exact business needs.</p>
                            <a href="{{ GoDesk::urlById('page', 2, $entity->locale) }}" class="btn btn-link link">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="item item-2 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-dev.png') }}" alt="Web Site Development on CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Middle level:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">from $</small>{{ $settings->prices->personal->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">from </small>{{ $settings->prices->personal->without }}<small class="number"> UAH</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">from </small>{{ $settings->prices->personal->without }}<small class="number"> RUB</small>
                                @endif
                            </p>
                            <h5 class="card-title">Web Site Development <br>on CMS GoDesk</h5>
                            <p class="card-text">GoDesk offers clean and manageable control panel which is built on standardized principles and patterns with the help of Laravel Framework. While using GoDesk, we can smoothly and efficiently develop high-level Laravel websites and web apps.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" class="btn btn-link link">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="item item-3 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-migration.png') }}" alt="Website Migration to CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Junior/Middle level:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">from $</small>{{ $settings->prices->one->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">from </small>{{ $settings->prices->one->without }}<small class="number"> UAH</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">from </small>{{ $settings->prices->one->without }}<small class="number"> RUB</small>
                                @endif
                            </p>
                            <h5 class="card-title">Website Migration <br>to CMS GoDesk</h5>
                            <p class="card-text">As you know there are a number of ways of integrating Some CMS to Laravel. Depending on your goals we can help you to migrate an existing website with database and functions to GoDesk. Visually and functionally, everything will remain as it was.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" rel="nofollow" class="btn btn-link link">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="become section-inverse">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner">
                        <div class="card">
                            <div class="card-body">
                                <p class="pre h6">Become a customer</p>
                                <h5 class="h2 card-title text-light">Let’s work together and make your application better</h5>
                                <p class="card-text">Check it out on our YouTube channel to see yourself how easy it is to manage. We will take care of your website.</p>
                                {{--                                <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Go To Youtube</a>--}}
                                <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="The channel is under construction">Go To Youtube</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop