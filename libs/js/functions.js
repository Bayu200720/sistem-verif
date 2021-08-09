$(document).on('click','#komentar',function(){
  var id=$(this).data('id');
  $('.modal-body #id').val(id);   
});
$(document).on('click','#import',function(){
  var id=$(this).data('id');
  $('.modal-body #id').val(id);   
});
$(document).on('click','#UploadSP2D',function(){
  var id=$(this).data('id');
  $('.modal-body #id').val(id);   
});

$(document).on('click','#UploadSPM',function(){
  var id=$(this).data('id');
  $('.modal-body #id').val(id);   
});
$(document).on('click','#Upload_adkSPM',function(){
  var id=$(this).data('id');
  $('.modal-body #id').val(id);   
});


$(document).on('click','#penolakan',function(){
  var id=$(this).data('id');
  var keterangan=$(this).data('keterangan');
  $('.modal-body #id').val(id);   
  $('.modal-body #keterangan').val(keterangan);   
});
$(document).on('click','#kekurangan',function(){
  var id=$(this).data('id');
  var verifikasi=$(this).data('verifikasi');
  $('.modal-body #id').val(id);   
  $('.modal-body #verifikasi').val(verifikasi);   
});

$(document).on('click','#editakun',function(){
  var id=$(this).data('id');
  var kode=$(this).data('kode');
  var uraian=$(this).data('uraian');
  var tahun=$(this).data('tahun');
  $('.modal-body #id').val(id);   
  $('.modal-body #kode').val(kode);   
  $('.modal-body #uraian').val(uraian); 
  $('.modal-body #tahun').val(tahun); 
});


$(document).on('click','#editsp2d',function(){
    var id=$(this).data('id');
    var sp2d=$(this).data('sp2d');
        
    $('.modal-body #id').val(id);
    $('.modal-body #sp2d').val(sp2d);
  })

  $(document).on('click','#editnodin',function(){
    var id=$(this).data('id');
    var tanggal=$(this).data('tanggal');
    var tahun=$(this).data('tahun');
    var no_nodin = $(this).data('no_nodin');
        
    $('.modal-body #id').val(id);
    $('.modal-body #tanggal').val(tanggal);
    $('.modal-body #tahunN').val(tahun);
    $('.modal-body #no_nodin').val(no_nodin);
  })

$(document).on('click','#editpencairan',function(){
    var id=$(this).data('id');
    var spm=$(this).data('spm');
    var tanggal=$(this).data('tanggal');
    var keterangan=$(this).data('keterangan');
    var nominal = $(this).data('nominal');
    var id_satker = $(this).data('id_satker');
        
    $('.modal-body #uraian').val(spm);
    $('.modal-body #id').val(id);
    $('.modal-body #tanggal').val(tanggal);
    $('.modal-body #keterangan').val(keterangan);
    $('.modal-body #nominal').val(nominal);
    $('.modal-body #id_satker').val(id_satker);
  })




function suggetion() {

     $('#sug_input').keyup(function(e) {

         var formData = {
             'product_name' : $('input[name=title]').val()
         };

         if(formData['product_name'].length >= 1){

           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   //console.log(data);
                   $('#result').html(data).fadeIn();
                   $('#result li').click(function() {

                     $('#sug_input').val($(this).text());
                     $('#result').fadeOut(500);

                   });

                   $("#sug_input").blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {

           $("#result").hide();

         };

         e.preventDefault();
     });

 }
  $('#sug-form').submit(function(e) {
      var formData = {
          'p_name' : $('input[name=title]').val()
      };
        // process the form
        $.ajax({
            type        : 'POST',
            url         : 'ajax.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
            .done(function(data) {
                //console.log(data);
                $('#product_info').html(data).show();
                total();
                $('.datePicker').datepicker('update', new Date());
                
            }).fail(function() {
                $('#product_info').html(data).show();
            });
      e.preventDefault();
  });
  function total(){
    $('#product_info input').change(function(e)  {
            var price = +$('input[name=price]').val() || 0;
            var qty   = +$('input[name=quantity]').val() || 0;
            var total = qty * price ;
                $('input[name=total]').val(total.toFixed(2));
    });
  }

$(document).ready(function() {

  //tooltip
  $('[data-toggle="tooltip"]').tooltip();

  $('.submenu-toggle').click(function () {
      $(this).parent().children('ul.submenu').toggle(200);
  });
  //suggetion for finding product names
  suggetion();
  // Callculate total ammont
  total();

  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
  });

  $('#menu-toggle').on('click', function () {
    $('#app-page').toggleClass('not-active');
    $('#sidebar-wrapper').toggleClass('not-active');
  })
});

