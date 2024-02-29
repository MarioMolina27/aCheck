<template>
    <div class="container-fluid">
        <h3 class="mt-4">Alumnes Modul {{ this.selectedModul.codi }}</h3>
        <table
            v-if="alumnes.length > 0"
            class="table table-striped table-hover"
        >
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Cognoms</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(alumne, index) in alumnes" :key="alumne.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ alumne.nom }}</td>
                    <td>{{ alumne.cognom }}</td>
                    <td>{{ alumne.correu }}</td>
                    <td>
                        <button
                            class="btn btn-info"
                            @click="selectAlumne(alumne)"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <h5 class="title-resultat">No hi ha resultats per aquest mòdul</h5>
        </div>
    </div>
    <div class="row me-3">
            <div class="col-10"></div>
            <div class="col-2">
                <div class="btn btn-lg btn-primary mt-3 mb-3" @click="this.$emit('returnToModules')">Selecció de moduls</div>
            </div>
        </div>
</template>

<script>
import { fecthAlumnesByModul } from "../../services/usuaris.js";
export default {
    props: {
        selectedModul: Object,
    },

    data() {
        return {
            alumnes: [],
        };
    },

    mounted() {
        console.log(this.selectedModul.id);
        fecthAlumnesByModul(this.selectedModul.id).then((data) => {
            this.alumnes = data;
        });
    },

    methods: {
        selectAlumne(alumne) {
            console.log(alumne);
            this.$emit("updateSelectedAlumne", alumne);
        },
    },
};
</script>
