<?php

namespace App\Controllers;

use App\Models\Addres;
use App\Models\Customer;
use Core\BaseController;

class AddresesController extends BaseController
{
    private Addres $addresses;
    private Customer $customers;

    public function __construct()
    {
        $this->addresses = new Addres();
        $this->customers = new Customer();
    }

    public function index()
    {
        $addresses = $this->addresses->getData();
        $total = $this->addresses->getCount();

        $this->view(
            'addresses/index', compact('addresses', 'total')
        );
    }

    public function add()
    {
        $customers = $this->customers->getData();

        $this->view(
            'addresses/add', compact('customers')
        );
    }

    public function save()
    {
        if($this->addresses->insertData($_POST))
            header('Location: ' . URL . 'addreses');
    }

    public function edit($id)
    {
        $customers = $this->customers->getData();
        $address = $this->addresses->getOne($id);

        $this->view(
            'addresses/edit', compact('address', 'customers')
        );
    }

    public function update($id)
    {
        $this->addresses->updateData(
            $_POST, ['id' => $id]
        );
        header('Location: ' . URL . 'addreses');

    }

    public function delete($id)
    {
        $this->addresses->deleteData(['id' => $id]);
        header('Location: ' . URL . 'addreses');
    }
}