<header id="wrapper__header" class="d-flex {{body_class($entity)}}">
    <a href="{!! GoDesk::urlById('page', 1, $entity->locale) !!}" class="logo d-flex align-items-center mr-auto"{!! \Request::is('') || \Request::is('ru') ? ' rel="nofollow"' : '' !!}>
        <img src="{!! GoDesk::image(get_setting('website_logo')) !!}" alt="SpaceCode">
    </a>

    @if(GoDesk::isMultiLang() && isset($entity->locales))
        <div class="mr-3 lang">
            <ul>
                @foreach($entity->locales as $key => $value)
                    <li class="{!! empty($value) ? 'active' : null !!}">
                        @if(empty($value))
                            <span>{!! $key !!}</span>
                        @else
                            <a href="{!! $value !!}">{!! $key !!}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mr-5 profileButton">
        @if(!\Request::is('profile') && !\Request::is('profile/*'))
            <a class="btn btn-secondary profile-button"
               href="{!! Auth::check() ? route('profile') : route('profile', ['lang' => $entity->locale]) !!}">
                <span class="icon icon-user"></span>
            </a>
        @endif
        @include('godesk-index::add.conversion.request-exact-cost-header')
    </div>
    @if(!\Request::is('profile') && !\Request::is('profile/*'))
            <button class="d-flex align-items-center hamburger hamburger--spin" aria-label="Menu" aria-controls="navigation" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                <span class="hamburger-label">
                    {!! __('Menu') !!}
                </span>
            </button>
    @endif
    <nav id="navigation" class="d-flex hide">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul>
                        @foreach([
                                (object)['id' => 2, 'name' => 'PHP', 'text' => 'We create the most modern client-server apps using Laravel framework.'],
                                (object)['id' => 5, 'name' => 'Web Development', 'text' => 'We create cool websites using self-developed application CMS GoDesk based on Laravel Framework.'],
                                (object)['id' => 5, 'name' => 'Web Migration', 'text' => 'We transfer websites to self-developed application CMS GoDesk based on Laravel Framework.'],
                                (object)['id' => 9, 'name' => 'CMS GoDesk'],
                                (object)['id' => 18, 'name' => 'Portfolio'],
                                (object)['id' => 16, 'name' => 'Pricing'],
                                (object)['id' => 6, 'name' => 'Blog'],
                                (object)['id' => 7, 'name' => 'Contact Us'],
                            ] as $link)
                            <li>
                                <a href="{!! GoDesk::urlById('page', $link->id, $entity->locale) !!}">
                                    <p class="name h4{!! !isset($link->text) ? ' m-0' : '' !!}">{!! __($link->name) !!}</p>
                                    @if(isset($link->text))
                                        <p class="text m-0">{!! __($link->text) !!}</p>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @if(GoDesk::isMultiLang() && isset($entity->locales))
                        <ul class="language">
                            @foreach($entity->locales as $key => $value)
                                <li class="{!! empty($value) ? 'active' : null !!}">
                                    @if(empty($value))
                                        <span>{!! $key !!}</span>
                                    @else
                                        <a href="{!! $value !!}">{!! $key !!}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
