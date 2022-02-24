/*(function() { // evitar el codigo tenga interferencias, se modifique. Es como si fuese un private, se aisla del resto de javascrpit

    // delete metodo 3 se dispara el evento con show.bs.modal ( Mejor el tercero )
    let modalDelete = document.getElementById('modalDelete');
    let deleteElement = document.getElementById('deleteElement');

    
    
    
    
    
    
    modalDelete.addEventListener('show.bs.modal', function(event) {
        // nos dice quien ha abierto la ventana (el enlace con el que ha hecho link)
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;

        if (deleteElement) {
            deleteElement.innerHTML = name;
        }
        let form = document.getElementById('modalDeleteResourceForm');
        // su action quiere que sea su actio
        form.action = action;
    });

    // delete metodo 3 se dispara el evento con show.bs.modal ( Mejor el tercero )
    let modalDelete1 = document.getElementById('modalDelete1');
    let deleteElement1 = document.getElementById('deleteElement1');
    modalDelete1.addEventListener('show.bs.modal', function(event) {
        // nos dice quien ha abierto la ventana (el enlace con el que ha hecho link)
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;
        if (deleteElement1) {
            deleteElement1.innerHTML = name;
        }
        let form = document.getElementById('modalDeleteResourceForm1');
        // su action quiere que sea su actio
        form.action = action;
    });


})();*/


$('#modalDelete').on('shown.bs.modal', function(event) {
    let deleteItem = document.getElementById('deleteItem');
    let element = event.relatedTarget;
    let action = element.getAttribute('data-url');
    let name = element.dataset.name;
    deleteItem.innerHTML = name;
    let form = document.getElementById('modalDeleteResourceForm');
    form.action = action;
})
