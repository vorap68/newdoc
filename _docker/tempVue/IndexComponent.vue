<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">count</th>
          <th scope="col">price</th>
          <th scope="col">category_id</th>
          <th scope="col">edit</th>
          <th scope="col">delete</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(product, index) in products">
          <tr>
            <th scope="row">{{ index }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.count }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.category_id }}</td>
            <td>
              <a
                href="#"
                @click.prevent="
                  changeIdProduct(
                    product.id,
                    product.name,
                    product.count,
                    product.price,
                    product.category_id
                  )
                "
                class="btn btn-success"
                >Edit</a
              >
            </td>
            <td>
              <a
                href="#"
                @click.prevent="deleteProduct(product.id)"
                class="btn btn-danger"
                >Delete</a
              >
            </td>
          </tr>
          <tr :class="isEdit(product.id) ? '' : 'd-none'" :key="product.id">
            <th scope="row"></th>
            <td><input type="text" v-model="name" class="form-control" /></td>
            <td>
              <input type="number" v-model="count" class="form-control" />
            </td>
            <td>
              <input type="number" v-model="price" class="form-control" />
            </td>
            <td>
              <input type="number" v-model="category_id" class="form-control" />
            </td>
            <td>
              <a
                href="#"
                @click.prevent="updateProduct(product.id)"
                class="btn btn-success"
                >Update</a
              >
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "IndexComponent",

  data() {
    return {
      products: null,
      idChange: null,
      name: null,
      count: null,
      price: null,
      category_id: null,
    };
  },

  mounted() {
    this.getAllProducts();
    this.$parent.parentlog();
  },

  methods: {
    getAllProducts() {
      axios.get("/api/vue/index").then((res) => {
        this.products = res.data;
      });
    },
    changeIdProduct(id, name, count, price, category_id) {
      this.name = name;
      this.price = price;
      this.count = count;
      this.category_id = category_id;
      console.log(id);
      this.idChange = id;
    },
    isEdit(id) {
      return this.idChange === id;
    },

    updateProduct(id) {
      this.idChange = null;
      console.log(this.name, this.price, this.count, this.category_id);
      axios
        .patch("/api/vue/update/" + id, {
          name: this.name,
          count: this.count,
          price: this.price,
          category_id: this.category_id,
        })
        .then((res) => {
          this.getAllProducts();
        });
    },

    deleteProduct(id) {
      axios.delete("/api/vue/delete/" + id).then((res) => {
        this.getAllProducts();
      });
    },

    indexlog() {
      console.log("It is  indexLog");
    },
  },

  components: {},
};
</script>

<style scope>
</style>
