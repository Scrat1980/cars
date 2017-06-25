/**
 * Created by root on 24.06.17.
 */

$( document ).ready(function(){
    App.updateQuantity();
    App.limitModels();
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
            }).done( function( quantity ){
                $( '#quantity' ).text( quantity );
            });
        } );

    },

    limitModels: function() {
        $( '#car-brand' ).on( 'change', function() {
            var brand = $( '#car-brand' ).val();
            var url = $( '#get-models-url' ).attr( 'data-url' );

            $.ajax({
                url: url,
                data: {brand: brand}
            }).done( function( response ) {
                var models = JSON.parse( response );

                $( '#car-model option' ).remove();
                for ( var index in models ) {
                    var selected = ( models[index] === 'Все' )
                        ? 'selected'
                        : '';

                    $( '#car-model' ).append(
                        '<option ' + selected + ' value="' + models[index] + '">' +
                        models[index] + '</option>'
                    );
                }
            } );
        } );
    }
};
