<template>
    <modal-component :show="show" @close="showModalPost" maxWidth="5xl">
        <!-- component -->
        <!-- This is an example component -->
        <div class="bg-white overflow-hidden shadow-none" >
            <div class="grid grid-cols-3 min-w-full">

                <div class="col-span-2 w-full h-full">
                    <img class="w-full max-w-full min-w-full"
                        :src="post.photo_url"
                        alt="Description">
                </div>

                <div class="col-span-1 relative pl-4">
                    <header class="border-b border-grey-400">
                        <a href="#" class="cursor-pointer py-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img :src="post.user.profile_photo_url" class="h-9 w-9 rounded-full object-cover"
                            alt="user" />
                            <p class="block ml-2 font-bold">{{post.user.nickname}}</p>
                        </a>
                    </header>

                    <div class="pt-1">
                        <div v-if="post.comments.length > 0">
                            <div v-for="(comment,index) in post.comments" :key="index" class="text-sm mb-2 flex flex-start items-center">
                                <div>
                                    <a href="#" class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                        :src="comment.user.profile_photo_url"
                                        alt="user" />
                                    </a>
                                </div>
                                <p class="font-bold ml-2">
                                    <a class="cursor-pointer">{{comment.user.nickname}}</a>
                                    <span class="text-gray-700 font-medium ml-1">
                                        {{comment.comment}}
                                    </span>
                                </p>
                            </div>
                        </div>



                        <div class="text-sm mb-2 flex flex-start items-center">
                            <div>
                                <a href="#" class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                    src="https://images.pexels.com/photos/3861456/pexels-photo-3861456.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                    alt="user" />
                                </a>
                            </div>
                            <p class="font-bold ml-2">
                                <a class="cursor-pointer">Kesha:</a>
                                <span class="text-gray-700 font-medium ml-1">
                                    This is amazing
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 pl-4">
                        <div class="pt-4">
                            <div class="mb-2">
                                <div v-if="post.isLinked">
                                    <div class="flex items-center">
                                        <span class="mr-3 inline-flex items-center cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="flex items-center">
                                        <span class="mr-3 inline-flex items-center cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer text-[#92929D]" fill="none" viewBox="0 0 26 26" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <span class="text-gray-600 text-sm font-bold">{{post.countLikes}} Likes</span>
                            </div>
                            <span class="block ml-2 text-xs text-gray-600">{{getDifferenceTime(post.created_at)}}</span>
                        </div>

                        <div class="pt-4 pb-1 pr-3">
                            <div class="flex items-center justify-between mt-4">
                                <img :src="$page.props.user.profile_photo_url" class="h-8 w-8 rounded-full object-cover">
                                <div class="flex items-center justify-between bg-gray-50 h-11 w-11/12 focus:w-9/12 ml-6 border rounded-2xl focus:border-gray-800 overflow-hidden">
                                    <input v-model="textComment" class="w-full h-full resize-none outline-none appearance-none pl-1" aria-label="Write your comment..." placeholder="Write your comment..." name="comment"/>
                                </div>
                                <button v-if="textComment.length > 0" class="mb-1 ml-2 focus:outline-none border-none bg-transparent text-blue-600">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </modal-component>
</template>
<script>
    import ModalComponent from '@/Jetstream/Modal.vue'
    import moment from 'moment'
    export default {
        components: {
            ModalComponent,
        },
        data(){
            return {
                textComment: '',
            }
        },
        props:['post','show'],
        methods: {
            showModalPost(){
                this.$emit('show')
            },
            getDifferenceTime(date){
                return moment(date).fromNow(true)
            },
        }
    }
</script>
