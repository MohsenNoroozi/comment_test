<template>
    <v-list-item :ripple="false" inactive>
        <v-list-item-content>
            <v-list-item-title class="text--h5" v-text="comment['user_name']"/>
            <v-list-item-subtitle class="caption pb-3" v-text="comment['created_at']"/>
            <v-list-item-subtitle class="text--body" v-text="comment['comment_text']"/>
        </v-list-item-content>

        <v-list-item-action v-if="canReply">
            <v-btn icon @click.stop="reply">
                <v-icon>mdi-reply</v-icon>
            </v-btn>
        </v-list-item-action>
    </v-list-item>
</template>

<script>
export default {
    name: "CommentItem",
    props: {
        comment: {
            type: Object,
            required: true
        },
        canReply: {
            type: Boolean,
            default: true
        }
    },
    methods: {
        reply() {
            this.$emit('openDialog', this.comment.id)
        }
    }
}
</script>
