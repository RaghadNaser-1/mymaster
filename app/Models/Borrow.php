<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;


class Borrow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'estimated_end_time',
        'returned',
    ];
    protected $dates = ['borrowed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function isEligibleForRenewal()
{
    // Check any conditions for renewal eligibility, e.g., maximum renewal limit
    return $this->renewals < config('library.max_renewals');
}

public function renew()
{
    // Check if the borrow is eligible for renewal
    if ($this->isEligibleForRenewal()) {
        // Calculate the new estimated_end_time and update the borrow's estimated_end_time
        $newEstimatedEndTime = $this->estimated_end_time->addWeek();
        $this->estimated_end_time = $newEstimatedEndTime;
        $this->renewals += 1;
        $this->save();

        return true; // Renewal successful
    }

    return false; // Renewal failed
}

}
