<!-- Ghana Card Information -->

<h4 class="text-lg mb-8 mt-10">Ghana Card Details</h4>

<div class="grid grid-cols-12 gap-6 mb-5">
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

        <x-custom.form-inputs.select label="Ghana Card Status" name="card_status" id="card_status"
            :options="$ghanaCardStatus" :selected="$cif->kyc->ghanaCard->card_status ?? ''" required />

    </div>
    <div class="lg:col-span-3 md:col-span-6 sm:col-span-12 col-span-12">

        <x-custom.form-inputs.text-input label="Ghana Card Number" name="card_number" id="card_number"
            :value="$cif->kyc->ghanaCard->card_number ?? ''" placeholder="GHA-XXXXXXXX-X" required />

    </div>
</div>
