<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryHasEvent extends Model
{
    use HasFactory;

    protected $table = 'category_has_event';


    public function __construct()
    {
        $this->setFillable();
    }
    public function setFillable()
    {
        $fields = Schema::getColumnListing('category_has_event');

        $this->fillable[] = $fields;
    }

}
