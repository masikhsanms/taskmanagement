$(document).ready(function(){

    /**
     * Change harga satuan
     * hitung total
     * satuan x jumlah
     */
    hitung_total();
    function hitung_total(){
        $('input[name="hargasatuan"]').on('blur',function(){
            let root = $(this);
            let hargasatuan = root.val();
            let jumlah = root.closest('.row').find('input[name="jumlah"]').val();
            let total = hargasatuan * jumlah;
            let ket = '';
                ket +='Harga Satuan : Rp. '+convert_rupiah(hargasatuan)+'</br>';
                ket +='Jumlah : '+jumlah+'</br>';
                ket += '<b>Total : Rp. '+convert_rupiah(total)+'</b>';
            
                $('.wraptotal').html(ket);
            $('input[name="total"]').val(total);
        });

        $('input[name="jumlah"]').on('blur',function(){
            let root = $(this);
            let jumlah = root.val();
            let hargasatuan = root.closest('.row').find('input[name="hargasatuan"]').val();
            let total = hargasatuan * jumlah;
            let ket = '';
                ket +='Harga Satuan : Rp. '+convert_rupiah(hargasatuan)+'</br>';
                ket +='Jumlah : '+jumlah+'</br>';
                ket += '<b>Total : Rp. '+convert_rupiah(total)+'</b>';
            
                $('.wraptotal').html(ket);
            $('input[name="total"]').val(total);
        });
        
    }

    function convert_rupiah(angka){
        if( angka.length > 3 ){
            return (angka/1000).toFixed(3);
        }else{
            return angka;
        }
    }

        /**
     * Hapus pembelian
     */
    hapus_pembelian();
    function hapus_pembelian(){
        $('.hapuspembelian').on('click',function(e){
            if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
                $.ajax({
                url:'hapuspembelian',
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
     * Hapus penjualan
     */
        hapus_penjualan();
        function hapus_penjualan(){
            $('.hapuspenjualan').on('click',function(e){
                if( confirm('Apakah Anda yakin Menghapus data ini ?') ){
                    $.ajax({
                    url:'hapuspenjualan',
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

buyer_penjualan();
function buyer_penjualan(){
    $('.buyer_penjualan').on('change',function(e){
            let id = $(this).val();
            $.ajax({
               url:'buyer_penjualan',
               data:{'id':id},
               type:'POST',
            //    dataType:'JSON',
                success:function(response){
                  $('.produk_penjualan').html(response);
                 $('dtselect2').select2();
                },
                error:function(xhr){
                    alert('Error Sistem : '+xhr.status);
                }
            });
        
    });
}
});