<template>
  <v-snackbar :value="snackbar" :timeout="-1" color="error" bottom right light>
    <v-icon class="px-2">mdi-alert-circle</v-icon>
    {{ message }}
    <template v-slot:action="{ attrs }">
      <v-btn icon small v-bind="attrs" @click="snackbar = false">
        <v-icon small>mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import {mapState} from 'vuex';

export default {
  name: "Errors",
  data() {
    return {
      snackbar: false,
    }
  },
  computed: {
    ...mapState('errors', {
      message: state => state.message
    }),
  },
  watch: {
    message(msg) {
      this.snackbar = !!msg;
    },
  },
}
</script>