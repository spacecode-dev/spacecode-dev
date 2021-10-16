<template>
  <div id="messengers">
    <OrbitalsLoader v-if="!loaded"/>
    <div class="add" :class="{'loading': !loaded}">
      <div class="form-group">
        <label for="nameInput">{{ $t('Your name') }}</label>
        <input id="nameInput" type="text" class="form-control" name="name" v-model="fields.name" :placeholder="$t('Enter name')">
      </div>

      <div class="form-group">
        <label>{{ $t('Briefly about') }}</label>
        <textarea class="form-control" name="about" v-model="fields.about" rows="3"/>
      </div>

      <div class="form-group">
        <label for="emailInput">{{ $t('Your email') }}</label>
        <input id="emailInput" type="email" class="form-control" name="email" v-model="fields.email" aria-describedby="emailHelp" :placeholder="$t('Enter email')">
        <small id="emailHelp" class="form-text">{{ $t('we will never share your email with anyone else.') }}</small>
      </div>

      <button type="submit" class="btn btn-primary">{{ $t('Send message') }}</button>

    </div>
  </div>
</template>

<script>
import OrbitalsLoader from './Loader.vue'
import axios from 'axios'

export default {
  name: 'contact-form',
  props: ['contactData'],
  data() {
    return {
      config: {
        headers: {
          'Authorization': 'Bearer 2|2ySAX2CnwBNL5yre3OuRoWBgy8bs9ZNgaV97f37p'
        }
      },
      fields: {},
      loaded: false,
      isCurrent: null
    }
  },
  components: {
    OrbitalsLoader,
  },
  mounted() {
    if (typeof this.contactData !== 'undefined') {
      this.isCurrent = JSON.parse(this.contactData)
    }
    this.clearForm()
    this.loaded = true
    // dataLayer.push({
    //   category: "order"
    // })
    // console.log(dataLayer)
    // gtag('event', 'send', {
    //   'event_category': 'forms'
    // }); return true;
  },
  methods: {
    showNotify() {
      setTimeout(function () {
        [].forEach.call(document.querySelectorAll('[data-notify="container"]'), function (item) {
          item.classList.add('show')
          setTimeout(function () {
            item.classList.remove('show')
          }, 4000)
          document.querySelectorAll('[data-notify="dismiss"]').onclick = function (event) {
            event.preventDefault()
            item.classList.remove('show')
          }
        })
      }, 500);
    },
    showNotification(type, icon, message, from, align) {
      $.notify({icon: icon, message: message}, {allow_dismiss: false, type: type, z_index: 999999, newest_on_top: true, delay: 150000000, timer: 2500, placement: {from: from, align: align}})
    },
    clearForm: function () {
      this.fields = {
        name: '',
        email: '',
        about: ''
      }
    },
    onSubmit: function () {
      if (this.loaded) {
        let _this = this, _current = this.isCurrent
        _this.loaded = false
        axios.post(location.origin + '/api/requests/put', {type: _current.type, data: this.fields, source: location.origin, lang: _current.lang}, this.config).then(response => {
          let urlParams = new URLSearchParams(window.location.search)
          if (typeof fbq !== 'undefined' && urlParams.get('utm_source') === 'facebook') {
            fbq.push('track', 'Lead', {
              content_category: 'contact_form'
            })
          }
          _this.showNotification('success', 'notifications', response.data.success, 'top', 'center')
          _this.showNotify()
          _this.clearForm()
          setTimeout(function () {
            _this.loaded = true
          }, 1000)
        }).catch(error => {
          if (typeof error.response !== 'undefined' && error.response.status === 422) {
            let data = error.response.data.errors
            _this.showNotification('danger', 'notifications', data[Object.keys(data)[0]], 'top', 'center')
            _this.showNotify()
            setTimeout(function () {
              _this.loaded = true
            }, 1000)
          }
        })
      }
    }
  }
}
</script>