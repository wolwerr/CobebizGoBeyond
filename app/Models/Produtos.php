<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $table = "vision";

    public $timestamps = false;

    protected $primaryKey = "produtoId";

    protected $fillable = [
        'produtoNome',
        'brand'

    ];

}
