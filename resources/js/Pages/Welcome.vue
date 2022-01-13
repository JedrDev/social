<template>
    <Head title="Welcome" />
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="flex flex-col w-full h-full text-gray-900 text-xl ">
            <div class="flex w-full items-center justify-center mx-auto">
                <button @click="changeStateCreatePost" class="w-96 mb-5 text-center bg-[#0ED3CF] rounded-full text-white py-2 outline-none focus:outline-none hover:bg-cyan-600">Add post</button>
            </div>
            <div v-if="posts.length > 0">
                <post-component v-for="(post,index) in posts" :key="index" :post="post" @post="setPost"></post-component>
            </div>
            <div v-else class="flex w-full items-center justify-center mx-auto text-3x1 text-center">Ops.. there any posts, why not follow you someone or publish something?</div>
        </div>
    </div>

    <modal-post :show="show" :post="post" @show="changeStateModalPost"></modal-post>

    <modal-component :show="showModal" @close="changeStateCreatePost" >
        <div class="p-5">
            <div class="">
                <input v-model="text" type="text" class="w-full outline-none focus:outline-none p-2 rounded appaerance-none border-none" placeholder="What are you thinking?">
                <div class="my-5">
                    <img v-if="url" :src="url" style="max-width: 100%; max-height: 400px; margin: 0 auto;">
                </div>
                <div class="flex justify-end">
                    <button @click="selectImage" class="outline-none focus:outline-none inline-flex items-center rounded-full cursor-pointer bg-[#0ED3CF] p2">
                        <svg class="text-white h-7 w-7" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </button>
                    <input id="image" @change="fileChange" type="file" name="image" accept="image/gif,image/jpg,image/png,image/jpeg" style="display:none;">
                </div>
                <div class="text-red-500 p-2 mt-5">
                    {{ this.error }}
                </div>
            </div>
            <div class="flex justify-end">
                <button @click="createPost" v-if="text.length > 0 && image != null" class="my-3 w-48 outline-none focus:outline-none text-center rounded-full text-white cursor-pointer bg-[#0ED3CF] p2">
                    Save
                </button>
            </div>

        </div>
    </modal-component>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import PostComponent from '@/Components/PostComponent.vue';
    import ModalComponent from '@/Jetstream/Modal.vue';
    import ModalPost from '@/Components/ModalPost.vue';



    export default defineComponent({
        components: {
            Head,
            Link,
            PostComponent,
            ModalComponent,
            ModalPost,
        },
        data() {
            return {
                showModal: false,
                show: false,
                url: null,
                image: null,
                text: '',
                posts: [],
                post: [],
                error: null,
            }
        },
        methods: {
            async getPosts() {
                await axios.get('/posts')
                .then(response => {
                    this.posts = response.data
                })
            },
            changeStateCreatePost() {
                this.showModal = !this.showModal
            },
            changeStateModalPost() {
                this.show = !this.show
            },
            fileChange(e){
                let file = e.target.files[0]
                this.image = file
                this.url = URL.createObjectURL(file)
            },
            selectImage(){
                document.getElementById('image').click()
            },
            async createPost(){
                const formData = new FormData()
                formData.append('image', this.image)
                formData.append('description', this.text)
                await axios.post('/posts', formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    this.posts.unshift(response.data)
                    this.resetForm()
                }).catch((error) => {
                    if (error.response.status === 422) {
                        this.error = error.response.data.errors.image[1]
                        setTimeout(() => {
                            this.error = null
                        },5000)
                    }
                })
            },
            resetForm(){
                this.showModal = false
                this.text = ''
                this.image = null
                this.url = null

            },
            setPost(post){
                this.show = !this.show
                this.post = post
            },
        },
        created() {
            this.getPosts()
        },
    })
</script>
