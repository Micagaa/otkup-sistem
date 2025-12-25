<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otkup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dobavljac_id',
        'vrsta_ploda',
        'kolicina_kg',
        'cena_po_kg',
        'datum_otkupa',
        'status_isplate',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'dobavljac_id' => 'integer',
            'kolicina_kg' => 'decimal:2',
            'cena_po_kg' => 'decimal:2',
            'datum_otkupa' => 'date',
        ];
    }

    public function dobavljac(): BelongsTo
    {
        return $this->belongsTo(Dobavljac::class);
    }

    public function getUkupnaVrednostAttribute(): float
    {
        return (float) $this->kolicina_kg * (float) $this->cena_po_kg;
    }
}
