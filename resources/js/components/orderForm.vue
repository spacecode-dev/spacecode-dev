<template>
  <form class="mainContactForm" v-if="isCurrent" v-on:submit.prevent="onSubmit">
    <OrbitalsLoader v-if="!loaded"/>
<!--    <div class="tabs">-->
<!--      <div :class="['tab', 'tab-email', activeTab === 'email' ? 'active' : null]" @click="activeTab = 'email'">-->
<!--        <span class="icon icon-email"/>-->
<!--      </div>-->
<!--      <div :class="['tab', 'tab-email', activeTab === 'wa' ? 'active' : null]" @click="activeTab = 'wa'">-->
<!--        <img :src="'/storage/website/chat/chat_whatsapp.png'" alt="Chat_Whatsapp SpaceCode">-->
<!--      </div>-->
<!--      <div :class="['tab', 'tab-email', activeTab === 'tm' ? 'active' : null]" @click="activeTab = 'tm'">-->
<!--        <img :src="'/storage/website/chat/chat_telegram.png'" alt="Chat_Telegram SpaceCode">-->
<!--      </div>-->
<!--      <div :class="['tab', 'tab-email', activeTab === 'fb' ? 'active' : null]" @click="activeTab = 'fb'">-->
<!--        <img :src="'/storage/website/chat/chat_messenger.png'" alt="Chat_Messenger SpaceCode">-->
<!--      </div>-->
<!--    </div>-->
    <div class="add" :class="{'loading': !loaded}">

<!--      <template v-if="activeTab === 'email'">-->
        <p :class="[isCurrent.pageType === 'home' ? 'h4' : 'h3', 'form-title']">
          <template v-if="isCurrent.pageType === 'home'">
            {{ $t('Request a Quote') }}
          </template>
          <template v-else>
            {{ $t('Turn your product into a growth engine') }}
          </template>
        </p>

        <div :class="['form-group', !isCurrent.country ? 'full' : null]">
          <label for="nameInput">{{ $t('Your name') }}</label>
          <input id="nameInput" type="text" class="form-control" name="name" v-model="fields.name" :placeholder="$t('Enter name')">
        </div>

        <div v-if="isCurrent.country" class="form-group">
          <label for="phoneInput">{{ $t('Your phone') }}</label>
          <input id="phoneInput" type="text" class="form-control" name="phone" v-model="fields.phone" v-mask="phoneMask" :placeholder="$t('Enter phone')">
        </div>

        <div :class="['form-group', isCurrent.pageType === 'home' ? null : 'full']">
          <label for="emailInput">{{ $t('Your email') }}</label>
          <input id="emailInput" type="email" class="form-control" name="email" v-model="fields.email" aria-describedby="emailHelp" :placeholder="$t('Enter email')">
          <small id="emailHelp" class="form-text">{{ $t('we will never share your email with anyone else.') }}</small>
        </div>

        <button type="submit" class="btn btn-primary">{{ $t('Submit') }}</button>
<!--      </template>-->

<!--      <template v-else>-->
<!--        <p :class="[isCurrent.pageType === 'home' ? 'h4' : 'h3', 'form-title']">-->
<!--          {{ $t('Send a Message') }}-->
<!--        </p>-->
<!--&lt;!&ndash;        <div class="form-group full">&ndash;&gt;-->
<!--&lt;!&ndash;          <label for="messageInput">{{ $t('Write something') }}</label>&ndash;&gt;-->
<!--&lt;!&ndash;          <textarea id="messageInput" class="form-control" v-model="message"></textarea>&ndash;&gt;-->
<!--&lt;!&ndash;        </div>&ndash;&gt;-->

<!--        <a class="btn btn-primary submit send" :href="messageLink" target="_blank">{{ $t('Chat now') }}</a>-->
<!--      </template>-->

    </div>
  </form>
</template>

<script>
import OrbitalsLoader from './Loader.vue'
import axios from 'axios'

export default {
  name: 'order-form',
  props: ['orderData'],
  data() {
    return {
      config: {
        headers: {
          'Authorization': 'Bearer 2|2ySAX2CnwBNL5yre3OuRoWBgy8bs9ZNgaV97f37p'
        }
      },
      // activeTab: 'email',
      // message: '',
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
    },
    // messageLink() {
    //   if(this.activeTab === 'wa') {
    //     return '//wa.me/message/JICS2MINHIGSM1?text=' + this.message;
    //   } else if (this.activeTab === 'tm') {
    //
    //     // https://t.me/share/url?url=example.org&text=An%20Example
    //
    //     // https://t.me/responseapibot?start=brocolis
    //
    //     return '//t.me/SpaceCodeDevBot?start=brocolis'
    //     // return '//t.me/SpaceCodeDevBot?text=' + this.message
    //     // return '//t.me/share/url=example.org&text=' + this.message
    //   } else if (this.activeTab === 'fb') {
    //     return '//m.me/spacecodeDev?text=' + this.message
    //   }
    // }
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
    clearForm() {
      this.fields = {
        step: 1,
        name: '',
        phone: '',
        email: ''
      }
    },
    onSubmit() {
      if (this.loaded) {

        // if(this.activeTab === 'email') {
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
        // } else {
        //   console.log(this.message)
        // }
      }
    }
  }
}
</script>