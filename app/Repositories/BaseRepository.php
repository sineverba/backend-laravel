<?php


namespace App\Repositories;

use App\Traits\Paginate;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class BaseRepository extends Model
{
    use HasFactory;
    use Paginate;
    use Sort;

    /**
     * Store new data
     * @throws \Exception
     */
    public function store($payload)
    {
        $this->create($payload);
        return true;
    }

    /**
     * Show single model
     * @param int $id
     */
    public function show(int $id)
    {
        return $this->findOrFail($id);
    }
}
