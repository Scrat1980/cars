/**
 * Created by root on 24.06.17.
 */

$( document ).ready(function(){
    $( '#car-brand' ).on( 'change', function( event ){
        var brandId = $(this).val();
        console.log( brandId );
    } );
});

