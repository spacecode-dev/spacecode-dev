<template>
  <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <OrbitalsLoader v-if="!loaded"/>
      <div class="modal-content" v-if="isCurrent">
        <div class="modal-header">
          <h5 class="modal-title">{{ $t('Request a Quote') }}</h5>
          <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path d="M474.427 30.108H310.672a7.515 7.515 0 100 15.03h163.754c12.43 0 22.544 10.113 22.544 22.544v263.007h-36.028l-.001-230.847c0-12.431-10.114-22.544-22.544-22.544H73.602c-12.431 0-22.544 10.113-22.544 22.544v230.847H15.029V67.681c0-12.431 10.114-22.544 22.544-22.544h243.04a7.515 7.515 0 100-15.03H37.573C16.855 30.108 0 46.963 0 67.681v303.848c0 20.718 16.855 37.573 37.573 37.573h165.231l-7.574 57.761h-26.702a7.515 7.515 0 100 15.03h174.943a7.515 7.515 0 100-15.03H316.77l-7.574-57.761h79.629a7.515 7.515 0 100-15.03H37.573c-12.43 0-22.544-10.113-22.544-22.544v-25.811H496.97v25.811c0 12.431-10.114 22.544-22.544 22.544h-55.543a7.515 7.515 0 100 15.03h55.543c20.718 0 37.573-16.855 37.573-37.573V67.681c.001-20.718-16.854-37.573-37.572-37.573zM301.612 466.863h-91.223l7.574-57.761h76.074zM66.087 99.841c0-4.144 3.371-7.515 7.515-7.515h364.796c4.144 0 7.515 3.371 7.515 7.515v36.985H66.087zm0 52.015h379.826v178.833h-36.534V297.19a7.515 7.515 0 00-7.515-7.515H273.989a7.515 7.515 0 00-7.515 7.515v33.499h-20.949V297.19a7.515 7.515 0 00-7.515-7.515H110.136a7.515 7.515 0 00-7.515 7.515v33.499H66.087zm328.262 178.832H281.504v-25.984h112.845zm-163.853 0H117.651v-25.984h112.845z"/><path d="M94.748 102.455c-6.364 0-11.542 5.178-11.542 11.543s5.178 11.542 11.542 11.542 11.542-5.178 11.542-11.542c.001-6.364-5.177-11.543-11.542-11.543zM131.791 102.455c-6.364 0-11.542 5.178-11.542 11.543s5.178 11.542 11.542 11.542 11.542-5.178 11.542-11.542-5.178-11.543-11.542-11.543zM168.833 102.455c-6.364 0-11.542 5.178-11.542 11.543s5.178 11.542 11.542 11.542c6.365 0 11.543-5.178 11.543-11.542s-5.178-11.543-11.543-11.543zM110.136 271.332h54.669a7.515 7.515 0 100-15.03H117.65v-65.938h276.683v65.938h-199.47a7.515 7.515 0 100 15.03h206.984a7.515 7.515 0 007.515-7.515V182.85a7.515 7.515 0 00-7.515-7.515H110.136a7.515 7.515 0 00-7.515 7.515v80.968a7.514 7.514 0 007.515 7.514z"/>
          </svg>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nameInput">{{ $t('Your name') }}</label>
            <input id="nameInput" type="text" class="form-control" v-model="fields.name" :placeholder="$t('Enter name')">
          </div>
          <div v-if="isCurrent.country" class="form-group">
            <label for="phoneInput">{{ $t('Your phone') }}</label>
            <input id="phoneInput" type="text" class="form-control" name="phone" v-model="fields.phone" v-mask="phoneMask" :placeholder="$t('Enter phone')">
          </div>
          <div class="form-group">
            <label for="emailInput">{{ $t('Your email') }}</label>
            <input id="emailInput" type="email" class="form-control" v-model="fields.email" aria-describedby="emailHelp" :placeholder="$t('Enter email')">
            <small id="emailHelp" class="form-text">{{ $t('we will never share your email with anyone else.') }}</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">{{ $t('Close') }}</button>
          <button type="button" class="btn btn-primary" @click="onSubmit">{{ $t('Submit') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrbitalsLoader from './Loader.vue'
import axios from 'axios'

export default {
  name: 'order-form-modal',
  props: ['orderData'],
  data() {
    return {
      config: {
        headers: {
          'Authorization': 'Bearer 2|2ySAX2CnwBNL5yre3OuRoWBgy8bs9ZNgaV97f37p'
        }
      },
      phoneMask: null,
      fields: {},
      loaded: false,
      isCurrent: null
    }
  },
  components: {
    OrbitalsLoader,
  },
  computed: {
    fieldResult() {
      let data = this.fields
      data.phone = data.phone.replace('(', '').replace(')', '').replace(/\s/g, '').replace(/_/g, '').replace(/-/g, '')
      return data
    }
  },
  mounted() {
    if (typeof this.orderData !== 'undefined') {
      this.isCurrent = JSON.parse(this.orderData)
      if(this.isCurrent.country) {
        if(this.isCurrent.country === 'UA') {
          this.phoneMask = { mask: '+38 (099) 999-99-99'}
        } else if (this.isCurrent.country === 'RU') {
          this.phoneMask = { mask: '+7 (999) 999-99-99'}
        }
      }
    }
    this.clearForm()
    this.loaded = true
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
        step: 1,
        name: '',
        phone: '',
        email: ''
      }
    },
    onSubmit: function () {
      if (this.loaded) {
        let _this = this, _current = this.isCurrent
        _this.loaded = false
        axios.post(location.origin + '/api/requests/put', {type: _current.type, data: this.fieldResult, source: location.origin, lang: _current.lang}, this.config).then(response => {
          let urlParams = new URLSearchParams(window.location.search)
          if (typeof fbq !== 'undefined' && urlParams.get('utm_source') === 'facebook') {
            fbq.push('track', 'Lead', {
              content_category: 'order',
              content_name: 'website'
            })
          }

          if(typeof response.data.orderUrl !== 'undefined') {
            this.$swal({
              icon: 'success',
              allowOutsideClick: false,
              allowEscapeKey: false,
              reverseButtons: true,
              title: this.$t('Your request has been sent successfully.').replace('.', ''),
              text: this.$t('There are still some questions left. Then we will be able to calculate the cost and deadline of the project.'),
              showCancelButton: true,
              confirmButtonText: this.$t('Step :step').replace(':step', 2),
              cancelButtonText: this.$t('Fill out Later'),
              customClass: {
                closeButton: 'btn btn-light',
                confirmButton: 'btn btn-primary'
              }
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = response.data.orderUrl
              }
            })
          } else {
            _this.showNotification('success', 'notifications', response.data.success, 'top', 'center')
            _this.showNotify()
          }

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