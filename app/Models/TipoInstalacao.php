<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInstalacao extends Model
{
    use HasFactory;

    protected $table = 'tipo_instalacao';

    protected $fillable = ['id', 'tipo'];

    public function buscarTodos()
    {
        return $this->all();
    }
}
