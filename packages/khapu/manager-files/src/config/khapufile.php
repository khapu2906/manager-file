<?php

return [
    'storage' => [
        'url' => '',
        'forder_name' => '',
        'use_auth' => false,
        'action' => [
            'open'      => true,
            'read'      => true,
            'create'    => true,
            'update'    => true,
            'delete'    => true,
            'upload'    => true,
            'download'  => true,    
            'rename'    => true, 
        ],
        'max_memory_capacity'  => 512000, // size in KB
        'setting_file' => [
            'img' => [
                'name' => 'image',
                'max_size' => 50000, // size in KB
                'end' => [
                    'png', 'jpg', 'jpeg', 'raw', 'pdf', 'gif', 'eps', 'ai', 'psd',
                ], 
            ],
            'text' => [
                'name' => 'text',
                'max_size' => 50000, // size in KB
                'end' => [
                    'txt', 'doc', 'docx', 'xlsx',
                ],
            ],
            'sound' => [
                'name' => 'sound',
                'max_size' => 50000, // size in KB
                'end' => [
                    'mp3', 'wma', 'wav', 'flac', 'aac', 'lossless',
                ],
            ],
            'video' => [
                'name' => 'video',
                'max_size' => 100000, // size in KB
                'end' => [
                    'mp4', 'avi'
                ]
            ]
        ],
       
    ],
    'cloud' => [

    ],
];