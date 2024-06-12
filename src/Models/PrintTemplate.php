<?php

namespace Cpkm\Print\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintTemplate extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

    protected $fillable = [
        'type',
        'name',
        'code',
        'content',
    ];

    protected $casts = [
    ];

    public static $audit = [
        'only' => [
            'type',
            'name',
            'code',
            'content',
        ],
    ];

    public $detail = [
        'id',
        'type',
        'name',
        'code',
        'content',
    ];
}
