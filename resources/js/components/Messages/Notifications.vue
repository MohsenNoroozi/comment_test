<template>
  <v-snackbar :value="snackbar" color="success" bottom right light @input="changeSnackbar">
    <v-icon class="px-2">mdi-chek</v-icon>
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
  name: "Notifications",
  data() {
    return {
      snackbar: false,
    }
  },
  computed: {
    ...mapState('notifications', {
      message: state => state.message
    }),
  },
  methods: {
    changeSnackbar() {
      if (this.snackbar) this.$store.commit('notifications/setMessage', null);
    }
  },
  watch: {
    message(msg) {
      this.snackbar = !!msg;
    },
  },
}
</script>