<?php


namespace App\Repositories;

use App\Traits\Paginate;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Model
{
    use HasFactory;
    use Paginate;
    use Sort;
}
