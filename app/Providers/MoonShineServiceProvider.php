<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Period;
use App\MoonShine\Resources\ExamResource;
use App\MoonShine\Resources\LessonResource;
use App\MoonShine\Resources\PeriodResource;
use App\MoonShine\Resources\QuestionResource;
use App\MoonShine\Resources\ResultResource;
use App\MoonShine\Resources\SubtopicResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

/**
 * Define el menú de navegación para la interfaz de administración.
 *
 * Este método retorna un arreglo que configura los elementos del menú, incluyendo grupos de menús
 * y elementos individuales. Los grupos de menús permiten organizar los elementos relacionados bajo
 * un encabezado común, mientras que los elementos individuales pueden incluir enlaces externos y
 * recursos asociados a diferentes funcionalidades del sistema.
 *
 * @return Closure|array<MenuElement> Retorna un arreglo de elementos de menú. Los elementos del menú
 *                                      pueden ser instancias de `MenuGroup` o `MenuItem`. El retorno también
 *                                      puede ser una función anónima (`Closure`) que genera el menú dinámicamente.
 */
protected function menu(): array
{
    return [
        // Crea un grupo de menús con un título traducido
        MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
            // Elemento de menú para gestionar administradores
            MenuItem::make(
                static fn() => __('moonshine::ui.resource.admins_title'),
                new MoonShineUserResource() // Recurso asociado para la gestión de usuarios
            ),
            // Elemento de menú para gestionar roles
            MenuItem::make(
                static fn() => __('moonshine::ui.resource.role_title'),
                new MoonShineUserRoleResource() // Recurso asociado para la gestión de roles
            ),
        ]),

        MenuItem::make('Periodos', new PeriodResource)->icon('heroicons.user-group'),

        MenuGroup::make('Aprendizaje', [
            MenuItem::make('Leccion', new LessonResource())->icon('heroicons.book-open'),
            MenuItem::make('Temas', new SubtopicResource())->icon('heroicons.document-plus'),
        ])->icon('heroicons.folder'),

        MenuGroup::make('Evaluación', [
            // Subgrupo de Exámenes
            MenuGroup::make('Gestión de Exámenes', [
                MenuItem::make('Lista de Exámenes', new ExamResource())
                    ->icon('heroicons.outline.clipboard-document-list'),
                MenuItem::make('Banco de Preguntas', new QuestionResource())
                    ->icon('heroicons.outline.document-check'),
            ])->icon('heroicons.outline.academic-cap'),
            MenuItem::make('Calificaciones', new ResultResource)->icon('heroicons.user-group')->icon('heroicons.academic-cap'),

        ])
        ->icon('heroicons.pencil-square'), // Icono principal del grupo

    ];
}

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [
            'colors' => [
                'primary' => 'rgb(186, 81, 51)',          // Rojo cálido
                'secondary' => 'rgb(97, 66, 38)',         // Marrón oscuro profundo
                'body' => 'rgb(97, 66, 38))',           // Marrón claro y suave para el fondo
        
                // Paleta de tonos oscuros (dark)
                'dark' => [
                    'DEFAULT' => 'rgb(208, 204, 204)',     // Gris claro
                    50 => 'rgb(135, 115, 101)',            // Gris cálido
                    100 => 'rgb(120, 102, 88)',            
                    200 => 'rgb(105, 89, 76)',            
                    300 => 'rgb(90, 76, 65)',              
                    400 => 'rgb(77, 65, 55)',             
                    500 => 'rgb(67, 56, 47)',             
                    600 => 'rgb(55, 45, 38)',              
                    700 => 'rgb(45, 37, 31)',              
                    800 => 'rgb(51, 33, 28)',              
                    900 => 'rgb(35, 23, 19)',              
                ],
        
                // Colores de notificación
                'success-bg' => 'rgb(141, 124, 98)',      // Marrón claro para fondo de éxito
                'success-text' => 'rgb(255, 255, 255)',   // Texto blanco
                'warning-bg' => 'rgb(204, 153, 102)',     // Beige cálido
                'warning-text' => 'rgb(87, 58, 38)',      // Marrón oscuro para mayor visibilidad
                'error-bg' => 'rgb(153, 51, 51)',         // Marrón rojizo
                'error-text' => 'rgb(255, 255, 255)',     // Texto blanco
                'info-bg' => 'rgb(97, 66, 38)',           // Marrón oscuro para fondo de información
                'info-text' => 'rgb(255, 255, 255)',      // Texto blanco
            ],
            'darkColors' => [
                'body' => 'rgb(51, 33, 28)',              // Marrón oscuro como fondo
                'success-bg' => 'rgb(62, 52, 42)',        // Marrón medio para mayor contraste
                'success-text' => 'rgb(225, 208, 186)',   // Beige claro para texto
                'warning-bg' => 'rgb(97, 66, 38)',        // Marrón medio
                'warning-text' => 'rgb(255, 229, 204)',   // Beige claro para mayor visibilidad
                'error-bg' => 'rgb(102, 38, 38)',         // Marrón rojizo oscuro
                'error-text' => 'rgb(255, 195, 195)',     // Rosa claro para contraste
                'info-bg' => 'rgb(51, 33, 28)',           // Marrón oscuro para fondo de info
                'info-text' => 'rgb(224, 204, 192)',      // Beige claro para texto
            ]
        ];
        
    }
}
