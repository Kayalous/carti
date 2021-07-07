<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CrudTrait;
    use HasRoles;


    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withTimestamps();
    }


    public function paymentIntent()
    {
        return $this->hasOne(PaymentIntent::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Product::class, 'purchases')->withPivot(['qty', 'price', 'payment_method', 'cashier_id', 'transaction_id'])->withTimestamps();
    }

    public function cashierSales()
    {
        return $this->belongsToMany(Product::class, 'purchases', 'cashier_id')->withPivot(['qty', 'price', 'payment_method', 'cashier_id', 'transaction_id'])->withTimestamps();
    }

    public function inventory()
    {
        return $this->hasMany(Product::class, 'merchant_id');
    }


    /**
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        // You can add any of the gravatar supported options to this array.
        // See https://gravatar.com/site/implement/images/
        $config = [
            'default' => $this->defaultProfilePhotoUrl(),
            'size' => '200' // use 200px by 200px image
        ];

        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?' . http_build_query($config);
    }

    /**
     * @return string
     */
    public function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/' . implode('/', [

                //IMPORTANT: Do not change this order
                urlencode($this->name), // name
                200, // image size
                '91F2E1', // background color
                '14b8a6', // font color
            ]);
    }

    //Product to update attach record, data from multiple carts.
    private function getProductsForAttach($carts, $method, $cashier_id, $uuid)
    {
        $items = [];

        foreach ($carts as $cart) {
            foreach ($cart->products as $product) {
                $items[$product->id] =
                    [
                        'qty' => $product->pivot->qty,
                        'price' => $product->price,
                        'payment_method' => $method,
                        'cashier_id' => $cashier_id,
                        'transaction_id' => $uuid
                    ];
            }
        }

        return $items;
    }


    public function completePurchase($method = 'stripe', $cashier_id = null)
    {

        $uuid = \Illuminate\Support\Str::uuid();

        //Add items to user's purchase history
        $this->purchases()->attach($this->getProductsForAttach($this->carts, $method, $cashier_id, $uuid));

        //Zero user's carts
        Cart::zeroCarts($this->carts);

        //De-sync all carts from user
        //Not sure if I should do this or not
//        $user->carts()->sync([]);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected
        $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected
        $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected
        $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected
        $appends = [
        'profile_photo_url',
    ];


}
