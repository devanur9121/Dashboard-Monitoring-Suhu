<!-- Menghapus jQuery lokal dan menggunakan versi dari CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Menggabungkan tinymce.js dengan skrip lainnya -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/chartjs/chart.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="assets/plugins/jquery-knob/excanvas.js"></script>
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
<script src="assets/js/index.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/tinymce/js/tinymce/tinymce.min.js"></script>

<script>
  $(document).ready(function() {
    // Skrip Password show & hide
    $("#show_hide_password a").on('click', function(event) {
      event.preventDefault();
      if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("bx-hide");
        $('#show_hide_password i').removeClass("bx-show");
      } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("bx-hide");
        $('#show_hide_password i').addClass("bx-show");
      }
    });

    // Inisialisasi TinyMCE
    tinymce.init({
      selector: 'textarea',
      plugins: 'autoresize autolink lists fontsize lineheight advlist fullscreen',
      toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | blockquote | forecolor backcolor | fontsize | subscript superscript | removeformat | hr | fullscreen',
      menubar: false,
      statusbar: false,
      width: '100%',
      height: 300,
      setup: function(editor) {
        editor.on('keydown', function(e) {
          if (e.keyCode === 9) {
            e.preventDefault();
            var selection = editor.selection;
            var start = selection.getStart();
            var end = selection.getEnd();

            if (!selection.isCollapsed()) {
              editor.selection.setContent('&emsp;');
            } else {
              editor.selection.setContent('&emsp;' + editor.selection.getContent());
            }
          }
        });
      }
    });

    //Default data table
    var table1 = $('#example2').DataTable({
      lengthChange: true,
      buttons: [{
          extend: 'copy',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        'colvis'
      ]
    });
    table1.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    //Default data table
    var table2 = $('#example3').DataTable({
      lengthChange: true,
    });
  });
</script>
<script>
  // Inisialisasi SimpleBar pada elemen dengan ID 'content'
  var contentElement = document.getElementById('page-wrapper');
  new SimpleBar(contentElement);
</script>

