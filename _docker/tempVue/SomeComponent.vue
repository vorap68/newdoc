<template>
  <div>777777</div>
</template>

<script>
export default {
  name: "SomeComponent",

  mounted() {
    this.$parent.$parent.parentlog();
  },
};
</script>