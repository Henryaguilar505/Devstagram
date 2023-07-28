import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    
    //funcion que se ejecuta una vez se ha creado DropZone
    init: function(){
        //si hay una imagen...
        if(document.querySelector('[name="imagen"]').value.trim()){
            console.log(document.querySelector('[name="imagen"]').value.trim());
            const imagenPublicada = {};
            imagenPublicada.size = 1234; //no es importante(en este caso) pero se debe tener el size
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            //opciones de dropzone
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-succes', 'dz-complete');
        }
    }
});

//cuando se suba la imagen
dropzone.on('success', function(file, response){
    //agregar la imagen al formulario del post
    document.querySelector('[name="imagen"]').value = response.imagen;
})

//cuando haya un errror
// dropzone.on('error', function(file, respose){
//     console.log(respose);
// })

//cuando el usuario seleccione 'Borrar archivo'
dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value = ""; 
})

