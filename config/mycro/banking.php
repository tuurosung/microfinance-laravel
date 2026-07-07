<?php

declare(strict_types= 1);

return [
    /*
     * Withdrawals at or above this amount require supervisor (Checker)
     * approval before posting. GHS 5,000.00 default.
     */
    'withdrawal_approval_threshold_pesewas' => env('WITHDRAWAL_APPROVAL_THRESHOLD_PESEWAS', 500_000),

    /*
     * Cash Transaction Report flag threshold. Set this to the current
     * FIC/BoG directive value — do not guess it. Flag-only; never blocks.
     */
    'ctr_threshold_pesewas' => env('CTR_THRESHOLD_PESEWAS', 5_000_000),

    /*
     * User id used as actor for system-initiated postings and as opened_by
     * on seeded system accounts.
     */
    'system_user_id' => env('BANKING_SYSTEM_USER_ID', 1),
];
