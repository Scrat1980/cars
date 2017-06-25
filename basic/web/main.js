/**
 * Created by root on 24.06.17.
 */

$( document ).ready(function(){
    App.updateQuantity();
});

App = {
    updateQuantity: function() {
        $( '.form-control' ).on( 'change', function( event ){
            var url = $( '#w0' ).prop('action');

            var brand = $( '#car-brand' ).val();
            var model = $( '#car-model' ).val();
            var power = $( '#car-power' ).val();

            var data = JSON.stringify( [{
                "brand": brand,
                "model": model,
                "power": power
            }] );

            $.ajax({
                url: url,
                data: {data: data}
            }).done( function( response ){
                var responseParsed = JSON.parse( response );
                var quantity = responseParsed['quantity'];
                $( '#quantity' ).text( quantity );
            });
        } );

    }
};
