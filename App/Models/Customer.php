<?php

namespace App\Models;

use Core\BaseModel;

class Customer extends BaseModel {
    protected string $table = 'customers';
    protected string $id = 'id';
    protected array $fields = ['name', 'phone', 'birth_date', 'email'];
    protected string $order_by = 'id DESC';
}