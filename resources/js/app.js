import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import Swal from 'sweetalert2';
window.Swal = Swal;

import Chart from 'chart.js/auto';
window.Chart = Chart;

// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// DataTables
import 'datatables.net-dt';
import 'datatables.net-dt/css/jquery.dataTables.css';

console.log('APP JS BERHASIL DIMUAT');
console.log('window.$ =', window.$);

// TAMBAHKAN INI
$(function() {

    $('table.datatable').each(function() {

        const table = $(this);

        const isBooking = table.attr('id') === 'bookingTable';

        table.DataTable({
            destroy: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            searching: !isBooking,
            info: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
    });
});