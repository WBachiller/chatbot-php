<?php


namespace App\Models;


use CodeIgniter\Model;

class Inventario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'inventario';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'id',
        'codigo',
        'name',
        'quantity',
        'precio'
    ];





}