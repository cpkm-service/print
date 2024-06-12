<?php

return [
    'template'  =>  [
        'name'      =>  'template',
        'action'    =>  '',
        'back'      =>  '',
        'method'    =>  "POST",
        'title'     =>  '',
        'model'     =>  Cpkm\Print\Models\PrintTemplate::class,
        'service'   =>  Cpkm\Print\Services\Print\TemplateService::class,
        'form'      =>  [
            [
                'class' =>  'row',
                'col'   =>  [
                    [
                        'class' =>  'col-xl-12',
                        'col'   =>  [
                            [
                                'class' =>  'fields',
                                'field' =>  'content',
                            ]
                        ]
                    ],
                ]
            ],
        ],
        'fields'    =>  [
            'content'   =>  [
                'tag'           =>  'ckeditor-print',
                'name'          =>  'content',
                'text'          =>  'print::backend.print_templates.content',
                'placeholder'   =>  'print::backend.print_templates.content',
                'required'      =>  true,
                'rules' =>  [

                ],
                'api_rules' =>  [
                    'common'    =>  [
                        'required',
                        'string',
                    ],
                ]
            ],
        ],
    ]
];
