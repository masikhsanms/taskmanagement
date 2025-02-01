$(document).ready(function(){
    load_librarty();
    function load_librarty(){
        $('.dttb').DataTable();
        $('.dtselect2').select2({
            theme: 'bootstrap4',
        });
    }

});