<header style="background: rgba(0, 0, 0, .85)" class="site-header sticky-top py-1">
    <nav style="width: 65%" class="container d-flex flex-column flex-md-row justify-content-between">

        @if(strlen($_SERVER['REQUEST_URI']) > 17)
            <a style="color: #8e8e8e" class="py-2" href="{{route('home')}}" aria-label="Product">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
            </a>
        @else
            <p style="color: #8e8e8e" class="py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
            </p>
        @endif


        @foreach($headerMenu as $link)
                <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="{{@route($link->link)}}">{{$link->translate(@app()->getLocale())->title}}</a>
        @endforeach
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Tour</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Product</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Features</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Enterprise</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Support</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Pricing</a>--}}
{{--        <a style="color: #8e8e8e" class="py-2 d-none d-md-inline-block" href="#">Cart</a>--}}

        @foreach(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
         @if($localeCode !== @app()->getLocale())
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            @endif


        @endforeach

    </nav>
</header>
