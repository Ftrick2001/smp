<?php

use MoonShine\Exceptions\MoonShineNotFoundException;
use MoonShine\Forms\LoginForm;
use MoonShine\Http\Middleware\Authenticate;
use MoonShine\Http\Middleware\SecurityHeadersMiddleware;
use MoonShine\Models\MoonshineUser;
use MoonShine\MoonShineLayout;
use MoonShine\Pages\ProfilePage;

return [
    // Directorio donde se encuentran los archivos de configuración y recursos de MoonShine
    'dir' => 'app/MoonShine',

    // Espacio de nombres base para los recursos de MoonShine
    'namespace' => 'App\MoonShine',

    // Título de la interfaz de administración
    'title' => env('MOONSHINE_TITLE', 'San Martin de Porres'),

    // Logo que se mostrará en la interfaz de administración
    'logo' => env('MOONSHINE_LOGO', '/img/logo.png'),

    // Logo pequeño para la interfaz de administración
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),

    // Configuración de rutas
    'route' => [
        // Dominio base para las rutas de administración
        'domain' => env('MOONSHINE_URL', ''),

        // Prefijo de ruta para acceder a la administración
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),

        // Prefijo para las rutas de páginas individuales
        'single_page_prefix' => 'page',

        // Nombre de la ruta de índice
        'index' => 'moonshine.index',

        // Middleware aplicado a las rutas de administración
        'middlewares' => [
            SecurityHeadersMiddleware::class,
        ],

        // Manejador de errores 404 personalizado
        'notFoundHandler' => MoonShineNotFoundException::class,
    ],

    // Configuración para el uso de migraciones
    'use_migrations' => true,

    // Configuración para el uso de notificaciones
    'use_notifications' => true,

    // Configuración para el uso de un conmutador de temas
    'use_theme_switcher' => true,

    // Clase de diseño para la interfaz de administración
    'layout' => MoonShineLayout::class,

    // Disco por defecto para almacenamiento de archivos
    'disk' => 'public',

    // Opciones adicionales para el disco
    'disk_options' => [
        'visibility' => 'public', // o 'private'
    ],


    // Configuración de caché
    'cache' => 'file',

    // Configuración de activos (JavaScript y CSS)
    'assets' => [
        'js' => [
            // Atributos para las etiquetas <script> de JavaScript
            'script_attributes' => [
                'defer',
            ]
        ],
        'css' => [
            // Atributos para las etiquetas <link> de CSS
            'link_attributes' => [
                'rel' => 'stylesheet',
            ]
        ]
    ],

    // Configuración de formularios
    'forms' => [
        // Clase del formulario de inicio de sesión
        'login' => LoginForm::class
    ],

    // Configuración de páginas personalizadas
    'pages' => [
        // Página de inicio del panel de administración
        'dashboard' => App\MoonShine\Pages\Dashboard::class,

        // Página de perfil del usuario
        'profile' => ProfilePage::class
    ],

    // Configuración de recursos del modelo
    'model_resources' => [
        // Importación y exportación por defecto activadas para modelos
        'default_with_import' => true,
        'default_with_export' => true,
    ],

    // Configuración de autenticación
    'auth' => [
        // Habilitar autenticación
        'enable' => true,

        // Middleware de autenticación
        'middleware' => Authenticate::class,

        // Campos del formulario de autenticación
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ],

        // Guard de autenticación utilizado
        'guard' => 'moonshine',

        // Configuración de guardas de autenticación
        'guards' => [
            'moonshine' => [
                'driver' => 'session',
                'provider' => 'moonshine',
            ],
        ],

        // Configuración de proveedores de autenticación
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model' => MoonshineUser::class,
            ],
        ],

        // Tuberías (pipelines) personalizadas para autenticación (vacío en este caso)
        'pipelines' => [],
    ],

    // Configuración de locales (idiomas)
    'locales' => [
        'es',
        'en'
    ],

    // Configuración de búsqueda global (vacío en este caso)
    'global_search' => [
        //User::class
    ],

    // Configuración para el editor TinyMCE
    'tinymce' => [
        // Configuración del administrador de archivos para TinyMCE
        'file_manager' => false, // o 'laravel-filemanager' como prefijo para LFM

        // Token de autenticación para TinyMCE
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),

        // Versión de TinyMCE a usar
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'),
    ],

    // Configuración para Socialite (vacío en este caso)
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
];
