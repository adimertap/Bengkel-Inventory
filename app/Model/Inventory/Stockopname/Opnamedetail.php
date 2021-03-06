<?php

namespace App\Model\Inventory\Stockopname;

use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Rak;
use App\Model\Inventory\Sparepart;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opnamedetail extends Model
{
    use SoftDeletes;

    protected $table = "tb_inventory_detopname";

    protected $primaryKey = 'id_detail_opname';

    protected $fillable = [
        'id_opname',
        'id_detail_sparepart',
        'jumlah_real',
        'selisih',
        'keterangan_detail'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    public function Opname()
    {
        return $this->belongsTo(Opname::class, 'id_opname','id_opname');
    }

    public function Sparepart()
    {
        return $this->belongsTo(DetailSparepart::class, 'id_detail_sparepart','id_detail_sparepart');
    }

}
