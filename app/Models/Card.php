<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'card_id';

    protected $table = 'cards';
    protected $fillable = [
        'user_id',
        'card_number',
        'card_name',
        'cvv',
        'validation_date',
        'save_card',
    ];
}
