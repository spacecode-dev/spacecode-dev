<aside>
    <nav class="navbar navbar-expand navbar-dark flex-column align-items-start py-2">
        <div class="collapse navbar-collapse">
            <ul class="flex-column navbar-nav w-100 justify-content-between">
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="{!! GoDesk::urlById('page', 1, $entity->locale) !!}">
                        <span>{!! __('Homepage') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap{{\Request::is('profile') ? ' active' : null}}" href="{!! url('profile') !!}">
                        <span>{!! __('Contact Information') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap{{\Request::is('profile/password') ? ' active' : null}}" href="{!! url('profile/password') !!}">
                        <span>{!! __('Password') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap{{\Request::is('profile/settings') ? ' active' : null}}" href="{!! url('profile/settings') !!}">
                        <span>{!! __('Settings') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap{{\Request::is('profile/licenses') ? ' active' : null}}" href="{!! url('profile/licenses') !!}">
                        <span>{!! __('Licenses') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="{!! GoDesk::urlById('page', 8, $entity->locale) !!}" target="_blank">
                        <span>{!! __('Documentation') !!}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="{!! route('profile.logout', ['lang' => $entity->locale]) !!}">
                        <span>{!! __('Logout') !!}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
        <polygon points="79.093,0 48.907,30.187 146.72,128 48.907,225.813 79.093,256 207.093,128"></polygon>
    </svg>
</aside>