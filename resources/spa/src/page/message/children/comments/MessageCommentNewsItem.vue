<template>
  <section>
    <div :class="`${prefixCls}-item-top`">
      <Avatar :user="comment.user" />
      <section class="userInfo">
        <!-- eslint-disable-next-line vue/component-name-in-template-casing -->
        <i18n v-if="comment.reply_user" path="message.comment.reply">
          <RouterLink
            place="user1"
            :class="`${prefixCls}-item-top-link`"
            :to="`/users/${comment.user_id}`"
          >
            {{ comment.user.name }}
          </RouterLink>
          <RouterLink
            place="user2"
            :class="`${prefixCls}-item-top-link`"
            :to="`/users/${comment.reply_user}`"
          >
            {{ comment.reply.name }}
          </RouterLink>
        </i18n>
        <!-- eslint-disable-next-line vue/component-name-in-template-casing -->
        <i18n
          v-else
          path="message.comment.commented"
          :places="{type: $t('article.type.news')}"
        >
          <RouterLink
            place="user"
            :class="`${prefixCls}-item-top-link`"
            :to="`/users/${comment.user_id}`"
          >
            {{ comment.user.name }}
          </RouterLink>
        </i18n>

        <p>{{ comment.created_at | time2tips }}</p>
      </section>
      <section class="msgList-status">
        <section class="gray">
          <span class="reply-show" @click.stop="showCommentInput">
            {{ $t('reply.name') }}
          </span>
        </section>
      </section>
    </div>
    <div :class="`${prefixCls}-item-bottom`">
      <span class="content" @click.stop="showCommentInput">
        {{ comment.body }}
      </span>
      <!-- <section v-if="comment.commentable !== null" @click="goToDetail()"> -->
      <section v-if="comment.commentable !== null">
        <div
          v-if="!getImage"
          :class="`${prefixCls}-item-bottom-noImg`"
          class="content"
        >
          {{ comment.commentable.title }}
        </div>
        <div v-else :class="`${prefixCls}-item-bottom-img`">
          <div class="img">
            <img :src="getImage" :alt="comment.user.name">
          </div>
          <div class="content">
            {{ comment.commentable.title }}
          </div>
        </div>
      </section>
      <section v-if="comment.commentable === null">
        <div :class="`${prefixCls}-item-bottom-noImg`" class="content">
          文章已被删除
        </div>
      </section>
    </div>
  </section>
</template>

<script>
import MessageCommentItemBase from './MessageCommentItemBase'

export default {
  name: 'MessageCommentNewsItem',
  extends: MessageCommentItemBase,
  methods: {
    goToDetail () {
      const {
        commentable: { id = 0 },
      } = this.comment
      this.$router.push(`/news/${id}`)
    },
    sendComment (comment) {
      const { commentable_id: newsId = 0, user_id: userId = 0 } = this.comment
      this.$http
        .post(
          `/news/${newsId}/comments`,
          {
            reply_user: userId,
            body: comment,
          },
          {
            validateStatus: s => s === 201,
          }
        )
        .then(() => {
          this.$Message.success(this.$t('reply.success'))
          this.$bus.$emit('commentInput:close', true)
        })
    },
  },
}
</script>
