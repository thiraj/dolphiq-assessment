<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany(CustomerPhone::class, 'customer_id');
    }

}
