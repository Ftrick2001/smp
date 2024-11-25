<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Json;




/**
 * @extends ModelResource<Question>
 */
class QuestionResource extends ModelResource
{
    protected string $model = Question::class;

    protected string $title = 'Questions';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                // Relación 'BelongsTo' para seleccionar el Periodo (ID)
                BelongsTo::make('Examen ID', 'exam', 'id')
                    ->searchable()  // Para permitir la búsqueda de periodos
                    ->required(),
                Text::make('Pregunta', 'question')
                    ->required(),
                Text::make('Tipo de pregunta', 'type')
                    ->required(),
                // Configuración JSON para manejar las opciones como campos individuales
                Json::make('Opciones', 'options')
                    ->fields([
                        Text::make('Opción 1')->required(),
                        Text::make('Opción 2')->required(),
                        Text::make('Opción 3')->required(),
                        Text::make('Opción 4')->nullable(),
                    ])
                    ->creatable()  // Permitir agregar nuevas opciones
                    ->removable(),  // Permitir eliminar opciones
                Text::make('Respuesta Correcta', 'correct_answer')
                    ->required(),
            ]),
        ];
    }

    /**
     * @param Question $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
