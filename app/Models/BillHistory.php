<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id', 'by_user', 'from_status', 'to_status', 'note', 'at_datetime'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'by_user');
    }
}
