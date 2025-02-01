$(document).ready(function(){

    /**
     * Hapus Stok
     */
    deletestokbarang();
    function deletestokbarang(){
        $('.hapusstokbarang').on('click',function(e){
            if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
                $.ajax({
                url:'deletestokbarang',
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
     * Hapus Barang Masuk
     */
    deletebarangmasuk();
    function deletebarangmasuk(){
        $('.hapusbarangmasuk').on('click',function(e){
            if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
                $.ajax({
                url:'deletebarangmasuk',
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
     * Hapus BARANG KELUAR
     */
    deletebarangkeluar();
    function deletebarangkeluar(){
        $('.hapusbarangkeluar').on('click',function(e){
            if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
                $.ajax({
                url:'deletebarangkeluar',
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