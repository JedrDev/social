<template>

    <div class="w-full text-gray-900 text-sm font-medium px-3 pt-10">
        <div class="shadow-xl rounded-lg">
            <a href="#" class="block px-4 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-700 text-white cursor-pointer">
                New Post
            </a>
            <a href="#" class="block px-4 py-2 border-b border-gray-200 w-full hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 cursor-pointer ">
                Profile
            </a>

            <a href="#" class="block px-4 py-2 border-b border-gray-200 w-full rounded-b-lg hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 cursor-pointer ">
                Messages
            </a>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: ['user']
    }
</script>
