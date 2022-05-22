<?php

namespace App\Models;

use Core\BaseModel;

class Addres extends BaseModel {
    protected string $table = 'addresses';
    protected string $id = 'id';
    protected array $fields = ['customer_id', 'description', 'address', 'country', 'state', 'city', 'zipcode'];
    protected string $order_by = 'id DESC';
}