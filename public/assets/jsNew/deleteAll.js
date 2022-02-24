/*(function() { // evitar el codigo tenga interferencias, se modifique. 


    // Ventana FLUSH ALL

    // delete metodo  se dispara el evento con show.bs.modal
    /* let modalDelete = document.getElementById('modalDelete');
     let deleteProduct = document.getElementById('deleteProduct');
     let deleteId = document.getElementById('deleteProductId');

     modalDelete.addEventListener('show.bs.modal', function(event) {
         // nos dice quien ha abierto la ventana (el enlace con el que ha hecho link)
         let element = event.relatedTarget;
         let action = element.getAttribute('data-url');
         let form = document.getElementById('modalDeleteResourceForm');
         // su action quiere que sea su action
         if (deleteProduct) {
             let name = element.dataset.name;
             deleteProduct.innerHTML = name;
             let id = element.dataset.id;
             deleteId.innerHTML = id;
         }

         form.action = action;
     }); */

    // Ventana FLUSH ALL
/*
    let modalDelete1 = document.getElementById('modalDelete1');
    let form = document.getElementById('modalDeleteResourceForm1');
    modalDelete1.addEventListener('show.bs.modal', function(event) {
        // nos dice quien ha abierto la ventana (el enlace con el que ha hecho link)
        let element = event.relatedTarget;
       
   
        // su action quiere que sea su action
        form.action = action;
    });
    */
  
    /*
    let modalDelete10 = document.getElementById('modalDelete10');

    modalDelete10.addEventListener('show.bs.modal', function(event) {
        // nos dice quien ha abierto la ventana (el enlace con el que ha hecho link)
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let form = document.getElementById('modalDeleteResourceForm10');
        // su action quiere que sea su action
        form.action = action;
    }); */
// })(); 

  $('#modalDelete1').on('shown.bs.modal', function(event) {
    let element = event.relatedTarget;
    let action = element.getAttribute('data-url');
    let form = document.getElementById('modalDeleteResourceForm1');
    form.action = action;
})
