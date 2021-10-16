<template>
  <div v-if="ready" class="card">
    <div class="table">
      <div class="item header">
        <div class="column name question">
          <p>{{ $t('Do you need a Web Design?') }}</p>
          <toggle-button v-model="design" :labels="{checked: $t('Yes'), unchecked: $t('No')}"/>
        </div>
        <div class="column" v-for="app in entity.apps" :key="'app-' + app.name">
          <div class="titles">
            <p v-for="(title, index) in app.title" :key="'title-app-' + app.name + '-' + index">{{ title }}</p>
          </div>
        </div>
      </div>
      <div class="item" v-for="item in entity.list">
        <div class="column name">{{ item.title }}</div>
        <div :class="['column', item.name, isCheck(item.name) ? 'checkClass' : null]" v-for="(i, index) in item.array">
          <template v-if="isCheck(item.name)">
            <div class="check">
              <svg viewBox="0 -46 417.81333 417" xmlns="http://www.w3.org/2000/svg">
                <path d="m159.988281 318.582031c-3.988281 4.011719-9.429687 6.25-15.082031 6.25s-11.09375-2.238281-15.082031-6.25l-120.449219-120.46875c-12.5-12.5-12.5-32.769531 0-45.246093l15.082031-15.085938c12.503907-12.5 32.75-12.5 45.25 0l75.199219 75.203125 203.199219-203.203125c12.503906-12.5 32.769531-12.5 45.25 0l15.082031 15.085938c12.5 12.5 12.5 32.765624 0 45.246093zm0 0"/>
              </svg>
            </div>
          </template>
          <template v-else-if="item.name === 'hosting'">
            ${{ i }}/{{ $t('month') }}
          </template>
          <template v-else-if="item.name === 'design'">
            {{ resultDesign(i) }}
          </template>
          <template v-else-if="item.name === 'pages'">
            {{ resultPage(i) }}
          </template>
          <template v-else-if="item.name === 'result'">
            <div v-html="resultCost(i, index)"></div>
          </template>
          <template v-else>
            {{ i }}
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'price-table',
  props: ['priceData'],
  data() {
    return {
      entity: null,
      ready: false,
      design: false
    }
  },
  mounted() {
    if (typeof this.priceData !== 'undefined') {
      this.entity = JSON.parse(this.priceData)
      this.ready = true
    }
  },
  methods: {
    isCheck(type) {
      return type === 'admin' || type === 'testing' || type === 'content' || type === 'mobile' || type === 'security' || type === 'seo' || type === 'performance' || type === 'multilingual'
    },
    resultCost(i, index) {
      let pre = ``
      if(this.design) {
        pre = `≈ `
        i = Number(i)+this.entity.list.find(x => x.name === 'design').array[index]
      }

      if(index === 3) {
        if(this.entity.currency === '$') {
          return `${pre}<small>${this.$t('from')} $</small>${i}`
        } else if (this.entity.currency === 'грн') {
          return `${pre}<small>${this.$t('from')} </small>${i}<small> UAH</small>`
        } else if (this.entity.currency === 'руб') {
          return `${pre}<small>${this.$t('from')} </small>${i}<small> RUB</small>`
        } else {
          return `${pre}<small>${this.$t('from')} $</small>${i}`
        }
      }

      if(this.entity.currency === '$') {
        return `${pre}<small>$</small>${i}`
      } else if (this.entity.currency === 'грн') {
        return `${pre}${i}<small> UAH</small>`
      } else if (this.entity.currency === 'руб') {
        return `${pre}${i}<small> RUB</small>`
      } else {
        return `${pre}<small>$</small>${i}`
      }
    },
    resultPage(i) {
      if(i === 1) {
        return `${i} ${this.$t('page')}`
      } else if (i === -1) {
        return `∞ ${this.$t('pages')}`
      }
      return `${this.$t('up to')} ${i} ${this.$t('pages')}`
    },
    resultDesign(i) {
      if(this.design) {
        if(this.entity.currency === '$') {
          return `≈ $${i}`
        } else if (this.entity.currency === 'грн') {
          return `≈ ${i} UAH`
        } else if (this.entity.currency === 'руб') {
          return `≈ ${i} RUB`
        } else {
          return `≈ $${i}`
        }
      }
      return `-`
    }
  }
}
</script>

<style lang="scss" scoped>
  @import "../../sass/inc/mixin";
  ::v-deep {
    &.card {
      background: #f6f7f9;
      border: 0;
      border-radius: 1rem;
      overflow: hidden;
      @include media-lg {
        overflow-y: hidden;
        overflow-x: auto;
      }
      .table {
        margin: 0;
        min-width: 1100px;
        overflow: hidden;
        .item {
          display: flex;
          &:not(.header):nth-child(even) {
            background: white;
          }
          &.header {
            padding: 1rem 0;
          }
          .column {
            font-size: .85rem;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            @include media-md {
              padding: 1rem;
            }
            .titles {
              p {
                font-family: "Poppins", sans-serif;
                margin: 3px;
                font-weight: 600;
                font-size: 0.85rem;
                line-height: 1.4;
                padding: 6px;
                text-align: left;
                &:not(:last-child) {
                  border-bottom: 1px solid #d6d6d6;
                }
              }
            }
            &.name {
              flex: 0 0 250px;
              width: 250px;
              padding: 2rem;
              text-align: left;
              font-weight: 600;
              &.question {
                flex-direction: column;
                align-items: baseline;
                justify-content: flex-end;
                .vue-js-switch {
                  margin: 0;
                }
                p {
                  margin: 0 0 .5rem 0;
                  font-size: .85rem;
                  font-weight: 600;
                  line-height: 1.3;
                }
              }
              @include media-md {
                padding: 1rem;
              }
              @include media-sm {
                padding: .75rem 1rem;
              }
            }
            &.result {
              font-size: 1rem;
              font-weight: 900;
              small {
                position: relative;
                top: 1px;
              }
            }
            &.checkClass {
              .check {
                width: 2rem;
                height: 2rem;
                display: flex;
                justify-content: center;
                align-items: center;
                background: rgba(0, 123, 255, .05);
                border-radius: 2rem;
                @include media-sm {
                  width: 1.5rem;
                  height: 1.5rem;
                }
                svg {
                  width: .75rem;
                  fill: #007bff;
                  @include media-sm {
                    width: .6rem;
                  }
                }
              }
            }
            &:not(.name) {
              flex: 0 0 calc(calc(100% - 250px)/4);
              width: calc(calc(100% - 250px)/4);
              padding: 1rem 2rem;
              text-align: center;
              @include media-md {
                padding: 1rem;
              }
              @include media-sm {
                padding: .75rem 1rem;
              }
            }
          }
        }
      }
    }
  }
</style>