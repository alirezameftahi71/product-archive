<template>
  <div>
    <b-form-tags input-id="inputId" v-model="value" no-outer-focus class="mb-2" :separator="seperators">
      <template v-slot="{ tags, inputAttrs, inputHandlers, tagVariant, addTag, removeTag }">
        <b-input-group class="mb-2">
          <b-form-input
            v-bind="inputAttrs"
            ref="input"
            v-on:input="onInputChange"
            v-on="inputHandlers"
            placeholder="To add tags press ; , or enter"
            class="form-control"
          ></b-form-input>
          <b-input-group-append>
            <b-button @click="addTag()" variant="outline-secondary">Add</b-button>
          </b-input-group-append>
        </b-input-group>
        <div class="dropdown-menu dropdown-items-container" :class="{ show: isDropdownVisible }">
          <a
            class="dropdown-item"
            v-for="item in suggestItems"
            :key="item.id"
            href="#"
            @click="
              addTag(item.name);
              isDropdownVisible = false;
            "
            >{{ item.name }}</a
          >
        </div>

        <div class="d-inline-block">
          <b-form-tag v-for="tag in tags" @remove="removeTag(tag)" :key="tag" :title="tag" :variant="tagVariant" class="mr-1">{{
            tag
          }}</b-form-tag>
        </div>
      </template>
    </b-form-tags>
  </div>
</template>

<script>
export default {
  props: {
    inputId: String
  },
  data() {
    return {
      isDropdownVisible: false,
      seperators: ",;",
      value: [],
      suggestItems: [
        { id: 1, name: "Iran" },
        { id: 2, name: "China" }
      ]
    };
  },
  methods: {
    toLowerCaseOrDefault(val) {
      return (val || "").toLowerCase();
    },
    onInputChange(val) {
      val = val.trim();
      if (!val) {
        this.isDropdownVisible = false;
        this.suggestItems = [];
      } else {
        this.axios
          .get("/api/genres")
          .then(response => {
            const data = response.data.filter(x => this.toLowerCaseOrDefault(x.name).includes(this.toLowerCaseOrDefault(val)));
            this.suggestItems = data.splice(0, 4);
            if (this.suggestItems && this.suggestItems.length) {
              this.isDropdownVisible = true;
            } else {
              this.isDropdownVisible = false;
            }
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
<style lang="scss" scoped>
.dropdown-items-container {
  top: initial;
  left: initial;
}
</style>