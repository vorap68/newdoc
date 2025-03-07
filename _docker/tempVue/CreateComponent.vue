<template>
  <div class="w-50">
    <div class="mb-3">
      <input
        type="text"
        class="form-control"
        id="name"
        placeholder="name"
        v-model="name"
      />
    </div>
    <div class="mb-3">
      <input
        type="number"
        class="form-control"
        id="price"
        placeholder="price"
        v-model="price"
      />
    </div>
    <div class="mb-3">
      <input
        type="number"
        class="form-control"
        id="count"
        placeholder="count"
        v-model="count"
      />
      <div class="mb-3">
        <input
          type="number"
          class="form-control"
          id="category_id"
          placeholder="category_id"
          v-model="category_id"
        />
      </div>
      <div class="mb-3">
        <input
          @click.prevent="addProducts"
          class="btn btn-success"
          value="Добавить"
        />
      </div>
    </div>
    <SomeComponent></SomeComponent>
  </div>
</template>

<script>
import SomeComponent from "./SomeComponent.vue";

export default {
  name: "CreateComponent",

  data() {
    return {
      name: null,
      price: null,
      count: null,
      category_id: null,
    };
  },

  mounted() {
    this.$parent.$refs.index.indexlog();
  },

  methods: {
    addProducts() {
      axios
        .post("/api/vue/store", {
          name: this.name,
          count: this.count,
          price: this.price,
          category_id: this.category_id,
        })
        .then((res) => {
          (this.name = null),
            (this.price = null),
            (this.count = null),
            (this.category_id = null),
            this.$parent.$refs.index.getAllProducts();
        });
    },
  },
  components: {
    SomeComponent,
  },
};
</script>