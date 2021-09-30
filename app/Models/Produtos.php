<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "vision";

    protected $primaryKey = "produtoId";

    protected $fillable = [
        'produtoNome',
        'brand'

    ];

}
