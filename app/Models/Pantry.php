<?php
// ============================================================
// app/Models/Pantry.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pantry extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'current_quantity_base',
        'min_threshold_base',
        'avg_consumption_daily',
        'last_restock_date',
    ];

    protected $casts = [
        'last_restock_date' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Stima i giorni rimanenti prima dell'esaurimento,
     * basandosi sul consumo medio giornaliero.
     */
    public function estimatedDaysRemaining(): ?float
    {
        if ($this->avg_consumption_daily <= 0) {
            return null;
        }

        return round($this->current_quantity_base / $this->avg_consumption_daily, 1);
    }

    /**
     * Restituisce true se la quantità è sotto la soglia minima.
     */
    public function isBelowThreshold(): bool
    {
        return $this->current_quantity_base <= $this->min_threshold_base;
    }
}
