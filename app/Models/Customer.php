<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['full_name', 'email', 'phone', 'joined', 'orders', 'spent', 'status'];

    protected function casts(): array
    {
        return ['joined' => 'date', 'orders' => 'integer', 'spent' => 'decimal:2'];
    }
}
