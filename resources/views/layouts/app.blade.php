<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flags.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bg.css') }}" rel="stylesheet">
    @auth
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @endauth
</head>

<body>
    <video autoplay muted loop id="bgVideo">
        <source src="{{ asset('video/bg.mp4') }}" type="video/mp4">
    </video>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Center -->
                    <ul class="navbar-nav mx-auto d-none d-md-block pl-4">
                        <img src="https://www.peluqueria-mjm.ga/wp-content/uploads/2020/05/cropped-logo.png"
                            alt="logoCompany" width="auto" height="30">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user mr-2"></i>{{ Auth::user()->display_name }} <span
                                    class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-danger" id="logout" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('auth.logout') }}
                                </a>

                                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <li class="nav-item dropdown">
                            @inject('localization', 'App\Http\Controllers\Locale\LocalizationController')

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @switch(session()->get('locale'))
                                @case('ca')
                                <span class="flag flag-catalonia"></span>
                                @break
                                @case('en')
                                <span class="flag flag-us"></span>
                                @break
                                @default
                                <span class="flag flag-es"></span>
                                @endswitch
                                <span class="ml-1">{{ $localization::getLang(session()->get('locale')) }}
                                </span>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @foreach ($localization::allLang() as $lang)
                                @if ($lang != Config::get('app.locale'))
                                <a class="dropdown-item" href="{{route('localization', $lang)}}">
                                    @switch($lang)
                                    @case('ca')
                                    <span class="flag flag-catalonia"></span>
                                    @break
                                    @case('en')
                                    <span class="flag flag-us"></span>
                                    @break
                                    @default
                                    <span class="flag flag-es"></span>
                                    @endswitch
                                    <span class="ml-1">{{ $localization::getLang($lang) }}</span>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="{{ asset("js/pace.min.js") }}"></script>
    <script src="{{ asset('js/capslock.js') }}"></script>
    <script src="{{ asset("js/input.js") }}"></script>

    <!-- Scripts (Only if you are logged in) -->
    @auth
    <script src="{{ asset('js/jquery-ajax-native.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--
        ############################################################################################################################################

        Este codigo JS no se puede poner en un archivo externo!!!!!!, no hay que tocarlo!!!!

        Porque??

            - Porque este codigo tiene interaccion directa con el servidor, y depeniendo de que circunsancias este la pagina configurada
            en el servidor, el codigo JS cambia automaticamente, es decir, es un codigo JS dinamico.

            - Esto nos ayuda a tener un codigo muy manntenible ya que no hay que tocar nada de este JS siempre funccionara,
            un ejemplo:
                - El nombre del domino o las rutas, se generar dinamicamente desde PHP y se incetan a JS
                - Tener muchisimos idiomas, y que este codigo se adapte automaticamente, y las linias nunca se iran incrmentando, siempre sera el mismo
                de otra manera, tendriamos que hacer un IF o SWITCH gigantesco, inmantinible, y por cada idioma, traducir el modulo que queremos,
                y por cada modulo, generar muchismia redundancia.

                De esta manera como esta hecha toda la WEB, todos los elementos y textos HTML no estan puesto dentro del mismo es decir, todos
                los textos de la WEB, estan parametrizados.

        ############################################################################################################################################
    !-->
    <script>
        $(function () {
            localStorage.setItem('user', "{{ Auth::user()->user_login }}");
            localStorage.setItem('lang', "{{ $localization::getLang(session()->get('locale')) }}");

            $('[data-filter-type="date-range"]').daterangepicker({
                ranges: {
                    "{{ __('calendar.today') }}": [moment(), moment()],
                    "{{ __('calendar.yesterday') }}": [moment().subtract(1, 'days'), moment().subtract(
                        1, 'days')],
                    "{{ __('calendar.thisweek') }}": [moment().startOf('week'), moment().endOf('week')],
                    "{{ __('calendar.lastweek') }}": [moment().subtract(6, 'days'), moment()],
                    "{{ __('calendar.last2weeks') }}": [moment().subtract(13, 'days'), moment()],
                    "{{ __('calendar.thismonth') }}": [moment().startOf('month'), moment().endOf(
                        'month')],
                    "{{ __('calendar.lastmonth') }}": [moment().subtract(1, 'month').startOf('month'),
                        moment().subtract(1, 'month').endOf('month')
                    ]
                },
                autoUpdateInput: true,
                applyClass: 'btn-sm btn-primary',
                cancelClass: 'btn-sm btn-default',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: "{{ __('calendar.apply') }}",
                    cancelLabel: "{{ __('calendar.cancel') }}",
                    fromLabel: "{{ __('calendar.from') }}",
                    toLabel: "{{ __('calendar.to') }}",
                    customRangeLabel: "{{ __('calendar.customRange') }}",
                    daysOfWeek: JSON.parse("{{ json_encode(__('calendar.daysofweek')) }}".replace(
                        /&quot;/g, '"')),
                    monthNames: JSON.parse("{{ json_encode(__('calendar.monthnames')) }}".replace(
                        /&quot;/g, '"')),
                    firstDay: 1,
                }
            });

            $('#btnGenerateReport').click(function () {
                let startDate = $('[data-filter-type="date-range"]').data('daterangepicker').startDate
                    .format('YYYY-MM-DD');
                let endDate = $('[data-filter-type="date-range"]').data('daterangepicker').endDate
                    .format('YYYY-MM-DD');

                $(document).ajaxStart(function () {
                    Pace.restart();
                });

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('bookings') }}",
                    data: {
                        initial_date: startDate,
                        final_date: endDate
                    },
                    success: function (response) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            method: 'POST',
                            dataType: 'native',
                            url: "{{ route('reportGenerator') }}",
                            xhrFields: {
                                responseType: 'blob'
                            },
                            data: {
                                customers: response
                            },
                            success: function (blob) {
                                let link = document.createElement('a');
                                link.href = window.URL.createObjectURL(blob);
                                link.download = "Report_" + moment(new Date())
                                    .format("DD_MM_YYYY") + ".pdf";
                                link.click();
                            }
                        });
                    },
                    complete: function (xhr) {
                        switch (xhr.status) {
                            case 200:
                                $("#messageInfo").fadeOut(50);
                                $("#messageError").fadeOut(50);
                                $("#messageOkey").fadeIn(500);
                                break;
                            case 404:
                                $("#messageOkey").fadeOut(50);
                                $("#messageError").fadeOut(50);
                                $("#messageInfo").fadeIn(500);
                                break;
                            case 500:
                                $("#messageOkey").fadeOut(50);
                                $("#messageInfo").fadeOut(50);
                                $("#messageError").fadeIn(500);
                                break;
                        }
                    }
                });
            });
        });

        $("#logout").click(function (e) {
            e.preventDefault();
            localStorage.clear();
            $("#logout-form").submit();
        });

    </script>

    @endauth
</body>

</html>
