<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Period;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Period>
 */
class PeriodResource extends ModelResource
{
    protected string $model = Period::class;

    protected string $title = 'Periodos';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Grado','grade'),
                Text::make('Trimestre','trimester'),
            ]),
        ];
    }

    /**
     * @param Period $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'grade' => ['required', 'string', 'in:1,2,3,4,5,6'], // Restringe a los valores permitidos
            'trimester' => ['required', 'string', 'in:1,2,3'], // Restringe a los valores permitidos
        ];
    }
}
