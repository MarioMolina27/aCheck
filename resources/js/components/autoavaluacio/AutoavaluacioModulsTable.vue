<template>
    <div class="container-fluid">
        <table v-if="moduls.length > 0" class="table table-striped table-hover">
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
                        <button class="btn btn-info" @click="editModul(modul)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <h5 class="title-resultat">No tens moduls matriculats</h5>
        </div>
    </div>
</template>

<script>
import { fetchModulesByUsuari } from "../../services/modules.js";
export default {
    emits: ["edit-modul"],
    props: {
        usuari: Object,
        accesstoken: String,
    },
    methods: {
        editModul(modul) {
            this.$emit("edit-modul", modul);
        },
    },
    data() {
        return {
            moduls: [],
        };
    },

    mounted() {
        console.log(this.accesstoken);
        fetchModulesByUsuari(this.usuari.id,this.accesstoken).then((data) => {
            this.moduls = data;
        });
    },
};
</script>
