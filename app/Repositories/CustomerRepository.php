<?php


namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function all()
    {
        return Customer::where('active', 1)
            ->with('user')
            ->orderBy('name', 'desc')
            ->get()
            ->map
            ->format();

        /*        return Customer::where('active', 1)
                    ->with('user')
                    ->orderBy('name', 'desc')
                    ->get()
                    ->map(function ($customer) {
                        return $customer->format($customer);
                    });*/
    }

    public function findById($customerId)
    {
        return Customer::where('id', $customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail()
            ->format();
       // return $this->format($customer);
    }

    public function findByUsername()
    {
        return Customer::where()->get();
    }

    public function update($customerId){
       $customer =  Customer::where('id',$customerId)->firstOrFail();

        $customer->update(request()->only('name'));
    }

    public function delete($customerId){
        $customer =  Customer::where('id',$customerId)->firstOrFail();
        $customer->delete();
    }

    /*    protected function format($customer)
        {
            return [
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'created_by' => $customer->user->email,
                'last_updated' => $customer->updated_at->diffForHumans()
            ];
        }*/

}
