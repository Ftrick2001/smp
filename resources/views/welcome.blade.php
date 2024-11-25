<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/custom.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>San Martín de Porres</title>
</head>

    @include('page.header')
    @section('slogan')
        @include('page.slogan')
    @endsection

    <div id="nosotros" class="container-presetation flex justify-center items-center min-h-screen p-4">
        <div class="text-center">
                <h3 class="font-bold text-2xl md:text-3xl tracking-wider pt-8 md:pt-12">Bienvenidos a la</h3>
                <h1 class="font-extrabold text-3xl md:text-4xl mt-8 md:mt-12">I.E. N° 30215</h1>
                <h1 class="font-extrabold text-4xl md:text-5xl mb-8 md:mb-12">San Martín de Porres</h1>
                <p class="text-base md:text-lg w-full md:w-1/2 mx-auto fade-in-text px-4">
                    La Institución Educativa N° 30215 - San Martín de Porres, ubicada en El Tambo,
                    ha sido un pilar en la comunidad, destacándose por su compromiso con la educación
                    inclusiva y de calidad. A lo largo de los años, ha evolucionado para incorporar
                    enfoques pedagógicos modernos, centrados en competencias y en la formación integral
                    de sus estudiantes. Con un equipo de docentes innovadores y comprometidos, la institución
                    se ha posicionado como un referente en la región, promoviendo valores esenciales que
                    preparan a sus alumnos para enfrentar los desafíos de un mundo en constante cambio.
                </p>
        </div>
    </div>

    <div class="bg-neutral-50 pb-8 md:pb-12">
        <!-- Misión -->
        <div class="flex flex-col justify-center items-center px-4">
            <div>
                <h3 class="text-2xl md:text-3xl font-bold mt-12 md:mt-16">Nuestra Misión</h3>
            </div>

            <div class="flex flex-col md:flex-row items-center m-0">
                <div class="w-full md:w-1/2 py-6 md:py-10">
                    <p class="text-base md:text-lg text-center md:text-right md:ml-20 px-4">
                        Somos una institución educativa inclusiva, con docentes innovadores y actualizados
                        en la pedagogía moderna, bajo el enfoque por competencias. Formamos integralmente
                        a niños y niñas inclusivos, competentes y con prácticas de valores, capaces de enfrentar
                        retos y desafíos de la sociedad con asertividad y autonomía.
                    </p>
                </div>
                <div class="w-full md:w-1/2 flex justify-center items-center">
                    <img class="w-72 h-60 md:w-96 md:h-80" src="{{ asset('img/prueba.jpg') }}" alt="Logo" />
                </div>
            </div>
        </div>

        <!-- Visión -->
        <div class="flex flex-col justify-center items-center mt-8 md:mt-12 px-4">
            <div>
                <h3 class="text-2xl md:text-3xl font-bold mb-8 md:mb-12">Nuestra Visión</h3>
            </div>

            <div class="flex flex-col-reverse md:flex-row items-center">
                <div class="w-full md:w-1/2 flex justify-center items-center">
                    <img class="w-72 h-60 md:w-96 md:h-80" src="{{ asset('img/prueba.jpg') }}" alt="Logo" />
                </div>
                <div class="w-full md:w-1/2 py-6 md:py-10">
                    <p class="text-base md:text-lg text-center md:text-left md:mr-20 px-4">
                        Al 2024, seremos una institución educativa inclusiva reconocida por su servicio educativo
                        centrado en la calidad de los aprendizajes. Buscamos formar integralmente a nuestros
                        estudiantes, brindándoles una educación competitiva, alineada con los avances científicos
                        y tecnológicos, basada en valores morales, éticos y religiosos. Nuestros alumnos serán reflexivos,
                        críticos, innovadores e investigadores, capacitados para enfrentar los retos de un mundo globalizado
                        y contribuir al desarrollo productivo del país, en particular de nuestra querida Cullpa Baja.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-values pb-12 md:pb-20 px-4">
        <div class="flex flex-col justify-center items-center text-center">
            <div>
                <h3 class="text-2xl md:text-3xl font-bold mt-12 md:mt-16 mb-12 md:mb-16">Nuestros Valores</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 md:gap-x-24 md:gap-y-9">
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Libertad y Responsabilidad" />
                    <h5 class="mt-4">Libertad y Responsabilidad</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Equidad y Justicia" />
                    <h5 class="mt-4">Equidad y Justicia</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Solidaridad y Justicia Ambiental" />
                    <h5 class="mt-4">Solidaridad y Justicia Ambiental</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Igualdad y Dignidad" />
                    <h5 class="mt-4">Igualdad y Dignidad</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Respeto a la Identidad Cultural" />
                    <h5 class="mt-4">Respeto a la Identidad Cultural</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Empatía" />
                    <h5 class="mt-4">Empatía</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Superación Personal" />
                    <h5 class="mt-4">Superación Personal</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Conciencia de Derechos" />
                    <h5 class="mt-4">Conciencia de Derechos</h5>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <img class="w-32 h-32 md:w-44 md:h-44 rounded-full" src="{{ asset('img/prueba.jpg') }}" alt="Respeto por las Diferencias" />
                    <h5 class="mt-4">Respeto por las Diferencias</h5>
                </div>
            </div>
        </div>
    </div>

    <div id="gestion" class="bg-neutral-50 flex flex-col justify-center items-center h-auto px-4">
            <div class="text-center">
                <h3 class="text-2xl md:text-3xl font-bold mt-12 md:mt-16">¿Como se gestiona la I.E. N° 30215 ?</h3>
            </div>

            <div class="flex justify-center items-center my-8 md:my-12 pb-8 md:pb-11">
                <img class="h-64 md:h-96" src="{{ asset('img/mapa.png') }}" alt="Logo" />
            </div>
    </div>

    @include('page.footer')

</body>
</html>