<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Result;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;
use MoonShine\Fields\Relationships\BelongsTo;



/**
 * @extends ModelResource<Result>
 */
class ResultResource extends ModelResource
{
    protected string $model = Result::class;

    protected string $title = 'Results';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Estudiante', 'student')
                    ->showOnExport(),
                Text::make('Nota', 'score')
                    ->showOnExport(),
                // Relación 'BelongsTo' para seleccionar el Periodo (ID)
                BelongsTo::make('Examen', 'exam', 'title')
                    ->searchable()  // Para permitir la búsqueda de periodos
                    ->required()
                    ->showOnExport(),
                ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

}
