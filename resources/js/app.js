jQuery(document).ready(function($) {

    let header = $('#wrapper__header')
    let body = $('#wrapper__body')
    let hamburger = $('[aria-controls="navigation"]')
    let navigation = $('#navigation')
    let lang = $('#dropdownLangButton')
    let docNavbar = $('.navbar-expand')
    let licenseModal = $('#licenseModal')
    let asideButton = $('aside .arrow')

    $(function () {
        $('[data-toggle="tooltip"][data-type="danger"]').tooltip({ template: '<div class="tooltip danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
        // $('[data-toggle="tooltip"]').tooltip('show')
    })

    lang.on('click', function (e) {
        e.preventDefault()
        $(e.target).toggleClass('show')
        $(e.target).attr("aria-expanded", !!$(e.target).hasClass('show'))
        $('[aria-labelledby="' + e.target.id + '"]').toggleClass('show')
    })

    asideButton.on('click', function () {
        console.log(123)
        $(this).parent().toggleClass('open')
    })

    $('a').on('click', function (e) {
        if(this.hash && typeof this.dataset.toggle === "undefined") {
            e.preventDefault()
            $('html, body').animate({
                scrollTop: $('#' + this.hash.replace('#', '')).offset().top
            }, 'slow')
        }
        if(body.hasClass('page-8')) {
            docNavbar.find('li.active').removeClass('active')
            docNavbar.find('a[href="' + this.hash + '"]').parent().toggleClass('active')
        }
    })

    $('#nearest').on('click', function (e) {
        e.preventDefault()
        $('html, body').animate({scrollTop: $('#div_nearest').offset().top - 120}, 'slow')
    })

    let vh = window.innerHeight * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)
    window.addEventListener('resize', () => {
        let vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', `${vh}px`)
    })

    body.find('.banner .bg').addClass('show')

    $('.owl-carousel').each(function () {
        let attr = eval("(" + $(this).attr('data-carousel') + ")")
        if(attr.progress) {
            let time = attr.autoplayTimeout ? (attr.autoplayTimeout / 1000) - 1 : 4
            let $progressBar, $bar, $elem, isPause, tick, percentTime
            $(this).owlCarousel($.extend(attr, {onInitialized: callback, onTranslate: moved, onDrag: pauseOnDragging}))

            function callback(event){
                $elem = event.target
                buildProgressBar()
                start()
            }
            function buildProgressBar() {
                $progressBar = $('<div>', {id: 'progressBar'})
                $progressBar.addClass('progress')
                $bar = $('<div>', {id: 'bar'})
                $bar.addClass('progress-bar').attr('role', 'progressbar').attr('aria-valuenow', '0').attr('aria-valuemin', '0').attr('aria-valuemax', '100')
                $progressBar.append($bar).prependTo($elem)
            }
            function start() {
                percentTime = 0
                isPause = false
                tick = setInterval(interval, 10)
            }
            function interval() {
                if(isPause === false) {
                    percentTime += 1 / time
                    $bar.css({width: percentTime + '%'}).attr('aria-valuenow', percentTime)
                    if(percentTime >= 100) {
                        $(this).trigger('next.owl.carousel')
                    }
                }
            }
            function pauseOnDragging() {
                isPause = true
            }
            function moved() {
                clearTimeout(tick)
                start()
            }
            if(attr.autoplayHoverPause) {
                $(this).on('mouseover', function() {
                    isPause = true
                })
                $(this).on('mouseout', function() {
                    isPause = false
                })
            }
        } else {
            attr ? $(this).owlCarousel(attr) : $(this).owlCarousel()
        }
    })

    let scrollTrigger = 100,
        Scroll = function () {
            let scrollTop = $(window).scrollTop()
            scrollTop > scrollTrigger ? header.addClass('scrolling') : header.removeClass('scrolling')
        }
    Scroll()
    $(window).on('scroll', function () {
        Scroll()
        $('.dropdown-toggle[aria-expanded="true"]:not(#dropdownLangButton)').each(function () {
            $(this).dropdown('hide')
        })
        if(lang.hasClass('show')) {
            lang.removeClass('show')
            lang.attr("aria-expanded", false)
            $('[aria-labelledby="dropdownLangButton"]').removeClass('show')
        }
    })

    function scrollWidth () {
        let div = document.createElement('div');
        div.style.overflowY = 'scroll'
        div.style.width = '50px'
        div.style.height = '50px'
        document.body.append(div)
        let scrollWidth = div.offsetWidth - div.clientWidth
        div.remove()
        if(body.hasClass('open-menu')) {
            hamburger.css({'marginRight' : scrollWidth + 'px'})
            body.css({'paddingRight' : scrollWidth + 'px'})
            navigation.css({'paddingRight' : scrollWidth + 'px'})
        } else {
            hamburger.removeAttr('style')
            body.removeAttr('style')
            navigation.removeAttr('style')
        }
    }

    hamburger.on('click', function () {
        body.toggleClass('open-menu')
        scrollWidth()
        $(this).toggleClass('is-active')
        $(this).parent().find('#' + $(this).attr('aria-controls')).toggleClass('hide')
    })

    if(licenseModal) {
        $('#licenseModalSubmit').on('click', function(e){
            e.preventDefault();
            licenseModal.find('#inputName').next().addClass('hide')
            licenseModal.find('#inputName').next().text('')
            $.ajax({
                url: licenseModal.find('form')[0].action,
                method: licenseModal.find('form')[0].method,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: licenseModal.find('#inputName').val()
                },
                success: function(result) {
                    $('#licenseModal').modal('hide')
                    licenseModal.find('#inputName').val('')
                },
                error: function (error) {
                    if (error.status === 422) {
                        let data = error.responseJSON.errors
                        licenseModal.find('#inputName').next().text(data.name[0])
                        licenseModal.find('#inputName').next().removeClass('hide')
                    }
                }
            });
        });
    }

    setTimeout(function () {
        [].forEach.call(document.querySelectorAll('[data-notify="container"][role="alert"]'), function (item) {
            item.classList.add('show')
            setTimeout(function () {
                item.classList.remove('show')
            }, 4000)
        })
    }, 100)
});


