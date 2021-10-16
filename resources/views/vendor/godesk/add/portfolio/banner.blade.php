<div class="banner section" style="background: {!! $entity->variables->heading_color !!}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="text-white">{{ $entity->title }}</h1>
                <p class="text-white">{!! $entity->excerpt !!}</p>
            </div>
            <div class="col-6 d-md-block d-none">
                <img src="{{ $entity->thumbnail }}" class="card-img-top" alt="{{ $entity->title }}">
            </div>
        </div>
    </div>
</div>