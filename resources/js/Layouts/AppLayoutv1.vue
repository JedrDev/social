<template>
    <div class="flex h-screen">
        <Head :title="title" />

        <jet-banner />
        <div class="flex-1 flex flex-col overflow-hidden">

                <nav class="flex justify-between items-center bg-white border-b border-gray-100 shadow-lg">
                    <div class="flex">
                                    <!-- Logo -->
                                    <div class="shrink-0 flex items-center">
                                        <Link :href="route('dashboard')">
                                            <authentication-card-logo />
                                        </Link>
                                    </div>

                                    <div class="ml-3 relative mt-3">
                                        <dropdown align="right" width="100" overflow="overflow-y-auto" maxheight="300">
                                            <template #trigger>
                                                <div class="relative mx-auto text-gray-600">
                                                    <input v-model="search" @keyup="userSearch" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-full text-sm focus:outline-none"
                                                    type="search" placeholder="Search">
                                                    <span class="absolute right-0 top-0 mt-3 mr-6">
                                                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                                            width="512px" height="512px">
                                                            <path
                                                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </template>

                                            <template #content >
                                                <div v-if="users.length >0">
                                                    <a  v-for="(user,index) in users" :key="index" href="" class="flex items-center py-2 px-3 hover:bg-gray-100 my-auto">
                                                        <img  class="rounded-full w-9 h-9 object-cover" :src="user.profile_photo_url" :alt="user.name">
                                                        <div class="ml-2">
                                                            <span class="block font-bold text-gray-700 text-sm">{{user.nickname}}</span>
                                                            <span class="text-sm font-light text-gray-400">{{user.name}}</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div v-if="search == ''" class="flex items-center">
                                                    <span class="text-sm font-light text-gray-400">Search someone</span>
                                                </div>
                                                <div v-if="!userExists" class="flex items-center">
                                                    <span class="text-sm font-light text-gray-400">User doesnt exist</span>
                                                </div>

                                            </template>
                                        </dropdown>
                                    </div>

                    </div>

                    <div class="flex hidden sm:flex sm:items-center sm:ml-6">
                                    <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <jet-dropdown align="right" width="48">
                                            <template #trigger>
                                                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                                </button>

                                                <span v-else class="inline-flex rounded-md">
                                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                        {{ $page.props.user.name }}

                                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Account
                                                </div>

                                                <jet-dropdown-link :href="route('profile.show')">
                                                    Settings
                                                </jet-dropdown-link>

                                                <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                                    API Tokens
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <jet-dropdown-link as="button">
                                                        Log Out
                                                    </jet-dropdown-link>
                                                </form>
                                            </template>
                                    </jet-dropdown>
                                </div>
                    </div>

                </nav>

                <div class="flex h-full">
                    <nav class="w-full flex w-72 h-full">
                        <sidebar-component />
                        <!--<div class="w-full flex mx-auto px-6 py-8">
                            <div class="w-full h-full flex items-center justify-center text-gray-900 text-xl border-4 border-gray-900 border-dashed">

                            </div>
                        </div>-->
                    </nav>


                    <main class="flex flex-col w-full bg-gray overflow-x-hidden overflow-y-auto mb-14">
                        <slot></slot>
                    </main>


                    <!--<nav class="flex w-72 h-full bg-yellow-400">
                        <div class="w-full flex mx-auto px-6 py-8">
                        <div class="w-full h-full flex items-center justify-center text-gray-900 text-xl border-4 border-gray-900 border-dashed">Rightbar</div>
                        </div>
                    </nav>-->
                </div>
            </div>
    </div>

</template>

<style>
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}
::-webkit-scrollbar-thumb {
  background: rgba(0,0,0,.2);
  border-radius: 12px;
}
::-webkit-scrollbar-thumb:hover {
  background: #0ED3CF;
}
::-webkit-scrollbar-track {
  background: transparent;
  border-radius: 10px;
  box-shadow: inset 7px 10px 12px #f0f0f0;
}
</style>

<script>
    import { defineComponent } from 'vue'
    import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import Dropdown from '@/Components/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import sidebarComponent from '@/Components/sidebarComponent.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import axios from 'axios'

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            AuthenticationCardLogo,
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
            Dropdown,
            sidebarComponent,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                users:[],
                search: '',
                userExists: true,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
            async userSearch (){
                if (this.search != '') {
                    await axios.get('/search/' + this.search)
                    .then(response => {
                        if(response.data.length > 0 && Array.isArray(response.data)){
                            this.userExists = true
                            this.users = response.data
                        } else {
                            this.userExists = false
                            this.users = []
                        }
                    })
                }else{

                    this.users = []
                }
            },
        }
    });
</script>
