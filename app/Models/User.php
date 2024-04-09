<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes,HasRoles;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
        'user_id',
        'referral_id',
        'referred_by',
        'isLogginAllowed',
        'isAdminVerified',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile() 
    {
        return $this->hasOne(UserProfile::class,'user_id','id');
    }
    public function address() 
    {
        return $this->hasOne(UserAddress::class,'user_id','id');
    }
    public function bank() 
    {
        return $this->hasOne(BankDetails::class,'user_id','id');
    }
    public function documents() 
    {
        return $this->hasMany(UserDocuments::class,'user_id','id');
    }
    public function profession() 
    {
        return $this->hasOne(Profession::class,'user_id','id');
    }
    public function social_links() 
    {
        return $this->hasMany(SocialLinks::class,'user_id','id');
    }
    public function business() 
    {
        return $this->hasMany(BusinessDetails::class,'user_id','id');
    }
    public function referral()
    {
        return $this->belongsTo(User::class, 'referred_by', 'referral_id');
    }
    public function hasCategory($category)
    {
        return $this->category === $category;
    }
    public function hasAnyCategory($categories)
    {
        return in_array($this->category, $categories);
    }
}
