(function($){

	// use jQuery as $
    $.fn.hapus_task = function(task_id) {
        if (!confirm("Apakah Anda yakin ingin menghapus task ini?")) return;

        $.ajax({
            url:'hapustask',
            data:{'id':task_id},
            type:'POST',
            dataType:'JSON',
             success:function(response){
                 if( response.code == '200' ){
                     window.location.reload();
                 }else{
                     alert('Maaf Data Gagal Dihapus');
                     return false;
                 }
             },
             error:function(xhr){
                 alert('Error Sistem : '+xhr.status);
             }
         });
    };
    
    $('.hapustask').on('click',function(){
        var task_id = $(this).data("id");
        $.fn.hapus_task(task_id);
    });

}(jQuery));