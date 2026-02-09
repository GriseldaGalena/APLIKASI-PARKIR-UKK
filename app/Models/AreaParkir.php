<?php

namespace App\Models;

use App\Http\Controllers\TarifParkirController;
use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $guarded = [];
    protected $table = "area_parkirs";

    public function tarifs()
{
    return $this->hasMany(Tarif::class);
}

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_area', 'id_area');
    }


}

