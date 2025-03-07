<template>
  <div>
    <CreateComponent></CreateComponent>
    <IndexComponent ref="index"></IndexComponent>
  </div>
</template>

<script>
import CreateComponent from "./CreateComponent.vue";
import IndexComponent from "./IndexComponent.vue";

export default {
  name: "MainComponent",

  data() {
    return {
      products: null,
    };
  },

  mounted() {
    //this.$refs.index.indexlog();
  },

  methods: {
    parentlog() {
      console.log("It is parent component");
    },
  },

  components: {
    CreateComponent,
    IndexComponent,
  },
};
</script>

<style scope>
</style>
