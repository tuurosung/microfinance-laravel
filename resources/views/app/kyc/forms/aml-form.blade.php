<!-- Aml Forms -->

<h4 class="text-lg mb-8">Source Of Wealth</h4>

<div class="grid grid-cols-12 gap-6 mb-6">
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.select label="Source Of Funds" name="source_of_funds" id="source_of_funds"
            :options="$sourceOfFunds ?? old('source_of_funds')" :selected="$cif->kyc->kycAml->source_of_funds->value ?? old('source_of_funds')" required />
    </div>
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.select label="Employment Status" name="employment_status" id="employment_status"
            :options="$employmentStatus" :selected="$cif->kyc->kycAml->employment_status->value ?? old('employment_status')"
            required />
    </div>
    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.text-input name="occupation" id="occupation" label="Occupation"
            :value="$cif->kyc->kycAml->occupation ?? old('occupation')" required />
    </div>
</div>


<div class="grid grid-cols-12 gap-6 mb-6">
    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.text-input label="Employer Name" name="employer_name" id="employer_name"
            :value="$cif->kyc->kycAml->employer_name ?? old('employer_name')" placeholder="Ghana Health Service" required />
    </div>
    <!-- <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">

                        </div> -->
    <div class="lg:col-span-3 md:col-span-3 sm:col-span-12 col-span-12">
        <x-custom.form-inputs.number-input label="Monthly Income" name="monthly_income" id="monthly_income"
            :value="$cif->kyc->kycAml->monthly_income ?? old('monthly_income')" placeholder="500" required />
    </div>
</div>
