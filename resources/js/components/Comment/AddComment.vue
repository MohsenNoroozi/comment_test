<template>
    <v-form class="mt-8 mb-2">
        <v-row dense>
            <v-col cols="12" md="3">
                <v-text-field filled v-model="comment['user_name']" hide-details label="Your Name" required/>
            </v-col>

            <v-col cols="12" md="9">
                <v-textarea
                    filled auto-grow required
                    rows="1" row-height="30"
                    v-model="comment['comment_text']"
                    hide-details
                    label="Your Comment"
                />
            </v-col>
            <v-col cols="12" align="end">
                <v-btn
                    right outlined
                    :loading="loading"
                    :disabled="!valid"
                    @click="createComment"
                >
                    <v-icon left>mdi-plus</v-icon>
                    Add
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>

<script>
import {api} from "../../util/xhr";

export default {
    data: () => ({
        loading: false,
        comment: {
            user_name: null,
            comment_text: null
        },
    }),
    computed: {
        valid() {
            return !!this.comment['user_name'] && !!this.comment['comment_text']
        }
    },
    methods: {
        createComment: function () {
            this.loading = true
            api()
                .post('comments', this.comment)
                .then(r => {
                  this.$root.$emit('comments_update', r.data)
                  this.$store.commit('notifications/setMessage', 'Your comment successfully added.')
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
