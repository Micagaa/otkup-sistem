<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SerijaPrerade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'otkup_id',
        'faza',
        'status_kvaliteta',
        'napomena_kvaliteta',
        'datum_pocetka',
        'datum_zavrsetka',
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
            'otkup_id' => 'integer',
            'datum_pocetka' => 'date',
            'datum_zavrsetka' => 'date',
        ];
    }

    public function otkup(): BelongsTo
    {
        return $this->belongsTo(Otkup::class);
    }
    
    public function isQualityApproved(): bool
    {
        return $this->status_kvaliteta === 'ispravno';
    }

    public function isQualityRejected(): bool
    {
        return $this->status_kvaliteta === 'neispravno';
    }
}
