<?php

namespace App\Model\SingleSignOn;

use App\Scopes\OwnershipScope;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $table = "tb_marketplace_bengkel";

    protected $primaryKey = 'id_bengkel';

    protected $fillable = [
        'nama_bengkel',
        'id_jenis_bengkel',
        'alamat_bengkel',
        'longitude',
        'latitude',
        'slug',
        'nohp_bengkel',
        'logo_bengkel',
        'jam_buka_bengkel',
        'jam_tutup_bengkel',
        'id_kabupaten',
        'id_desa'
    ];

    public $timestamps = false;

    public function JenisBengkel(){
        return $this->belongsTo(JenisBengkel::class,'id_jenis_bengkel','id_jenis_bengkel');
    }


    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
