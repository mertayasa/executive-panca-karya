require('./bootstrap');
require('./stisla/stisla-scripts');
require('./stisla/stisla-custom');
// require('./datatables/datatables');
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';
import toastr from 'toastr';
window.Swal = Swal;
window.Chart = Chart;
window.toastr = toastr;

// Import FilePond
import * as FilePond from 'filepond';

// Import the plugin code
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

// Import the plugin styles
// import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

window.FilePond = FilePond;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImageResize = FilePondPluginImageResize;
window.FilePondPluginImageValidateSize = FilePondPluginImageValidateSize;
window.FilePondPluginImageExifOrientation = FilePondPluginImageExifOrientation;
window.FilePondPluginFileEncode = FilePondPluginFileEncode;
