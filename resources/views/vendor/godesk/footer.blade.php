<footer id="wrapper__footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 main">
                <div class="logo d-flex align-items-center">
                    <img src="{!! GoDesk::image(get_setting('website_logo')) !!}" alt="SpaceCode">
                </div>
                @if(!empty(get_setting('website_social')))
                    <div class="social d-flex">
                        @foreach(get_setting('website_social') as $key => $link)
                            @if(!\Illuminate\Support\Str::startsWith($key, 'chat_') && $key !== 'youtube')
                                <a href="{{ $link }}" target="_blank" rel="nofollow">
                                    <img src="{{ GoDesk::image('website/social/' . $key . '.png') }}" alt="{{\Illuminate\Support\Str::title($key)}} SpaceCode">
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
                <ul class="menu list-unstyled m-0">
                    @foreach([
                        (object)['id' => 2, 'name' => 'Laravel web application development'],
                        (object)['id' => 5, 'name' => 'Web Development'],
                        (object)['id' => 9, 'name' => 'CMS GoDesk'],
                        (object)['id' => 18, 'name' => 'Portfolio'],
                        (object)['id' => 16, 'name' => 'Pricing'],
                        (object)['id' => 6, 'name' => 'Blog'],
                        (object)['id' => 7, 'name' => 'Contact Us'],
                    ] as $link)
                        <li>
                            <a class="text-light btn btn-link pl-0" href="{{ GoDesk::urlById('page', $link->id, $entity->locale) }}">{!! __($link->name) !!}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7 col-sm-12 suggest">
                <p class="h2 text-light">{!! __('Do you have any partnership suggestions?') !!}</p>
                <p class="h4 text-light">{!! __('We don’t mind. We are a creative team and open for communication. Web Development, Web Design, Start-ups, Outsourcing, Interesting projects...') !!}</p>
                <p class="need">{!! __('If you like jokes and make cool stuff in your business, <a class="link text-warning" href=":link">we need to talk</a>, no doubt.', ['link' => GoDesk::urlById('page', 7, $entity->locale)]) !!}</p>
            </div>
        </div>
    </div>
    <div id="orderFormModalDiv">
        <order-form-modal order-data='{!! json_encode([
                'lang' => $entity->locale,
                'country' => ip_info() ? ip_info()['country_code'] : null,
                'type' => 'orderForm'
        ]) !!}'></order-form-modal>
    </div>
</footer>
