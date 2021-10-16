@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section" style="background: {!! $entity->variables->heading_color !!}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{{ $entity->title }}</h1>
                    <p class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{!! $entity->excerpt !!}</p>
                </div>
                <div class="col-6 d-md-block d-none">
                    <img src="{{ $entity->thumbnail }}" class="card-img-top" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="about section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-6 offset-0 col-lg-6 col-12">
                    <div class="heading">
                        <h2>Целевые страницы, которые приносят лиды</h2>
                        <p>Страница захвата лидов - это тип целевой страницы после клика, которая отличается оптимизированной формой захвата лидов. Эта форма позволяет вам собирать потенциальных клиентов для ваших предложений и продвигать их по вашей маркетинговой воронке.</p>
                        <ul>
                            @foreach(['web-design', 'iconography', 'frontend', 'backend', 'web'] as $service)
                                <li>
                                    <img src="{{ GoDesk::image('website/' . $service . '.png') }}" alt="{{$service}}">
                                    <p>{{ __(\Illuminate\Support\Str::title(\Illuminate\Support\Str::of($service)->replace('-', ' '))) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="image section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/lead1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/lead2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Мы GetCarrier - маркетплейс по перевозки автомобильного транспорта. Мы помогаем грузоотправителям получать мгновенные котировки и ставки на аукционах от перевозчиков и брокеров, пользующихся рейтингом клиентов. Нам были нужны разработчики высокого уровня, так как задачи были достаточно сложными. В итоге агентство SpaceCode отлично справилось с поставленными задачами, все детали были соблюдены, все выполнено на высшем уровне. Отдельное спасибо Владлену за инициативу. Рекомендую эту команду, они профессионалы своего дела.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Макс Антонов</p>
                            <small>Соучредитель GetCarrier</small>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="design section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2 class="h1">Дизайн система</h2>
                        <p>Иконография может помочь вам выделить ваш сайт среди конкурентов, а также персонализировать его и помочь пользователям правильно просматривать его.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/icons.png') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/get-carrier/colors.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="elements section-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Элементы</h2>
                        <p>Присутствует много элементов призыва к действию. Для анимации текста и других веб-элементов использовались различные библиотеки. Задача заключалась в том, чтобы сделать тяжелые многоступенчатые формы для заполнения лидов.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/header.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/faq.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/call-to-action.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/footer.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/slider.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Еще целевые страницы</h2>
                        <p>Мы разработали множество лендингов для крутых ребят из Украины. Они работают на рынке автомобильных перевозок США. Каждая целевая страница - это отдельный вид сервиса.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/get-carrier/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/get-carrier/2.png') }}" alt="">
                        <img class="get3" src="{{ GoDesk::image('portfolio/get-carrier/3.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/get-carrier/4.png') }}" alt="">
                        <img class="get5" src="{{ GoDesk::image('portfolio/get-carrier/5.png') }}" alt="">
                        <img class="get6" src="{{ GoDesk::image('portfolio/get-carrier/6.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('godesk-index::add.portfolio.relative')
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop