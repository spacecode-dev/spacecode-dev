<template>
  <default-field :field="field">
    <template slot="field">
      <input :id="field.name" type="checkbox"
             :class="custom_color(field.color)"
             :style.checked="getCustomStyle()"
             :placeholder="field.name"
             v-model="value"
             v-bind:true-value="1"
             v-bind:false-value="0"
      />
      <p v-if="hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>
    </template>
  </default-field>
</template>


<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['resourceName', 'resourceId', 'field'],
  data: function () {
    return {
      is_code: false,
    }
  },
  created: function(){
    if (!this.field.color) {
      this.field.color = '#43D559';
    }
  },
  methods: {
    getCustomStyle() {
      if (this.value) {
        if (this.is_code === true) {
          return "color : " + this.field.color + "; border-color :" + this.field.color
        }
      }
      return ""
    },
    setInitialValue() {
      this.value = this.field.value || ''
    },
    fill(formData) {
      formData.append(this.field.attribute, Number(this.value) || Number(0))
    },
    handleChange(value) {
      this.value = value
    },
    custom_color(color) {
      if (color.indexOf("#") === 0) {
        this.is_code = true
        return 'custom-color';
      }
      this.is_code = false;
      return this.color;
    }
  }
}
</script>