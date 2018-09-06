<!-- JavaScript files-->
{{-- <script src="{{asset('surveyor/vendor/jquery/jquery.min.js')}}"></script> --}}
<script src="{{asset('admin/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('surveyor/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('surveyor/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('surveyor/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
<script src="{{asset('surveyor/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('surveyor/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('surveyor/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('surveyor/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Main File-->
<script src="{{asset('surveyor/js/front.js')}}"></script>



<script type="text/javascript">

    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }

    $('#fakultas').on('change', function(e){
    console.log(e);
    var fakultas_id = e.target.value;
    $.get('/surveyor/json-fakultas?fakultas_id=' + fakultas_id,function(data) {
      console.log(data);
      $('#jurusan').empty();
      $('#jurusan').append('<option value="0" disable="true" selected="true">=== Pilih Jurusan ===</option>');

      $.each(data, function(index, jurusanObj){
        $('#jurusan').append('<option value="'+ jurusanObj.id +'">'+ jurusanObj.jurusan +'</option>');
      })
    });
    });

      var btn = document.getElementById('buttonlink');
      btn.style.textDecoration = "none";
      btn.style.color = "white";
      btn.style.fontSize = "15px";
    
</script>
