@extends('layouts.main')

@section('content')

    <main>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">{{__('main.Punny headline')}}</h1>
                <h1 class="display-4 fw-normal">{{ $post->translate(\Illuminate\Support\Facades\App::getLocale())->title }}</h1>
                <p class="lead fw-normal">{{__('main.And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.')}}</p>
                <p class="lead fw-normal">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->content}}</p>
                <a class="btn btn-outline-secondary" href="#">Coming soon</a>
            </div>
            <div class="product-device shadow-sm d-none d-md-block"></div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>

        <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
            <div style="background: #1a202c; min-width: 49%" class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                <div class="my-3 p-3">
                    <h2 style="color: #a0aec0" class="display-5">Another headline</h2>
                    <p style="color: #a0aec0" class="lead">And an even wittier subheading.</p>
                </div>
                <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
            </div>
            <div style="background: #1a203c; min-width: 49%" class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                <div class="my-3 py-3">
                    <h2 style="color: #a0aec0" class="display-5">Another headline</h2>
                    <p style="color: #a0aec0" class="lead">And an even wittier subheading.</p>
                </div>
                <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
            </div>
        </div>
    </main>


@endsection
