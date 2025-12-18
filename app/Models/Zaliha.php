<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Zaliha extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serija_prerade_id',
        'vrsta_proizvoda',
        'kolicina_kg',
        'rok_upotrebe',
        'pozicija',
        'datum_prijema',
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
            'serija_prerade_id' => 'integer',
            'kolicina_kg' => 'decimal:2',
            'rok_upotrebe' => 'date',
            'datum_prijema' => 'date',
        ];
    }

    public function serijaPrerade(): BelongsTo
    {
        return $this->belongsTo(SerijaPrerade::class);
    }
}
