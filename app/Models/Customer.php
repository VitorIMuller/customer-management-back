<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cellphone',
        'status',
        'zipcode',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'country',
    ];
}
