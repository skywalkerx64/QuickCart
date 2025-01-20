<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public const PLACED_STATUS = 'placed';
    public const IN_PROCESS_STATUS = 'in_process';
    public const DELIVERED_STATUS = 'delivered';

    public const STATUSES = [
        self::PLACED_STATUS,
        self::IN_PROCESS_STATUS,
        self::DELIVERED_STATUS
    ];

    protected $table = 'orders';

    protected $fillable = [
        'reference',
        'customer_id',
        'total',
        'tax',
        'status',
    ];

    protected $with = ['customer', 'details.product'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('panel.datetime_format'));
    }
}
