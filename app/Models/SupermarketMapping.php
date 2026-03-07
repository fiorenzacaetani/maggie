<?php
// ============================================================
// app/Models/SupermarketMapping.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupermarketMapping extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'retailer_name',
        'external_sku',
        'external_name',
        'external_unit',
        'external_price',
        'match_type',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mark the mapping as manually fixed (protects against AI overrides).
     */
    public function markAsManual(): void
    {
        $this->update(['match_type' => 'MANUAL']);
    }
}
