function BuscarProducto() {
    var name_product = document.getElementById('p_name')

    // Ahora los campos que rellenare
    var id_product = document.getElementById('p_id')
    var amount_product = document.getElementById('p_amount')
    var price_product = document.getElementById('p_price')
    // Interactuar
    var amount = document.getElementById('s_amount')
    
    console.log(name_product.value)
    console.log(name_product)

    fetch('/api/data')
    .then(response => response.json())
    .then(data => {
        // Hacer algo con los datos recibidos
        console.log(data);

        data.forEach(element => {
            if (element.name.includes(name_product.value)) {
                console.log(element)
                id_product.value = element.id
                console.log(id_product.value)
                name_product.value = element.name
                amount_product.value = element.stock
                price_product.value = element.price

                if (element.stock == 0) {
                    amount.setAttribute('disabled', '')
                }else if(element.stock > 0) {
                    amount.setAttribute('max', element.stock)
                }

                return false
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
// Obtener el elemento select
/*
var selectElement = document.getElementById('voucher');

// Escuchar el evento de cambio
selectElement.addEventListener('change', function() {
    
    
    // Obtener el valor seleccionado
    var selectedValue = selectElement.value;
    
    // Realizar acciones condicionales en el cliente
    if (selectedValue === '1') {
        // Mostrar u ocultar elementos
        var conditionalElement = document.getElementById('ruc-input');
        if (conditionalElement) {
            conditionalElement.style.display = 'block';
        }
    } else {
        // Restaurar estado inicial u ocultar elementos
        var conditionalElement = document.getElementById('ruc-input');
        if (conditionalElement) {
            conditionalElement.style.display = 'none';
        }
    }
});*/