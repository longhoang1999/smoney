<?php

namespace App\Repositories;

use App\Models\Hanghoa;
use InfyOm\Generator\Common\BaseRepository;

class HanghoaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Hanghoa::class;
    }
}
