<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Exam>
 */
class ExamResource extends ModelResource
{
    protected string $model = Exam::class;

    protected string $title = 'Exams';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),

                // Relación 'BelongsTo' para seleccionar el Periodo (ID)
                BelongsTo::make('Lesson ID', 'lesson', 'id')
                    ->searchable()  // Para permitir la búsqueda de periodos
                    ->required(),

                Text::make('Título', 'title')->required(),
                ]),
        ];
    }

    /**
     * @param Exam $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
