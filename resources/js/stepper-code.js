 // window.addEventListener('load', () => {
    //     const stepper = HSStepper.getInstance('[data-hs-stepper]');

    //     stepper.on('beforeNext', (currentIndex) => {

    //         // Clear any prior error state on this step before retrying
    //         stepper.unsetProcessedNavItem(currentIndex);

    //         stepper.setProcessedNavItem(currentIndex);
    //         stepper.disableButtons();
    //         stepper.setErrorNavItem(currentIndex);


    //         setTimeout(function() {
    //             stepper.enableButtons();
    //             stepper.unsetProcessedNavItem(currentIndex);
    //         }, 500)


    //         if (currentIndex !== 3) {
    //             stepper.goToNext()
    //         }

    //         const stepperEl = document.querySelector('[data-hs-stepper]');
    //         const activeContent = stepperEl.querySelector(
    //             `[data-hs-stepper-content-item*='"index": ${currentIndex}']`
    //         );

    //         const componentId = activeContent
    //             .querySelector('[wire\\:id]')
    //             .getAttribute('wire:id');
    //         const component = window.Livewire.find(componentId);


    //         let unsubSaved = () => {};
    //         let unsubFailed = () => {};


    //         const cleanup = () => {
    //             // Re-enable FIRST, so nothing below can strand the button
    //             stepper.enableButtons();
    //             stepper.unsetProcessedNavItem(currentIndex);

    //             // Guard the unsubs — they may be undefined depending on Livewire version
    //             try {
    //                 unsubSaved();
    //             } catch (e) {}
    //             try {
    //                 unsubFailed();
    //             } catch (e) {}
    //         };

    //         unsubSaved = Livewire.on('update-card', () => {
    //             console.log('update-successful')
    //             cleanup();
    //             stepper.goToNext();
    //         }) ?? (() => {});

    //         unsubFailed = Livewire.on('card-update-failed', () => {
    //             console.log('update-failed')
    //             cleanup();
    //             stepper.setErrorNavItem(currentIndex);
    //         }) ?? (() => {});

    //         if (currentIndex == 3) {
    //             component.call('saveCardInfo');
    //         }

    //     });
    // });






    // ---------------------------------Working Code ----------------------------------------
    const STEPPER_SELECTOR = '[data-hs-stepper]';

    /**
     * Resolve the Livewire component rendered inside a given step's content panel.
     */
    function stepComponent(stepperEl, index) {
        const content = stepperEl.querySelector(
            `[data-hs-stepper-content-item*='"index": ${index}']`
        );
        const wireId = content.querySelector('[wire\\:id]').getAttribute('wire:id');

        console.log("returning livewire id")
        return window.Livewire.find(wireId);
    }


    /**
     * Invoke saveStep() and settle based on the event the component dispatches back.
     *
     * component.call() resolves with null regardless of the PHP return value, so the
     * outcome is signalled through dispatched events. Both listeners are torn down on
     * either outcome so they never stack across steps.
     */
    function saveStep(component) {
        console.log('initiating promise')
        return new Promise((resolve, reject) => {

            const offSaved = window.Livewire.on('kyc-updated', () => {
                console.log('update');
                settle(resolve)
            });

            const offFailed = window.Livewire.on('update-failed', () => {
                console.log('failed');
                settle(reject)
            });

            console.log("Initiating settlement")

            function settle(outcome) {
                console.log('Settling')
                offSaved();
                offFailed();
                outcome();
            }

            console.log("Calling component")
            component.call('updateKyc');
        });
    }


    function initKycStepper() {
        const stepperEl = document.querySelector(STEPPER_SELECTOR)
        if (!stepperEl) return;

        const stepper = HSStepper.getInstance(STEPPER_SELECTOR)

        stepper.on('beforeNext', async (index) => {
            stepper.disableButtons();
            stepper.setProcessedNavItem(index);

            try {

                console.log("starting try block")
                await saveStep(stepComponent(stepperEl, index));

                console.log('Timing out')

                stepper.unsetProcessedNavItem(index);
                stepper.enableButtons();
                stepper.goToNext();

            } catch {


                // Re-enable on the next tick: setErrorNavItem mutates Preline's
                // internal state synchronously and overwrites a same-tick enable.
                // console.log('Timeing out')
                // setTimeout(function() {
                //     stepper.unsetProcessedNavItem(index);
                //     stepper.setErrorNavItem(index);
                // }, 0);
                // setTimeout(() => stepper.enableButtons(), 500);

                stepper.unsetProcessedNavItem(index);
                stepper.setErrorNavItem(index);
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => stepper.enableButtons());
                });
            }
        });
    }

    window.addEventListener('load', initKycStepper);
