     </div>
    </div>
    <div id="modal-upload-progress" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Prosess Upload File..</h4>
          </div>
          <div class="modal-body">
            <div class="progress">
              <div id="modal-percent-container-progress" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span id="modal-percent-progress" class="sr-only" style="position: static;"></span>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  <script type="text/javascript" src="libs/js/jquery.form.min.js"></script>
  
  <!-- Datatable -->
  <script src="libs/js/dataTable/jquery.dataTables.min.js"></script>
  <script src="libs/js/dataTable/dataTables.bootstrap4.min.js"></script>
  <script src="libs/js/dataTable/dataTables.responsive.min.js"></script>
  <script src="libs/js/dataTable/responsive.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script> -->
  <script type="text/javascript">

function add_panjar(a,b,c){
        $('#Body_input').load('form_input_p.php?id_satker='+a+'&spm='+b+'&id='+c);
        $('#form_panjar').modal('show');
    }
function Add_detail(a){
        $('#Body_dp').load('form_detail_p.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }
    function update_detail(a){
        $('#Body_edit').load('form_u_detail_p.php?id='+a);
        $('#Update').modal('show');
    }
    function Tampil(a){
        $('#Body_dp').load('detail_p.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }

    function AddT(a){
        $('#Body_dp').load('add_transaksi.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }
    function EditT(a){
        $('#Body_et').load('edit_transaksi.php?id='+a);
        $('#EditT').modal('show');
    }

    function simpan_dp(){
        var spm = $('#spm').val();
        var jenis = $('#jenis').val();
        alert(spm);
        $('#Body_dp').POST('insert_dp.php?spm='+spm+'&jenis='+jenis);
        // $('#Detail_Nodin').modal('show');
    }


    $(document).ready(function() {
      dataTable();
    });

    function dataTable(){
      $('#tabel').DataTable({
        responsive:true
      });
    }

    function showT(modal){
        //$('#'+modal).modal('show');
        $('#NodinPengajuan').modal('show');
    }

    var e_nominal = document.getElementById('e_nominal');
    if (e_nominal) {
      e_nominal.addEventListener('keyup', function(e){
        e_nominal.value = formatRupiah(this.value, 'Rp. ');
      });
    }

    var e_ppn = document.getElementById('e_ppn');
    if (e_ppn) {
      e_ppn.addEventListener('keyup', function(e){
        e_ppn.value = formatRupiah(this.value, 'Rp. ');
      });
    }

    var e_pph = document.getElementById('e_pph');
    if (e_pph) {
      e_pph.addEventListener('keyup', function(e){
        e_pph.value = formatRupiah(this.value, 'Rp. ');
      });
    }

   

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }





    /* Fungsi formatRupiah */
  function formatRupiah1(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
  
  $(document).ready(function () {
    var formUploadWithProgress = $('form#form_upload_progress');
    var inputFile = $('input#file_upload');
    formUploadWithProgress.submit(function(e) {
      if (inputFile.val()) {
        e.preventDefault();
        var optionsUploadFile = {
          // url: $(this).attr('data-action-url'),
          resetForm: true,
          beforeSubmit: onBeforeSubmit,
          uploadProgress: onUploadProgress,
          success: onSuccess
        };
        $(this).ajaxSubmit(optionsUploadFile);
        return false;
      }
    });
  });

  function onBeforeSubmit() {
    $('#modal-upload-progress').modal('show')
  }

  function onSuccess(res) {
    var alertFileError = $('div#alert-file-error');
    var spanMessage = $('span#alert-messages');
    var response = JSON.parse(res);
    $('#modal-upload-progress').modal('hide')
    if (response.success) {
      window.open(window.location.origin+response.redirect.to, '_self');
    }
    if (!res.success) {
      spanMessage.text(response.message);
      alertFileError.css('display', 'block');
    }
  }

  function onUploadProgress(event, position, total, percentComplete) {
    console.log(percentComplete);
    $('span#modal-percent-progress').text(percentComplete+'% Uploading..');
    $('#modal-percent-container-progress').attr('aria-valuenow', percentComplete);
    $('#modal-percent-container-progress').css('width', percentComplete+'%');
  }
  
</script>

</body>

</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
