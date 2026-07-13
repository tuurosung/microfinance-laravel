import './preline.js';
import '../../node_modules/preline/preline.js';
import './app.init.js';
// import './app.min.js';
import './theme.js';

import Swal from 'sweetalert2'


import "@preline/select";
// import "@preline/overlay";
import "@preline/accordion";


// Datepicker
import "@preline/datepicker"
import HSOverlay from "@preline/datepicker"

HSDatepicker.autoInit();


import HSStepper from '@preline/stepper';
window.HSStaticMethods.autoInit();

// bind Swal to the global scope
window.Swal = Swal
