<template>
    <div>
        <alumnes-modul-table v-if="showAlumneData ==='users' " :selectedModul="selectedModul" @updateSelectedAlumne="updateSelectedAlumne"  @returnToModules="returnToModules" :accesstoken="accesstoken"></alumnes-modul-table>
        <profesors-vista-autoavaluacio v-else-if="showAlumneData === 'autoavaluacio'" :alumne="selectedAlumne" :modul="selectedModul" @returnToModules="returnToModules" :accesstoken="accesstoken"></profesors-vista-autoavaluacio>
        <modules-profe-table v-else @updateSelectedModul="updateSelectedModul" :accesstoken="accesstoken"></modules-profe-table>
    </div>
</template>

<script>
import modulesProfeTable from './modulesProfeTable.vue';
import alumnesModulTable from './alumnesModulTable.vue';
import profesorsVistaAutoavaluacio from './profesorsVistaAutoavaluacio.vue';

export default {
    props:{
        usuari: Object,
        accesstoken: String
    },

    data() {
        return {
            showAlumneData: '',
            selectedModul: Object,
            selectedAlumne: Object,
        }
    },

    components: {
        alumnesModulTable,
        modulesProfeTable,
        profesorsVistaAutoavaluacio
    },

    methods: {
        updateSelectedModul(modul) {
            this.selectedModul = modul;
            this.showAlumneData = 'users';
        },

        updateSelectedAlumne(alumne) {
            this.selectedAlumne = alumne;
            this.showAlumneData = 'autoavaluacio';
        },

        returnToModules() {
            this.showAlumneData = '';
        }
    }
}
</script>