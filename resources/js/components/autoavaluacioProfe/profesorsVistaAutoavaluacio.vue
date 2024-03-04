<template>
    <div class="container-fluid">
        <h3 class="mt-4">Alumne {{ this.alumne.nom }}  {{ this.alumne.cognom }} Autoavaluació Modul {{ this.modul.codi }}</h3>

        <div class="card card-custom mt-4">
            <div class="card-body">
                <div
                    v-if="resultats.length > 0"
                    v-for="resultat in resultats"
                    :key="resultat.id"
                >
                    <h5 class="title-resultat">
                        {{ resultat.id + ". " + resultat.descripcio }}
                    </h5>
                    <div class="row mb-1" v-for="criteri  in resultat.criteris_avaluacio"
                                :key="criteri.id">
                        <div class="col-10">
                            <p>{{ criteri.descripcio }}</p>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center selected-nota"  :id="'card-nota-' + String.fromCharCode(64 + criteri.usuari_has_criteris_avaluacio[0].pivot.nota)">
                            {{ criteri.usuari_has_criteris_avaluacio[0].pivot.nota }}
                        </div>

                    </div>
                </div>
                <div v-else>
                    <h5 class="title-resultat">
                        No hi ha resultats per aquest mòdul
                    </h5>
                </div>
            </div>
        </div>
        <div class="row me-3">
            <div class="col-11"></div>
            <div class="col-1">
                <div class="btn btn-lg btn-primary mt-3 mb-3" @click="this.$emit('returnToModules')">Finalitzar</div>
            </div>
        </div>
    </div>
</template>

<script>
import { fetchResultatsByModuls } from "../../services/resultats.js";


export default {
    emits: ['returnToModules'],

    props: {
        alumne: Object,
        modul: Object,
        accesstoken: String,
    },

    data() {
        return {
            resultats: [],
        };
    },

    mounted() {
        fetchResultatsByModuls(this.modul.id, this.alumne.id,this.accesstoken).then((data) => {
            this.resultats = data;
        });
    },
};
</script>
