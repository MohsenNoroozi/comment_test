<template>
  <v-list two-line flat>
    <template v-for="(comment, i) in comments">
      <CommentItem :key="`comment-${comment.id}`" :comment="comment" v-on:openDialog="openDialog($event)"/>
      <div class="pl-4" v-for="(child1) in comment.children" :key="`comment-${child1.id}`">
        <CommentItem :key="`comment-${child1.id}`" :comment="child1" v-on:openDialog="openDialog($event)"/>

        <div class="pl-8" v-for="(child2) in child1.children" :key="`comment-${child2.id}`">
          <CommentItem :key="`comment-${child2.id}`" :comment="child2" :canReply="false"
                       v-on:openDialog="openDialog($event)"/>
        </div>
      </div>
      <v-divider v-if="i < comments.length - 1" :key="i"/>
    </template>
    <ReplyComment
        :id="replyCommentId"
        v-on:closeDialog="closeDialog"
        v-on:addChild="addChild($event)"
    />
  </v-list>
</template>

<script>
import CommentItem from "./CommentItem";
import ReplyComment from "./ReplyComment";

export default {
  components: {ReplyComment, CommentItem},
  props: {
    comments: {
      type: Array,
    },
  },
  data: () => ({
    replyCommentId: null
  }),
  methods: {
    openDialog(id) {
      this.replyCommentId = id
    },
    closeDialog() {
      this.replyCommentId = null
    },
    addChild(newComment) {
      this.comments.forEach(
          cmt => {
            if (cmt.id === newComment['parent_id']) cmt.children.unshift(newComment)
            else if(cmt.children && cmt.children.length > 0)
              cmt.children.forEach(
                  child1 => {
                    if (child1.id === newComment['parent_id']) child1.children.unshift(newComment)
                    else if(child1.children && child1.children.length > 0) child1.children.forEach(child2 => {
                      if (child2.id === newComment['parent_id']) child2.children.unshift(newComment)
                    })
                  })
          }
      )
      this.closeDialog()
    }
  }
}
</script>
