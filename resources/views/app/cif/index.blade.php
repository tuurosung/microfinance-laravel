<?php

use Livewire\Component;
use \App\Models\Customer\Customer;

class CustomerList extends Component
{
    public string $sortBy = 'date';
    public string $sortDirection = 'desc';

    public function sortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function customers(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Customer::query()
            ->when($this->sortBy, fn($query) => $query->customerBy($this->sortBy, $this->sortDirection))
            ->paginate();
    }
}

?>

<x-layouts::app :title="__('Customer')">

    <div class="mx-auto max-w-7xl">

        <div class="mb-9 flex justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('Customers') }}</flux:heading>
                <flux:subheading size="lg">{{ __('Manage customers') }}</flux:subheading>
            </div>
            <div>
                <flux:button variant="primary" href="{{ route('cif.create')  }}" icon="user-plus" color="blue" class="border-0">{{ __('Add Customer') }}</flux:button>
            </div>
        </div>

        <flux:card class="shadow-md/5 border-1">

            <flux:table paginate="">
                <flux:table.columns class="">
                    <flux:table.column class="text-white">#</flux:table.column>
                    <flux:table.column class="text-white">Customer</flux:table.column>
                    <flux:table.column class="text-white">Email</flux:table.column>
                    <flux:table.column class="text-white">Phone</flux:table.column>
                    <flux:table.column class="text-white">Address</flux:table.column>
                    <flux:table.column class="text-white">Actions</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>

                </flux:table.rows>
            </flux:table>

        </flux:card>



    </div>


    <flux:modal name="edit-profile" class="md:w-120">
        <div class="space-y-6">

            <div>
                <flux:heading size="xl">Create New Customer</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col">
                    <flux:input name="firstname" label="Firstname" required />
                </div>
                <div class="col">
                    <flux:input name="othernames" label="Othernames" required />
                </div>
            </div>

            <flux:input type="email" name="email" label="Email" icon="envelope" required />

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <flux:input type="text" icon="phone" name="primary_phone" label="Primary Phone" />
                </div>
                <div>
                    <flux:input type="text" icon="phone" name="secondary_phone" label="Secondary Phone" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <flux:select icon="venus-mars" name="sex" label="Sex" placeholder="Select sex ...">
                        <flux:select.option value="male">Male</flux:select.option>
                        <flux:select.option value="female">Female</flux:select.option>
                    </flux:select>
                </div>
                <div>
                    <flux:input label="Date of birth" type="date" name="date_of_birth" />
                </div>
            </div>

            <flux:textarea name="address" label="Address" rows="2"/>


            <div class="flex">

                <flux:spacer />
                <flux:button variant="danger" class="me-2" >Cancel</flux:button>
                <flux:button type="submit" icon="check" variant="primary">Save changes</flux:button>

            </div>
        </div>
    </flux:modal>

   

</x-layouts::app>
