<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

    <link rel="stylesheet" href="{{ orca_asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/orca/ui/assets/css/ui.css') }}">

    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ orca_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
        <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
    @show

    @stack('css')

    {!! view_render_event('orca.site.layout.head') !!}

</head>


<body @if (core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

    {!! view_render_event('orca.site.layout.body.before') !!}

    <div id="app">
        <flash-wrapper ref='flashes'></flash-wrapper>

        <div class="main-container-wrapper">

            {!! view_render_event('orca.site.layout.header.before') !!}

            @include('site::layouts.header.index')

            {!! view_render_event('orca.site.layout.header.after') !!}

            @yield('slider')

            <div class="content-container">

                {!! view_render_event('orca.site.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('orca.site.layout.content.after') !!}

            </div>

        </div>

        {!! view_render_event('orca.site.layout.footer.before') !!}

        @include('site::layouts.footer.footer')

        {!! view_render_event('orca.site.layout.footer.after') !!}

        <div class="footer-bottom">
            <p>
                @if (core()->getConfigData('general.content.footer.footer_content'))
                    {{ core()->getConfigData('general.content.footer.footer_content') }}
                @else
                    {{ trans('admin::app.footer.copy-right') }}
                @endif
            </p>
        </div>

    </div>

    <script type="text/javascript">
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
        @elseif ($error = session('error'))
            window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }
            ];
        @elseif ($info = session('info'))
            window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }
            ];
        @endif

        window.serverErrors = [];
        @if(isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>

    <script type="text/javascript" src="{{ orca_asset('js/site.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/orca/ui/assets/js/ui.js') }}"></script>

    @stack('scripts')

    {!! view_render_event('orca.site.layout.body.after') !!}

    <div class="modal-overlay"></div>

</body>

</html>