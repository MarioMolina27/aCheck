<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Optimiza la administración escolar con nuestra plataforma de gestión de base de datos para colegios. Simplifica el seguimiento de estudiantes, profesores y personal, gestiona horarios, calificaciones y asistencias de manera eficiente. Descubre cómo nuestra solución integral puede ayudarte a organizar y mejorar la gestión educativa en tu colegio.">
    <title>@yield('title')</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand p4-5" href="/autoavaluacio_MarioMolina/public/">
                <img src="{{ asset('img/logo.png') }}" alt="" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::check())
                        @if (Auth::user()->tipusUsuari->tipus == 'Administrador')
                            <li class="nav-item dropdown text-center">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div>
                                        <img src="{{ asset('img/book.svg') }}" alt="" height="25">
                                    </div>
                                    Dades mestres
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Tipus usuaris</a></li>
                                    <li><a class="dropdown-item"
                                            href="/autoavaluacio_MarioMolina/public/usuaris">Usuaris</a></li>
                                    <li><a class="dropdown-item" href="#">Cicles</a></li>
                                    <li><a class="dropdown-item" href="#">Moduls</a></li>
                                    <li><a class="dropdown-item" href="#">Assignar Profesors</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Asignar Alumnes</a></li>
                                    <li><a class="dropdown-item" href="#">Resultats Aprenentatge</a></li>
                                    <li><a class="dropdown-item" href="#">Criteris avaluació</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->tipusUsuari->tipus == 'Professor')
                            <li class="nav-item dropdown text-center">
                                <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div>
                                        <img src="{{ asset('img/person.svg') }}" alt="" height="25">
                                    </div>
                                    Profesors
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Asignar Alumnes</a></li>
                                    <li><a class="dropdown-item" href="#">Resultats aprenentatge</a></li>
                                    <li><a class="dropdown-item" href="#">Criteris avaluació</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/autoavaluacio_MarioMolina/public/professors/avaluacio">Autoavaluació alumnes</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->tipusUsuari->tipus == 'Alumne')
                            <li class="nav-item dropdown text-center">
                                <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div>
                                        <img src="{{ asset('img/student.svg') }}" alt="" height="25">
                                    </div>
                                    Alumnes
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/autoavaluacio_MarioMolina/public/alumnes/autoavaluacio">Autoavaluació</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>
                <div class="d-flex me-3">
                    @if (Auth::check())
                        <div class="dropdown dropdown-menu-end">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>

                                    <a href="{{ url('/logout') }}" class="dropdown-item"><i
                                            class="fa-solid fa-door-open"></i> Logout</a>

                                </li>
                            </ul>
                        </div>
                    @else
                        <a class="mb-0 color-avatar text-decoration-none text-white fw-bold"
                            href="{{ url('/login') }}"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</a
                            @endif
                </div>
            </div>
        </div>
    </nav>

    <main id="app">
        @yield('content')
    </main>

</body>

</html>
