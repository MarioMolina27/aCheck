<template>
    <button @click="confirmDelete" class="btn btn-danger">
      <i class="fas fa-trash-alt"></i>
    </button>
  </template>
  
  <script>
    import Swal from "sweetalert2";
    export default {
        props: {
            formId: String
        },
        methods: {
        confirmDelete(event) {
            event.preventDefault();
            const formId = this.formId;
            const form = document.querySelector(`.${formId}`);
    
            Swal.fire({
            title: "¿Estás seguro que quieres eliminar?",
            text: "Si hay registros relacionados, se desactivará.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar"
            }).then((result) => {
            if (result.isConfirmed) {
               form.submit();
            }
            });
        }
        }
    };
  </script>
  