<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;


/**
 * @extends ModelResource<Lesson>
 */
class LessonResource extends ModelResource
{
    protected string $model = Lesson::class;

    protected string $title = 'Lessons';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([

                ID::make()->sortable(),

                Text::make('Título', 'title')->required(),

                // Relación 'BelongsTo' para seleccionar el Periodo (ID)
                BelongsTo::make('Periodo ID', 'period', 'id')
                    ->searchable()  // Para permitir la búsqueda de periodos
                    ->required(),

                // Campos adicionales (grado y semestre) basados en la relación 'period'
                Text::make('Grado', 'period.grade')
                    ->readonly()   // Campo de solo lectura
                    ->hideOnForm(), // Se oculta en el formulario

                Text::make('Semestre', 'period.trimester')
                    ->readonly()   // Campo de solo lectura
                    ->hideOnForm(), // Se oculta en el formulario
            ]),
        ];
    }

    /**
     * @param Lesson $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
