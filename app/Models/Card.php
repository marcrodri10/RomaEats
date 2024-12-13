<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function findOrCreateCard($data)
    {
        $realUserCard = self::where('card_number', $data['card_number'])->first();

        if ($realUserCard !== null) {
            if ($realUserCard->user_id !== Auth::user()->id) {
                throw new \Exception('Tarjeta ya en uso');
            }
            if (!Hash::check($data['cvv'], $realUserCard->cvv)) {
                throw new \Exception('CVV incorrecto');
            }
            if ($data['save_card']) {
                $realUserCard->save_card = 1;
                $realUserCard->save();
            }

            return $realUserCard->card_id;
        } else {
            $data['cvv'] = Hash::make($data['cvv']); // Hashear el CVV antes de guardar
            $card = self::create($data);
            return $card->card_id;
        }
    }

    public static function getUserSavedCards($userId)
    {
        return self::where('user_id', $userId)
            ->where('save_card', 1)
            ->get();
    }
}
