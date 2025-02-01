$(document).ready(function(){

/**
 * Show Password
 */
show_password();
function show_password(){
    $('.showpassword').on('click',function(){
        if($(this).is(':checked')){
            $('input[name="password"]').attr('type','text');
        }else{
            $('input[name="password"]').attr('type','password');
        }
    });
}

/**
 * Hapus pengguna
 */
hapuspengguna();
function hapuspengguna(){
    $('.hapuspengguna').on('click',function(e){
        if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
            $.ajax({
               url:'hapuspengguna',
               data:{'id':$(this).data('id')},
               type:'POST',
               dataType:'JSON',
                success:function(response){
                    // console.log(response);
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
        }
    });
}

});