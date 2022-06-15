<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\ScopeFilter;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Language;
use App\Traits\ScopeCategoryFilter;

class Htag extends Model
{

    use HasFactory, ScopeCategoryFilter;

    protected $fillable = [
        'value',
        'key',
    ];

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ],
            'description' => [
                'hasParam' => true,
                'scopeMethod' => 'description'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'slug' => [
                'hasParam' => true,
                'scopeMethod' => 'slug'
            ],

        ];
    }



    public function setValueAttribute($value)
    {


        $this->attributes['value'] = json_encode($value);
    }

    public function getValueAttribute($value)
    {


        return json_decode($value);
    }

}
