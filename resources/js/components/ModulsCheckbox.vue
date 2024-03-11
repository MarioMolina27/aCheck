<template>
    <div class="container-fluid" ref="myComponentRef">
        <div class="row mt-4">
            <div class="col-12 ps-0">
                <div class="form-floating">
                    <select
                        class="form-select"
                        id="cicle"
                        name="cicleSelect"
                        aria-label="Floating label select example"
                        @change="fetchModules"
                    >
                        <option
                            v-for="c in cicles"
                            :value="c.id"
                            :selected="cicle && cicle.id === c.id"
                        >
                            {{ c.sigles }}
                        </option>
                    </select>
                    <label for="cicle">Cicle</label>
                </div>
            </div>
        </div>

        <div v-if="internalModules && internalModules.length > 0">
            <div v-for="modul in internalModules" :key="modul.id">
                <div class="form-check mt-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        :value="modul.id"
                        :id="'modul' + modul.id"
                        name="moduls[]"
                        :checked="isModuleSelected(modul.id)"
                    />
                    <label class="form-check-label" :for="'modul' + modul.id">
                        {{ modul.nom }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { fetchModulesByCicle } from "../services/modules.js";


export default {
    props: {
        modules: Array,
        modules_selected: Array,
        cicles: Array,
        cicle: Object,
    },

    data() {
        return {
            internalModules: [...this.modules],
        };
    },
    
    methods: {
        isModuleSelected(moduleId) {
            return this.modules_selected.some(
                (module) => module.id === moduleId
            );
        },

        fetchModules(event) {
            const selectedValue = event.target.value;

            fetchModulesByCicle(selectedValue).then((data) => {
                this.internalModules = data;
            });
        },
    },
};
</script>
