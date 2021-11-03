/* Simple VanillaJS to toggle class */
if (typeof jQuery === 'undefined') {
    throw new Error('AdminLTE requires jQuery')
}
+function($){
    'use strict';

    $(document).ready( function () {
        $('#userTable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
        });
        $('#mbrTable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
        });
        $('#adminTable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
        });
        var header = document.getElementById("menu_sidebar");
        var btns = header.getElementsByClassName("bttn");

        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                if (current.length > 0) {
                    current[0].className = current[0].className.replace(" active", "");
                }
                this.className += " active";
            });
        }
    });
}(jQuery);

