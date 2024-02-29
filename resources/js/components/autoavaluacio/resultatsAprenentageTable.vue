<template>
    <div class="container-fluid">
        <div class="card card-custom">
            <div class="card-body">
                <div
                    v-if="resultats.length > 0"
                    v-for="resultat in resultats"
                    :key="resultat.id"
                >
                    <h5 class="title-resultat">
                        {{ resultat.id + ". " + resultat.descripcio }}
                    </h5>
                    <div
                        class="ms-4"
                        v-for="criteri in resultat.criteris_avaluacio"
                        :key="criteri.id"
                    >
                        <p class="fw-bold">{{ criteri.descripcio }}</p>
                        <div class="row mb-5">
                            <buttons-autoavaluacio
                                :rubrica="criteri.rubrica"
                                :criteriNota="
                                    criteri.usuari_has_criteris_avaluacio
                                "
                                :idUser="this.usuari.id"
                                @show-toast-error="showToastError"
                            ></buttons-autoavaluacio>
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
                <div
                    class="btn btn-lg btn-primary mt-3 mb-3"
                    @click="stateEditOriginal()"
                >
                    Finalitzar
                </div>
            </div>
        </div>
    </div>
    <Toaster richColors position="top-right" />
</template>

<script>
import { fetchResultatsByModuls } from "../../services/resultats.js";
import ButtonsAutoavaluacio from "./ButtonsAutoavaluacio.vue";
import { Toaster, toast } from "vue-sonner";

export default {
    emits: ["state-edit-original"],

    props: {
        usuari: Object,
        modul: Object,
    },

    components: {
        ButtonsAutoavaluacio,
        Toaster,
    },

    data() {
        return {
            resultats: [],
        };
    },

    mounted() {
        fetchResultatsByModuls(this.modul.id, this.usuari.id).then((data) => {
            this.resultats = data;
        });
    },

    methods: {
        stateEditOriginal() {
            this.$emit("state-edit-original");
        },

        showToastError(error) {
            toast.error("Error al guardar les dades. " + error);
        },
    },
};
</script>
