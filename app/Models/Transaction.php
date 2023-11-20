<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionStatusEnum;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded  = [];
    protected $appends = ['is_inclusive','status','total_amount'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => TransactionStatusEnum::class,
    ];

    public function customer(){
        return $this->belongsTo(User::class,'payer');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function getTotalAmountAttribute(){
        if($this->is_vat_inclusive)
            return $this->amount;
        else{
            $vat_amount = ($this->vat *  $this->amount)/100;
            return $vat_amount + $this->amount;
        }

    }

    public function getIsInclusiveAttribute(){
        if($this->is_vat_inclusive)
            return 'yes';
        else 
            return 'no';
    }

    public function getStatusAttribute(){
        if($this->payments()->sum('amount') == $this->amount && $this->due_on > date('Y-m-d'))
            return TransactionStatusEnum::Paid;
        else if($this->payments()->sum('amount') < $this->amount && $this->due_on > date('Y-m-d'))
            return TransactionStatusEnum::Outstanding;
        else
            return TransactionStatusEnum::Overdue;
    }

    public function canPay(){
        return $this->status == TransactionStatusEnum::Outstanding;
    }
}
