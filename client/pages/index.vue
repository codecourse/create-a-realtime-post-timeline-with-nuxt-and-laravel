<template>
  <div class="bg-white shadow-sm rounded p-6 border border-gray-300">
    <div class="border-b pb-6">
      <AppPostForm v-if="$auth.loggedIn" />
      <p v-else><nuxt-link :to="{ name: 'login' }" class="text-indigo-500">Login</nuxt-link> to post</p>
    </div>

    <AppPost v-for="post in posts" :key="post.id" :post="post" />
    <div v-observe-visibility="visibilityChanged"></div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'

export default {
  data () {
    return {
      page: 1
    }
  },

  computed: {
    ...mapGetters({
      posts: 'posts/posts'
    })
  },

  methods: {
    ...mapMutations({
      SET_LIKES: 'posts/SET_LIKES'
    }),

    ...mapActions({
      getPosts: 'posts/getPosts',
      getMorePosts: 'posts/getMorePosts',
      getSinglePost: 'posts/getSinglePost'
    }),

    visibilityChanged (isVisible) {
      if (!isVisible) {
        return
      }

      ++this.page
      this.getMorePosts(this.page)
    }
  },

  mounted () {
    this.getPosts()

    this.$echo.channel('posts')
      .listen('PostCreated', (e) => {
        this.getSinglePost(e.post_id)
      })
      .listen('PostLiked', (e) => {
        this.SET_LIKES({ postId: e.post_id, likeCount: e.likes })
      })
  }
}
</script>