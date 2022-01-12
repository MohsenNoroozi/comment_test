<template>
    <v-dialog :value="id" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="text-h5">Reply</span>
            </v-card-title>
            <v-card-text>
                <v-text-field outlined hide-details class="mb-4" v-model="comment['user_name']" label="Your Name" required/>
                <v-textarea
                    outlined auto-grow required hide-details
                    v-model="comment['comment_text']"
                    label="Your Comment"
                />
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="$emit('closeDialog')">
                    Close
                </v-btn>
                <v-btn
                    color="primary"
                    :loading="loading"
                    :disabled="!comment['user_name'] || !comment['comment_text']"
                    @click="reply"
                >
                    <v-icon left>mdi-send</v-icon>
                    Send
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {api} from "../../util/xhr";

export default {
    props: ['id'],
    data: () => ({
        loading: false,
        comment: {}
    }),
    methods: {
        reply() {
            this.loading = true
            api()
                .post('reply', {...this.comment, parent_id: this.id})
                .then(r => this.$emit('addChild', r.data))
                .finally(() => this.loading = false)
        }
    }
}
</script>
