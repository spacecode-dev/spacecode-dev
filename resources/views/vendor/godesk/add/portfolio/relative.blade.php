<div class="relative-portfolio">
    <div class="prev">
        @if($entity->relativePortfolio['prev'])
            <div class="bg" style="background: {{ $entity->relativePortfolio['prev']->variables->heading_color }}">
                <img src="{{ $entity->relativePortfolio['prev']->thumbnail }}" alt="{{ $entity->relativePortfolio['prev']->title }}">
            </div>
            <a href="{{ $entity->relativePortfolio['prev']->url }}">
                <h3 class="{{ isset($entity->relativePortfolio['prev']->variables->text_color) ? 'text-' . $entity->relativePortfolio['prev']->variables->text_color : null }}">
                    <span class="title">{{ __('Previous Project') }}</span>
                    <span class="text">
                            {{ $entity->relativePortfolio['prev']->title }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.213 476.213" fill="{{ $entity->relativePortfolio['prev']->variables->text_color ?? '#03363d' }}">
                                <polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 345.606,368.713 476.213,238.106 "/>
                            </svg>
                        </span>
                </h3>
            </a>
        @endif
    </div>
    <div class="next">
        @if($entity->relativePortfolio['next'])
            <div class="bg" style="background: {{ $entity->relativePortfolio['next']->variables->heading_color }}">
                <img src="{{ $entity->relativePortfolio['next']->thumbnail }}" alt="{{ $entity->relativePortfolio['next']->title }}">
            </div>
            <a href="{{ $entity->relativePortfolio['next']->url }}">
                <h3 class="{{ isset($entity->relativePortfolio['next']->variables->text_color) ? 'text-' . $entity->relativePortfolio['next']->variables->text_color : null }}">
                    <span class="title">{{ __('Next Project') }}</span>
                    <span class="text">
                            {{ $entity->relativePortfolio['next']->title }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.213 476.213" fill="{{ $entity->relativePortfolio['next']->variables->text_color ?? '#03363d' }}">
                                <polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 345.606,368.713 476.213,238.106 "/>
                            </svg>
                        </span>
                </h3>
            </a>
        @endif
    </div>
</div>