<template>
    <div class="container-fluid mt-4 mb-4">
      <nav aria-label="breadcrumb mb-5">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Alumnes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Autoavaluacio</li>
        </ol>
      </nav>
    </div>
    <div class="container-fluid">
      <autoavaluacio-moduls-table v-if="!doingAutoavaluacioModul" @edit-modul="editModul" :usuari="usuari"></autoavaluacio-moduls-table>
      <resultats-aprenentage-table v-else :usuari="usuari" :modul="modulSelected" @state-edit-original="stateEditOriginal"></resultats-aprenentage-table>
    </div>

  </template>
  
  <script>
  
  import ResultatsAprenentageTable from './resultatsAprenentageTable.vue'
  import AutoavaluacioModulsTable from './AutoavaluacioModulsTable.vue'
  
  export default {
    props: {
      usuari: Object,
    },

    components: {
      ResultatsAprenentageTable,
      AutoavaluacioModulsTable
    },

    data() {
      return {
        moduls: [],
        doingAutoavaluacioModul: false,
        modulSelected: {}
      };
    },

    methods: {
      editModul(modul) {
        this.doingAutoavaluacioModul = true;
        this.modulSelected = modul;
      },

      stateEditOriginal() {
        this.doingAutoavaluacioModul = false;
      }
    }
  };
  </script>

