    <script src="{{asset('admin/js/vendor/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins.js')}}"></script>
    <script src="{{asset('admin/js/main.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/data-table/datatables-init.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
          $('body').on('click', '.close-flash', function(){
            $(this).parent().css('display', 'none');
          });
          $('.modal').on('show.bs.modal', function (event) {
            $(body).css('padding-right', 0);
          });

          if ($('.cie').length) {
              IsEmpty();
          }

        } );
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );

        $('#fakultas').on('change', function(e){
        console.log(e);
        var fakultas_id = e.target.value;
        $.get('/admin/mahasiswa/json-fakultas?fakultas_id=' + fakultas_id,function(data) {
          console.log(data);
          $('#jurusan').empty();
          $('#jurusan').append('<option value="0" disable="true" selected="true">=== Pilih Jurusan ===</option>');

          $.each(data, function(index, jurusanObj){
            $('#jurusan').append('<option value="'+ jurusanObj.id +'">'+ jurusanObj.jurusan +'</option>');
          })
        });
      });

      function Redirect(){
        window.location = "http://localhost:8000/admin/mahasiswa/mahasiswa";
      }
      function IsEmpty(){
        alert("Nilai Kriteria Tidak Boleh Kosong, Pindah ke halaman Mahasiswa");
        setTimeout(function(){
          	Redirect();
          }, 1000);
      }
      function CekIsEmpty(){
        var x = document.getElementById("EmptyValue");
        if(x){
          IsEmpty();
        }
      }

        var btn = document.getElementById('buttonlink');
        btn.style.textDecoration = "none";
        btn.style.paddingLeft = "0px";
        btn.style.color = "white";
        btn.style.fontSize = "15px";

      var click = $("#menuToggle");

      click[0].onclick = function(){
        $("#bton").toggleClass("open");
        return false;
      };

      // function showFunction(){
      //    var hidden = document.getElementById('bton');
      //    var content = document.getElementById('hidden');
      //        if (hidden.textContent === "show") {
      //          content.classList.remove("hidden");
      //          hidden.innerHTML = "hide";
      //          content.classList.add("show");
      //  //         idHidden.style.display = "none";
      //
      //       } else {
      //         content.classList.add("hidden");
      //         hidden.innerHTML = "show";
      //         content.classList.remove("show");
      // //         idHidden.style.display = "block";
      //       }
      //   }
      //   window.onload = function(){
      //     showFunction();
      //   };
      
    </script>
