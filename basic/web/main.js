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
            var equipment = $( '#car-equipment' ).val();
            var power = $( '#car-power' ).val();
            var color = $( '#car-color' ).val();
            var price = $( '#car-price' ).val();

            var data = JSON.stringify( [{
                "brand": brand,
                "model": model,
                "equipment": equipment,
                "power": power,
                "color": color,
                "price": price
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
