<template>
    <div
        v-for="(r, index) in rubrica"
        :key="r.id"
        class="col-12 col-md-6' col-lg-4"
    >
        <div
            :class="[
                'card-custom d-flex justify-content-center align-items-center ps-3 pe-3 mb-2 pointer',
                {
                    'selected-nota':
                        index + 1 === this.internCriteriNota[0].pivot.nota,
                },
            ]"
            style="height: 200px"
            :id="'card-nota-' + String.fromCharCode(65 + index)"
            :data-id="r.criteris_avaluacio_id"
            @click="handleClick(r.criteris_avaluacio_id, index + 1)"
        >
            <p class="mb-0">{{ r.descripcio }}</p>
        </div>
    </div>
</template>

<script>
import { updateNotaCriters } from "../../services/criteris.js";
export default {
    emits: ["show-toast-error"],

    props: {
        rubrica: Array,
        criteriNota: Array,
        idUser: Number,
        accesstoken: String,
    },

    data() {
        return {
            internCriteriNota: this.criteriNota,
        };
    },

    methods: {
        handleClick(dataId, nota) 
        {
            if (this.internCriteriNota[0].pivot.nota !== nota) 
            {
                const oldData = this.internCriteriNota[0].pivot.nota;
                this.internCriteriNota[0].pivot.nota = nota;

                updateNotaCriters(dataId, this.idUser, nota, this.accesstoken)
                    .then((data) => {})
                    .catch((error) => {
                        this.internCriteriNota[0].pivot.nota = oldData;
                        this.showToastError(error);
                    });
            }
        },

        showToastError(error) {
            this.$emit("show-toast-error", error);
        },
    },
};
</script>
