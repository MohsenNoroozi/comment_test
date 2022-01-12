<template>
    <div>
        <v-system-bar app>
            <div class="caption">This is just a test project</div>
            <v-spacer></v-spacer>
            <v-icon>mdi-square</v-icon>
            <v-icon>mdi-circle</v-icon>
            <v-icon>mdi-triangle</v-icon>
        </v-system-bar>
        <v-app-bar app clipped-right flat height="60">
            <v-spacer></v-spacer>
            <v-responsive max-width="156">
                <v-text-field dense flat hide-details rounded solo-inverted/>
            </v-responsive>
        </v-app-bar>
    </div>
</template>

<script>
export default {
    data() {
        return {
            img: 'logo.png'
        }
    },
}
</script>
