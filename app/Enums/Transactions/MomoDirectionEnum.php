<?php

namespace App\Enums\Transactions;

enum MomoDirectionEnum: string
{
    case Collection = 'collection'; // money in:  customer wallet -> MFI float (deposit)
    case Disbursement = 'disbursement'; // money out: MFI float -> customer wallet (withdrawal)
}
