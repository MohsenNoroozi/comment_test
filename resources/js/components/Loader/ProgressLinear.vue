<template>
  <v-container style="height: 150px;">
    <v-row class="fill-height" align-content="center" justify="center">
      <v-col class="primaryConst--text subtitle-1 text-center" cols="12">
        Loading ...
      </v-col>
      <v-col cols="6" lg="4">
        <v-progress-linear color="primaryConst" indeterminate rounded height="4"/>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "ProgressLinear"
}
</script>