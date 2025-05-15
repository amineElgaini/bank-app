<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'branch_id',
        'salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // An employee belongs to a user
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class); // An employee belongs to a branch
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'performed_by');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'performed_by');
    }
}
