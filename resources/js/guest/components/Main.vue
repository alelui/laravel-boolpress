<template>
  <div>
      <main>
          <h2>Main</h2>
          <ul>
              <li v-for="post in posts" :key="post.id">
                  <h3>{{post.title}}</h3>
              </li>
          </ul>
      </main>
  </div>
</template>

<script>
export default {
    name :'Main',
    data() {
        return {
            posts: []
        }
    },
    created() {
        axios.get('api/posts')
            .then( (response) => {
                /* console.log(response.data); */
                this.posts = response.data
            })
    }
}
</script>

<style>

</style>