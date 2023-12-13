<?php

namespace Noman\Easycrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EasycrudForm extends Model
{
    use HasFactory;
    protected $filable=[
        'name',
        'label',
        'model',
        'datatable',
        'styles',
        'url',
        'classes',
        'before_code',
        'after_code',
        'validation',
        'insert_message',
        'update_message',
        'delete_message',
    ];
}
