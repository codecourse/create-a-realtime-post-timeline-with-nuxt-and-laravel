<template>
  <nav class="flex items-center justify-between mb-6 -mx-3">
    <nuxt-link :to="{ name: 'index' }" class="text-indigo-500 mx-3">Liker</nuxt-link>

    <ul class="flex items-center">
      <template v-if="!$auth.loggedIn">
        <li>
          <nuxt-link :to="{ name: 'login' }" class="text-indigo-500 mx-3">Login</nuxt-link>
        </li>
        <li>
          <nuxt-link :to="{ name: 'register' }" class="text-indigo-500 mx-3">Register</nuxt-link>
        </li>
      </template>

      <template v-if="$auth.loggedIn">
        <li>
          <a href="#" @click.prevent="logout" class="text-indigo-500 mx-3">Logout</a>
        </li>
      </template>
    </ul>
  </nav>
</template>

<script>
export default {
  methods: {
    async logout () {
      await this.$auth.logout()
      this.$router.replace({ name: 'index' })
    }
  }
}
</script>