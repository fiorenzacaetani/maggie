<?php
// ============================================================
// app/Models/SupermarketLayout.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupermarketLayout extends Model
{
    /** name of the fallback default retailer */
    const DEFAULT_RETAILER = '__default__';

    protected $fillable = [
        'retailer_name',
        'category_id',
        'aisle_order',
    ];

    protected $casts = [
        'aisle_order' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // -------------------------------------------------------
    // Relations
    // -------------------------------------------------------

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // -------------------------------------------------------
    // Scope
    // -------------------------------------------------------

    /** Filter for a specific retailer. */
    public function scopeForRetailer(Builder $query, string $retailer): Builder
    {
        return $query->where('retailer_name', $retailer);
    }

    /** Retrieve only the default layout. */
    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('retailer_name', self::DEFAULT_RETAILER);
    }

    // -------------------------------------------------------
    // Static helpers
    // -------------------------------------------------------

    /**
     * Returns the aisle_order for a category relative to a retailer,
     * applying the fallback logic:
     *   1. child-specific layout
     *   2. parent-specific layout
     *   3. child-default layout
     *   4. parent-default layout
     *   5. PHP_INT_MAX (at the end)
     */
    public static function resolveOrder(int $categoryId, string $retailer): int
    {
        $category = Category::with('parent')->find($categoryId);
        if (! $category) {
            return PHP_INT_MAX;
        }

        $parentId = $category->parent_id;

        // Take all the relevant records in a single query
        $rows = self::query()
            ->whereIn('retailer_name', [$retailer, self::DEFAULT_RETAILER])
            ->whereIn('category_id', array_filter([$categoryId, $parentId]))
            ->get()
            ->groupBy('retailer_name');

        $specific = $rows->get($retailer, collect());
        $default  = $rows->get(self::DEFAULT_RETAILER, collect());

        // Priority 1 — child-specific layout
        //
        if ($row = $specific->firstWhere('category_id', $categoryId)) {
            return $row->aisle_order;
        }
        // Priority 2 — parent-specific layout
        if ($parentId && $row = $specific->firstWhere('category_id', $parentId)) {
            return $row->aisle_order;
        }
        // Priority 3 — child-default layout
        if ($row = $default->firstWhere('category_id', $categoryId)) {
            return $row->aisle_order;
        }
        // Priority 4 — parent-default layout
        if ($parentId && $row = $default->firstWhere('category_id', $parentId)) {
            return $row->aisle_order;
        }

        return PHP_INT_MAX;
    }

    /** Returns true if this record belongs to the default layout. */
    public function isDefault(): bool
    {
        return $this->retailer_name === self::DEFAULT_RETAILER;
    }
}
