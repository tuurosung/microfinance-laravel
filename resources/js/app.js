import './preline.js';
import '../../node_modules/preline/preline.js';
import './app.init.js';
// import './app.min.js';
import './theme.js';

import Swal from 'sweetalert2'



import "@preline/select";
// import "@preline/overlay";
import "@preline/accordion";


// import HSOverlay from "@preline/overlay/non-auto";
// HSOverlay.autoInit();
// Or initialize a specific element manually
// const el = document.querySelector("#overlay");
// if (el) new HSOverlay(el);

// Select
// import "@preline/select"
// import HSSelect from "@preline/select"
// window.HSSelect = HSSelect


// Datepicker
import "@preline/datepicker"
import HSOverlay from "@preline/datepicker"

HSDatepicker.autoInit();

// window.HSOverlay = HSOverlay
// window.HSDatepicker = HSDatepicker

// bind Swal to the global scope
window.Swal = Swal

// or via CommonJS
// const Swal = require('sweetalert2')



// import './clean-footer.js';
// import './handle-tab-states.js';

// Import Select2
// import 'select2';

// Dynamically import bootbox after jQuery is confirmed available on window
// import('./printforce/bootbox.js').catch(err => console.warn('Bootbox failed to load:', err));

// Import vendor files that depend on jQuery/DOM being available
// Inject Toastify and PerfectScrollbar UMD bundles into the global scope
// Do this BEFORE importing other vendor bundles that expect these globals.
// injectScriptFromString(toastifySrc);
// injectScriptFromString(perfectScrollbarSrc);

// Ensure vendor libraries are available globally if they were loaded as UMD modules
// These are set by the UMD wrappers in the vendor files above
// if (typeof window.Toastify === 'undefined' && typeof Toastify !== 'undefined') {
//     window.Toastify = Toastify;
// }
// if (typeof window.PerfectScrollbar === 'undefined' && typeof PerfectScrollbar !== 'undefined') {
//     window.PerfectScrollbar = PerfectScrollbar;
// }
