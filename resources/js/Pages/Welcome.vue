<template>
    <Head title="Welcome" />
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="flex flex-col w-full h-full text-gray-900 text-xl ">
            <post-component></post-component>
        </div>
    </div>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import PostComponent from '@/Components/PostComponent.vue';



    export default defineComponent({
        components: {
            Head,
            Link,
            PostComponent,
        },
        data() {
            return {

            }
        },
    })
</script>
