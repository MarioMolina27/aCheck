<template>
    <div class="container-fluid">
      <h3 class="mt-4">Moduls</h3>
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Codi</th>
            <th>Nom</th>
            <th>Autoavaluacio</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(modul, index) in moduls" :key="modul.id">
            <td>{{ index + 1 }}</td>
            <td>{{ modul.codi }}</td>
            <td>{{ modul.nom }}</td>
            <td>
              <button class="btn btn-info" @click="selectModul(modul)">
                <i class="fas fa-eye"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

<script>
 import { fetchAllModules } from '../../services/modules.js';

export default {
    emits: ['updateSelectedModul'],

    data() {
        return {
            moduls: [],
        };
    },

    mounted() {
        fetchAllModules().then((data) => {
        this.moduls = data;
      });
    },

    methods: {
        selectModul(modul) {
            console.log(modul);
            this.$emit('updateSelectedModul', modul);
        },
    },

    
}
</script>
