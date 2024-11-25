<footer class="bg-customBlue mb-52">
    <div class="w-full p-4">
        <div class="sm:flex sm:items-center sm:justify-between">
            <!-- Contenedor para el logo y texto -->
            <a href="" class="p-2 flex items-center">
                <img class="h-16 mr-2" src="{{ asset('img/logo.png') }}" alt="Logo" />
                <div class="flex flex-col">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap ml-3 text-white">SAN MARTÍN</span>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap -ml-3 text-white">DE PORRES</span>
                </div>
            </a>
            <!-- Menú de navegación -->
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white">
                <li>
                    <a href="{ url('/') }}" class="hover:underline me-4 md:me-6">Inicio</a>
                </li>
                <li>
                    <a href="{{ url('/#nosotros') }}" class="hover:underline me-4 md:me-6">Nosotros</a>
                </li>
                <li>
                    <a href="{{ url('/#gestion') }}" class="hover:underline me-4 md:me-6">Gestión</a>
                </li>
            </ul>
        </div>
        <!-- Línea divisoria y texto de derechos reservados -->
        <hr class="border-white sm:mx-auto my-4" />
        <span class="block text-sm text-white sm:text-center">All Rights Reserved © 2024</span>
    </div>
</footer>
