import './bootstrap';
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';
import 'preline';
import { HSStaticMethods } from 'preline';

// Untuk Alpine
window.Alpine = Alpine;
Alpine.start();

// Untuk SweetAlert bisa dipakai langsung dalam script seperti ini:
window.Swal = Swal;


document.addEventListener('DOMContentLoaded', () => {
    HSStaticMethods.autoInit();
});
