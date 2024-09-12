<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Order;
use App\Models\Skill;


class Customer extends Model
{
    protected $uploadedFile;
    private $name;
    private $email;
    private $_storage = 'public/customers.json';

    public function __construct(/* Request $request, $disk = 'local'*/)
    {
    /*    $this->uploadedFile = $request->file('avatar');
        $this->name = $request->input('name');
        $this->email = $request->input('email');
        $this->disk = $disk;*/
    }

    public function orders(): HasMany
    {
        return $this->hasMany( Order::class );
    }

    public function fullname(): string
    {
        return trim( $this->firstname . ' ' . $this->lastname );
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany( Skill::class );
    }

    public function skillsList()
    {
        return $this->skills->implode( 'name', ', ' );
    }

    public function store()
    {
        $this->storeImage();

        $user = [
            'name'  => $this->name,
            'email'  => $this->email,
        ];

        Storage::disk( $this->disk )->put( $this->_storage, json_encode( $user ));
//        return parent::save( $options );
    }

    protected function storeImage()
    {
        Storage::disk( $this->disk )->put(
            $this->uploadedFile->getClientOriginalName(),
            file_get_contents($this->uploadedFile->getRealPath())
        );
    }
}
