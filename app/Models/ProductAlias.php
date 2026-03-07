<?php
// ============================================================
// app/Models/ProductAlias.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAlias extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id', 'alias_name'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
