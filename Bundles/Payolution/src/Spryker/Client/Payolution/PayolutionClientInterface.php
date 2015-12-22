<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Client\Payolution;

use Generated\Shared\Transfer\CheckoutRequestTransfer;
use Generated\Shared\Transfer\PayolutionCalculationResponseTransfer;

interface PayolutionClientInterface
{

    /**
     * @param CheckoutRequestTransfer $checkoutRequestTransfer
     *
     * @return PayolutionCalculationResponseTransfer
     */
    public function calculateInstallmentPayments(CheckoutRequestTransfer $checkoutRequestTransfer);

    /**
     * @param PayolutionCalculationResponseTransfer $payolutionCalculationResponseTransfer
     *
     * @return PayolutionCalculationResponseTransfer
     */
    public function storeInstallmentPaymentsInSession(PayolutionCalculationResponseTransfer $payolutionCalculationResponseTransfer);

    /**
     * @return bool
     */
    public function hasInstallmentPaymentsInSession();

    /**
     * @return PayolutionCalculationResponseTransfer
     */
    public function getInstallmentPaymentsFromSession();

    /**
     * @return mixed
     */
    public function removeInstallmentPaymentsFromSession();

}