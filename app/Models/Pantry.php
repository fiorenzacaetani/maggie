<?php
// ============================================================
// app/Models/Pantry.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pantry extends Model
{
    protected $table = 'pantry';
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
     * Estimates days remaining before exhaustion, based on the average daily consumption.
     */
    public function estimatedDaysRemaining(): ?float
    {
        if ($this->avg_consumption_daily <= 0) {
            return null;
        }

        return round($this->current_quantity_base / $this->avg_consumption_daily, 1);
    }

    /**
     * Returns true if the quantity is below the minimum threshold.
     */
    public function isBelowThreshold(): bool
    {
        return $this->current_quantity_base <= $this->min_threshold_base;
    }
}
