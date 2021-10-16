@if(get_setting('website_logo'))
    <div class="mx-auto py-8 max-w-sm text-center text-90">
        <img src="{!! GoDesk::image(get_setting('website_logo')) !!}" alt="SpaceCode" width="180">
    </div>
@endif