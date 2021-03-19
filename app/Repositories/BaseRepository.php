<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Model
{
    use HasFactory;

    public function index()
    {
        return $this->get();
    }
}
