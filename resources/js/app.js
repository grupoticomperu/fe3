require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Arrastre la imagen de los productos aquí",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    queuecomplete: function() {//esta funcion se ejecuta luego que cargo toda las imagenes, regarga la página
       window.location.reload();
    },
    //addRemoveLinks: true,
    //dictRemoveFile: 'borrar archivo',
   //maxFiles: 10,
  // uploadMultiple: true,

});


/* dropzone.on("sending", function(file, xhr, formData){
    console.log(file);
});


  dropzone.on("success", function(file, response){
    //document.querySelector('[name="imagen"]').value = response.imagen;
    console.log(response);
});
 */
/*   dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value = "";
}); */







