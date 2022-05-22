<?php

namespace App\Controllers;

use App\Models\Addres;
use Core\BaseController;

class AddresesController extends BaseController
{
    private Addres $addresses;

    public function __construct()
    {
        $this->addresses = new Addres();
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
        $this->view(
            'addresses/add'
        );
    }

    public function save()
    {
        if($this->addresses->insertData($_POST))
            header('Location: ' . URL . 'addresses');
    }

    public function edit($id)
    {
        $address = $this->addresses->getOne(['id' => $id]);

        $this->view(
            'addresses/edit', compact('address')
        );
    }

    public function update($id)
    {
        $this->addresses->updateData(
            $_POST, ['id' => $id]
        );
        header('Location: ' . URL . 'addresses');

    }

    public function delete($id)
    {
        $this->addresses->deleteData(['id' => $id]);
        header('Location: ' . URL . 'addresses');
    }
}