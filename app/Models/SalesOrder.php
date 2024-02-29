<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
class SalesOrder extends Model
{
    use HasFactory;
    protected $table = "sales_order";
    protected $fillable = [
        'idDocumento','razonsocialReceptor', 'rutReceptor','centroCosto','cuentaContable','detalle'
    ];
    protected function detail(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('America/Santiago')->format('d-m-Y H:i');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('America/Santiago')->format('d-m-Y H:i');
    }
}
