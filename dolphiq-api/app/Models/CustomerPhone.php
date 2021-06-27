<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerPhone
 * @package App\Models
 */
class CustomerPhone extends Model
{
    /**
     * @var string
     */
    protected $table = 'customer_phones';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
