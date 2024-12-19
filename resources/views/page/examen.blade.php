<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/custom.css')
    <title>San Martín de Porres - Exámenes</title>
    <style>
        .bg-pattern {
            background-color: #f0f9ff;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239bd6ff' fill-opacity='0.2'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .radio-button {
            appearance: none;
            width: 1.5em;
            height: 1.5em;
            border: 2px solid #4f46e5;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .radio-button:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px white inset;
        }

        .option-container:hover {
            background-color: #f3f4ff;
            transform: translateX(8px);
        }
    </style>
</head>

<body class="bg-pattern">
    @include('page.barrasuperior')
    @include('page.navbar')

    <div class="mt-48 container mx-auto p-4 mb-32">
        <div class="mb-8 bg-white rounded-2xl shadow-lg p-6 border-4 border-indigo-200 transform hover:scale-102 transition-all duration-300">
            <label for="exam-select" class="flex items-center gap-2 text-xl font-bold text-indigo-600 mb-3">
                <span class="text-2xl">📝</span> 
                ¡Elige tu examen!
            </label>
            <select id="exam-select" 
                    class="mt-1 w-full py-3 px-4 text-lg border-2 border-indigo-200 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-300">
                <option value="">✨ Selecciona un examen...</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}">
                        📚 {{ $exam->title }} - {{ $exam->lesson->period->grade }}° Grado, {{ $exam->lesson->period->trimester }} Trimestre
                    </option>
                @endforeach
            </select>
        </div>

        <div class="my-10">
            <div id="exam-content" class="hidden">
                <div class="text-center mb-8">
                    <h1 id="exam-title" class="text-3xl font-bold text-indigo-700 mb-2"></h1>
                    <p id="exam-period" class="text-xl text-indigo-500"></p>
                </div>

                <div class="mb-8 bg-white rounded-xl shadow-lg p-6 border-2 border-indigo-100">
                    <label for="student-name" class="flex items-center gap-2 text-lg font-semibold text-indigo-600 mb-2">
                        <span class="text-xl">👤</span>
                        Tu nombre:
                    </label>
                    <input type="text" id="student-name" 
                           class="w-full py-3 px-4 text-lg border-2 border-indigo-200 bg-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-300"
                           placeholder="Escribe tu nombre aquí...">
                </div>

                <div id="questions-container" class="space-y-8"></div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8">
                    <div id="score-container" class="text-xl font-bold text-indigo-600 bg-indigo-50 px-6 py-3 rounded-xl"></div>
                    <button id="submit-exam" class="hidden bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-xl text-lg font-semibold shadow-lg hover:scale-105 transition-all duration-300  items-center gap-2">
                        <span>✨</span>
                        Enviar Examen
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('page.footer')

    <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    document.getElementById('exam-select').addEventListener('change', function() {
        const examId = this.value;
        if (!examId) {
            document.getElementById('exam-content').classList.add('hidden');
            return;
        }

        const questionsContainer = document.getElementById('questions-container');
        questionsContainer.innerHTML = `
            <div class="text-center p-8">
                <div class="inline-block animate-bounce">
                    <span class="text-4xl">🚀</span>
                    <p class="text-lg text-indigo-600 font-medium mt-2">Cargando tu examen...</p>
                </div>
            </div>
        `;

        fetch(`/examen/${examId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const examContent = document.getElementById('exam-content');
            const examTitle = document.getElementById('exam-title');
            const submitButton = document.getElementById('submit-exam');
            const scoreContainer = document.getElementById('score-container');

            examTitle.textContent = `${data.title} 📚`;

            questionsContainer.innerHTML = data.questions.map((question, index) => `
                <div class="bg-white p-6 rounded-xl shadow-lg border-2 border-indigo-100 hover:shadow-xl transition-all duration-300">
                    <p class="text-xl font-semibold text-indigo-700 mb-4 flex items-start gap-3">
                        <span class="bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">
                            ${index + 1}
                        </span>
                        ${question.question}
                    </p>
                    <div class="space-y-3 mt-6 pl-4">
                        ${Object.keys(question.options[0]).map(key => `
                            <label class="flex items-center p-3 rounded-lg option-container transition-all duration-300 cursor-pointer">
                                <input type="radio" name="question_${question.id}" value="${question.options[0][key]}"
                                       class="radio-button">
                                <span class="ml-3 text-lg">${question.options[0][key]}</span>
                            </label>
                        `).join('')}
                    </div>
                </div>
            `).join('');

            submitButton.classList.remove('hidden');
            examContent.classList.remove('hidden');

            submitButton.addEventListener('click', function() {
                const studentName = document.getElementById('student-name').value.trim();
                if (!studentName) {
                    alert('Por favor ingresa tu nombre para continuar.');
                    return;
                }

                const answers = data.questions.reduce((acc, question) => {
                    const selectedOption = document.querySelector(`input[name="question_${question.id}"]:checked`);
                    if (selectedOption) {
                        acc.push({
                            question_id: question.id,
                            answer: selectedOption.value,
                            correct: selectedOption.value === question.correct_answer
                        });
                    }
                    return acc;
                }, []);

                const score = answers.filter(answer => answer.correct).length;
                scoreContainer.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">🎯</span>
                        Puntuación: ${score} de ${data.questions.length}
                    </div>
                `;

                const APP_URL = process.env.BASE_URL;
                fetch(`${APP_URL}/guardar-resultados`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        exam_id: examId,
                        student: studentName,
                        score: score
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert('¡Examen enviado con éxito! 🎉');
                })
                .catch(error => {
                    console.error('Error al enviar el examen:', error);
                    alert('😢 Hubo un error al enviar el examen. Por favor, inténtalo de nuevo.');
                });

                // Marcar las respuestas
                answers.forEach(answer => {
                    const radioContainer = document.querySelector(`input[name="question_${answer.question_id}"][value="${answer.answer}"]`)
                        .closest('.option-container');
                    
                    if (answer.correct) {
                        radioContainer.classList.add('bg-green-50');
                        radioContainer.innerHTML += '<span class="ml-2 text-green-500">✓</span>';
                    } else {
                        radioContainer.classList.add('bg-red-50');
                        radioContainer.innerHTML += '<span class="ml-2 text-red-500">✗</span>';
                    }
                });
            });
        })
        .catch(error => {
            console.error('Error:', error);
            questionsContainer.innerHTML = `
                <div class="text-center p-8">
                    <span class="text-4xl">😢</span>
                    <p class="text-red-500 mt-2">¡Ups! Algo salió mal al cargar el examen</p>
                </div>
            `;
        });
    });
    </script>
</body>
</html>