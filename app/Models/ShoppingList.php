<?php
// ============================================================
// app/Models/ShoppingList.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingList extends Model
{
    protected $table = 'shopping_list';

    protected $fillable = [
        'product_id',
        'custom_name',
        'quantity',
        'unit_id',
        'source',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // -------------------------------------------------------
    // Relations
    // -------------------------------------------------------

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    // -------------------------------------------------------
    // Scope
    // -------------------------------------------------------

    /** Only items still to be bought. */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /** Only items already bought. */
    public function scopeBought(Builder $query): Builder
    {
        return $query->where('status', 'bought');
    }

    /** Only rows added manually (never touched by automatic jobs). */
    public function scopeManual(Builder $query): Builder
    {
        return $query->where('source', 'manual');
    }

    /** Only rows added automatically by the system. */
    public function scopeAuto(Builder $query): Builder
    {
        return $query->where('source', 'auto');
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    /**
     * Returns the display name:
     * uses custom_name if not associated with a product.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->product?->name ?? $this->custom_name ?? '—';
    }

    /** Returns true if the row was added manually. */
    public function isManual(): bool
    {
        return $this->source === 'manual';
    }

    /** Marks the item as bought. */
    public function markAsBought(): void
    {
        $this->update(['status' => 'bought']);
    }
}
