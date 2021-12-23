<template>
    <Link :href="'/'">
        <img src="../../images/logo.png" alt="logo dimejedr" style="width:60px;height:60px" >
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
