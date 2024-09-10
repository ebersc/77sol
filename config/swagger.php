<?php

return [

    'paths' => [
        'docs' => base_path('public/docs'),  // Diretório para armazenar o arquivo de documentação gerado
        'docs_json' => 'api/documentation.json', // URL para acessar a documentação JSON
        'swagger_ui' => 'api/documentation', // URL para o Swagger UI
        'annotations' => [
            base_path('app'),    // Diretório onde suas anotações OpenAPI estão localizadas
            base_path('routes'), // Inclui o diretório de rotas
        ],
    ],

    'swagger' => [
        'title' => env('SWAGGER_TITLE', 'API Documentation'),
        'version' => env('SWAGGER_VERSION', '1.0.0'),
        'description' => env('SWAGGER_DESCRIPTION', 'API Documentation'),
    ],
];
