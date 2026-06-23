<?php

use App\Domain\CIFs\Models\Cif;
use App\Domain\KYC\Models\Kyc;
use App\Domain\KYC\Services\KycSubmissionService;
use App\Services\Kyc\SubmitKycForApproval;
use Livewire\Component;

new class extends Component {

    public Cif $cif;
    public Kyc $kyc;
    // public KycSubmissionService $submissionService;

    public function boot(): void
    {
        $this->submissionService = new KycSubmissionService($this->cif, $this->kyc);
    }


    public function mount(Cif $cif, Kyc $kyc) {
        $this->cif = $cif;
        $this->kyc = $kyc;
    }

    public function submitKycFrmForApproval()
    {
        try {
            $this->submissionService->submit();
            return redirect()->route('cif.show', [$this->cif]);
        } catch (\Exception $e) {
            // $this->addError($e->getMessage());
            throw $e;
        }
    }
};
?>

<div>

</div>
