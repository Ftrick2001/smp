<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subtopic;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;


/**
 * @extends ModelResource<Subtopic>
 */
class SubtopicResource extends ModelResource
{
    protected string $model = Subtopic::class;

    protected string $title = 'Temas';


    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Leccion', 'lesson', 'title')
                    ->searchable()
                    ->required(),
                Text::make('Subtitulo', 'subtitle'),
                Text::make('Contenido', 'content'),
                Image::make('Imagen','thumbnail')
                    ->disk('public')
                    ->dir('subtopics'),
                Text::make('Ejemplo', 'example'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
