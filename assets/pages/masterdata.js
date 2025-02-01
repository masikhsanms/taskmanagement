$(document).ready(function(){
/**
 * Hapus Barang
 */
hapus_barang();
function hapus_barang(){
    $('.hapusbarang').on('click',function(e){
        if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
            $.ajax({
               url:'hapusbarang',
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

/**
 * Hapus suplier
 */
hapus_suplier();
function hapus_suplier(){
    $('.hapussuplier').on('click',function(e){
        if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
            $.ajax({
               url:'hapussuplier',
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

/**
 * Hapus produk
 */
hapus_produk();
function hapus_produk(){
    $('.hapusproduk').on('click',function(e){
        if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
            $.ajax({
               url:'hapusproduk',
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

/**
 * Hapus buyer
 */
hapus_buyer();
function hapus_buyer(){
    $('.hapusbuyer').on('click',function(e){
        if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
            $.ajax({
               url:'hapusbuyer',
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