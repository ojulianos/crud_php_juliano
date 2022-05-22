<?php

namespace App\Controllers;

use App\Models\Addres;
use App\Models\Customer;
use Core\BaseController;


class CustomersController extends BaseController
{
    private Customer $customers;
    private Addres $address;

    public function __construct()
    {
        $this->customers = new Customer();
        $this->address = new Addres();
    }

    public function index()
    {
        $all_customer = $this->customers->getData();
        $customers = [];
        foreach($all_customer as $customer) {
            $customers[] = [
                'user' => $customer,
                'addresses' => $this->address->getData(['where' => ['customer_id' => $customer->id]])
            ];
        }

        $total = $this->customers->getCount();
        $this->view(
            'customers/index', compact('customers', 'total')
        );
    }

    public function add()
    {
        $this->view(
            'customers/add'
        );
    }

    public function save()
    {
        if($this->customers->insertData($_POST))
            header('Location: ' . URL . 'customers');
    }

    public function edit($id)
    {
        $customer = $this->customers->getOne(['id' => $id]);
        $this->view(
            'customers/edit', compact('customer')
        );
    }

    public function update($id)
    {
        $this->customers->updateData(
            $_POST, ['id' => $id]
        );

        header('Location: ' . URL . 'customers');
    }

    public function delete($id)
    {
        $this->customers->deleteData(['id' => $id]);
        header('Location: ' . URL . 'customers');
    }
}