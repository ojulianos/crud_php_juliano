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
        if($all_customer) {
            foreach($all_customer as $customer) {
                $customers[] = [
                    'user' => $customer,
                    'addresses' => $this->address->getData(['where' => ['customer_id' => $customer->id]])
                ];
            }
        }

        $total = $this->customers->getCount();
        $this->view(
            'customers/index', compact('customers', 'total')
        );
    }

    public function add()
    {
        $js = 'js/customer.js';
        $this->view(
            'customers/add', compact('js')
        );
    }

    public function save()
    {
        if($customer = $this->customers->insertData($_POST)){
            for($i = 0; $i < count($_POST['description']); $i++) {
                $this->address->insertData([
                    'customer_id' => $customer,
                    'description' => $_POST['description'][$i],
                    'address' => $_POST['address'][$i],
                    'country' => $_POST['country'][$i],
                    'state' => $_POST['state'][$i],
                    'city' => $_POST['city'][$i],
                    'zipcode' => $_POST['zipcode'][$i]
                ]);
            }
            header('Location: ' . URL . 'customers');
        }
    }

    public function edit($id)
    {
        if($customer = $this->customers->getOne(['id' => $id])) {
            $js = 'js/customer.js';
            $this->view(
                'customers/edit', compact('customer', 'js')
            );
        }
        header('Location: ' . URL . 'customers');
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
        if($customer = $this->customers->getOne(['id' => $id])) {
            // Find all addresses of this customer
            $addresses = $this->address->getData(['where' => ['customer_id' => $customer->id]]);
            foreach($addresses as $address) {
                // Delete all addresses of this customer
                $this->address->deleteData(['id' => $address->id]);
            }
            // Delete customer
            $this->customers->deleteData(['id' => $id]);
            header('Location: ' . URL . 'customers');
        }
        header('Location: ' . URL . 'customers');
    }
}