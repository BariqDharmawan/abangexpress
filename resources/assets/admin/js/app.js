import './library/datatable/jquery.dataTables.min.js';
import './library/datatable/dataTables.bootstrap4.min.js';
import './library/sb-admin-2'
import './function/login'
import './function/datatables'

const Chart = require('chart.js')
const Swal = require('sweetalert2')

const csrfToken = $('meta[name="csrf-token"]').attr('content')