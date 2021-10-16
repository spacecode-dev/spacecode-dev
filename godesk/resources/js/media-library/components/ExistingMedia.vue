<template>
    <div class="fixed pin-l pin-t p-8 h-full w-full z-50" :class="{'hidden': !open, 'flex': open}">
        <div class="absolute bg-black opacity-75 pin-l pin-t h-full w-full" @click="close"></div>
        <div class="flex flex-col bg-white p-4 h-full relative w-full">
            <div class="border-b border-40 pb-4 mb-4">
                <div class="flex -mx-4">
                    <div class="px-4 self-center">
                        <h3>{{ 'Existing Media' }}</h3>
                    </div>
                    <div class="px-4 self-center">
                        <div class="relative">
                            <icon type="search" class="absolute search-icon-center ml-3 text-70"/>
                            <input type="search"
                                   placeholder="Search by name or file name"
                                   class="pl-search form-control form-input form-input-bordered w-full"
                                   v-model="requestParams.search_text"
                                   @input="search"
                                   @change="search"
                                   @keydown.enter.prevent="search"/>
                        </div>
                    </div>
                    <div class="px-4 ml-auto self-center">
                        <button type="button" class="form-file-btn btn btn-default btn-primary" @click="close">{{ 'Close' }}</button>
                    </div>
                </div>
            </div>
            <div class="flex-grow overflow-x-hidden overflow-y-scroll">
                <div class="flex flex-wrap -mx-4 -mb-8" v-if="items.length > 0">
                    <template v-for="(item, key) in items">
                        <existing-media-item :item="item" :key="key" @select="$emit('select', item) && close()"/>
                    </template>
                </div>
                <h4 class="text-center m-8" v-if="loading">{{ 'Loading...' }}</h4>
                <h4 class="text-center m-8" v-else-if="!items.length">{{ 'No results found' }}</h4>
            </div>
            <div class="flex-shrink border-t border-40 pt-4 mt-4 text-right" v-if="showNextPage">
                <button type="button" class="form-file-btn btn btn-default btn-primary ml-auto" @click="nextPage">{{ 'Load Next Page' }}</button>
            </div>
        </div>
    </div>
</template>

<script>
import ExistingMediaItem from './ExistingMediaItem';
import debounce from 'lodash/debounce';

export default {
    components: {
        ExistingMediaItem
    },
    data() {
        let aThis = this;
        return {
            requestParams: {
                search_text: '',
                page: 1,
                per_page: 18
            },
            items: [],
            response: {},
            loading: false,
            search: _.debounce(function () {
                aThis.refresh();
            }, 750),
        }
    },
    props: {
        open: {
            default: false,
            type: Boolean
        }
    },
    computed: {
        showNextPage() {
            return this.items.length === (this.requestParams.page * this.requestParams.per_page);

        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        refresh() {
            this.requestParams.page = 1;
            return this.fireRequest().then((response) => {
                this.items = response.data.data;
                return response;
            });
        },
        nextPage() {
            this.requestParams.page += 1;
            return this.fireRequest().then((response) => {
                this.items = this.items.concat(response.data.data);
                return response;
            });
        },
        fireRequest() {
            this.loading = true;
            return this.createRequest().then(response => {
                this.response = response;
                return response;
            }).finally(() => {
                this.loading = false;
            });
        },
        createRequest() {
            return Nova.request()
                .get(`/nova-vendor/media-library/media`, {
                    params: this.requestParams
                })
        }
    },
    watch: {
        open: function (newValue) {
            if (newValue) {
                if (!this.items.length) {
                    this.refresh();
                }
                document.body.classList.add('overflow-x-hidden');
                document.body.classList.add('overflow-y-hidden');
            } else {
                document.body.classList.remove('overflow-x-hidden');
                document.body.classList.remove('overflow-y-hidden');
            }
        }
    }
}
</script>