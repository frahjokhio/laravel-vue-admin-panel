<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormElements extends Model
{
	use SoftDeletes;
    protected $table = 'formelements';
    protected $fillable = ['textfield', 'selectfiled', 'textarea', 'filefield'];
}
