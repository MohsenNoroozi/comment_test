<template>
    <V-row justify="center">
        <v-col cols="12" xl="10">
            <SampleBlogPost/>
        </v-col>
        <v-col cols="12" xl="9">
            <CommentList v-if="!loading" :comments="comments"/>
            <ProgressLinear v-else/>
        </v-col>
    </V-row>
</template>

<script>
import SampleBlogPost from "../components/Comment/SampleBlogPost";
import AddComment from "../components/Comment/AddComment";
import CommentList from "../components/Comment/CommentList";
import {api} from "../util/xhr";
import ProgressLinear from "../components/Loader/ProgressLinear";

export default {
    name: "Blog",
    components: {ProgressLinear, CommentList, AddComment, SampleBlogPost},
    data: () => ({
        loading: false,
        comments: []
    }),
    methods: {
        getComments: function () {
            this.loading = true
            api()
                .get('comments')
                .then(r => this.comments = r.data)
                .finally(() => this.loading = false)
        }
    },
    mounted() {
        this.getComments()
        this.$root.$on('comments_update', comment => {
            this.comments.unshift(comment)
        });
    },
}
</script>
