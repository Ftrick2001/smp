<!-- resources/views/page/lessons.blade.php -->
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
    <style>
        .bg-pattern {
            background-color: #f0f9ff;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239bd6ff' fill-opacity='0.2'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .select-fun {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234f46e5'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        @media (max-width: 640px) {
            .mobile-text-adjust {
                font-size: 90%;
                line-height: 1.4;
            }
        }
    </style>
</head>

<body class="bg-pattern">
    @include('page.barrasuperior')
    @include('page.navbar')

    <div class="mt-48 sm:mt-48 container mx-auto p-3 sm:p-4 sm:mb-32">
        <div class="mb-6 sm:mb-8 bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 border-2 sm:border-4 border-indigo-200 transform hover:scale-102 transition-all duration-300">
            <label for="period-select" class="flex items-center gap-2 text-lg sm:text-xl font-bold text-indigo-600 mb-2 sm:mb-3">
                <span class="text-xl sm:text-2xl">📚</span> 
                ¡Elige tu aventura de aprendizaje!
            </label>
            <select id="period-select" 
                    class="select-fun mt-1 w-full py-2 sm:py-3 px-3 sm:px-4 text-base sm:text-lg border-2 border-indigo-200 bg-white rounded-lg sm:rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-300">
                <option value="">✨ Selecciona tu grado y periodo...</option>
                @foreach($periods as $period)
                    <option value="{{ $period->id }}">
                        🎯 {{ $period->grade }}° Grado - {{ $period->trimester }} Trimestre
                    </option>
                @endforeach
            </select>
        </div>

        <div class="my-6 sm:my-10">
            <div id="lessons-content" class="hidden">
                <h1 id="period-title" class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-indigo-700 text-center animate-fade-in"></h1>
                <div id="lessons-container" class="space-y-6 sm:space-y-8">
                    <!-- Contenido dinámico -->
                </div>
            </div>
        </div>
    </div>

    @include('page.footer')

    <script>
        document.getElementById('period-select').addEventListener('change', function() {
            const periodId = this.value;
            if (!periodId) {
                document.getElementById('lessons-content').classList.add('hidden');
                return;
            }

            const lessonsContainer = document.getElementById('lessons-container');
            lessonsContainer.innerHTML = `
                <div class="text-center p-6 sm:p-8">
                    <div class="inline-block animate-bounce">
                        <span class="text-3xl sm:text-4xl">🚀</span>
                        <p class="text-base sm:text-lg text-indigo-600 font-medium mt-2">Cargando tu aventura...</p>
                    </div>
                </div>
            `;

            fetch(`/leccion/${periodId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const lessonsContent = document.getElementById('lessons-content');
                const periodTitle = document.getElementById('period-title');

                periodTitle.textContent = `🌟 ${data.grade}° Grado - ${data.trimester} Trimestre 🌟`;
                
                lessonsContainer.innerHTML = data.lessons.map((lesson, index) => `
                    <div class="bg-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg border-2 border-indigo-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-indigo-600 flex items-center gap-2">
                            <span class="text-xl sm:text-2xl">📖</span>
                            ${lesson.title}
                        </h3>
                        <div class="space-y-4 sm:space-y-6">
                            ${lesson.subtopics.map(subtopic => `
                                <div class="bg-indigo-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border-l-4 sm:border-l-8 border-indigo-400">
                                    <strong class="flex items-center gap-2 text-lg sm:text-xl mb-2 sm:mb-3 text-indigo-700">
                                        <span class="text-lg sm:text-xl">✨</span>
                                        ${subtopic.subtitle}
                                    </strong>
                                    <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-3 sm:mb-4 mobile-text-adjust">${subtopic.content}</p>
                                    ${subtopic.thumbnail ? `
                                        <div class="my-3 sm:my-4">
                                            <img src="/storage/${subtopic.thumbnail}" 
                                                 alt="${subtopic.subtitle}" 
                                                 class="rounded-lg shadow-md w-full sm:w-auto h-auto max-w-full sm:max-w-xs mx-auto hover:scale-105 transition-transform duration-300">
                                        </div>
                                    ` : ''}
                                    ${subtopic.example ? `
                                        <div class="mt-3 sm:mt-4 bg-white rounded-lg p-3 sm:p-4 border-2 border-indigo-200">
                                            <p class="font-bold text-indigo-600 mb-2 flex items-center gap-2">
                                                <span class="text-lg sm:text-xl">🎯</span>
                                                Ejemplo:
                                            </p>
                                            <p class="text-gray-700 text-base mobile-text-adjust">${subtopic.example}</p>
                                        </div>
                                    ` : ''}
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `).join('');

                lessonsContent.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                lessonsContainer.innerHTML = `
                    <div class="text-center p-6 sm:p-8">
                        <span class="text-3xl sm:text-4xl">😢</span>
                        <p class="text-red-500 mt-2">¡Ups! Algo salió mal al cargar las lecciones</p>
                    </div>
                `;
            });
        });
    </script>
</body>
</html>